const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const bodyParser = require('body-parser'); 
const bcrypt = require('bcryptjs');
require('dotenv').config();

const app = express();

app.use(cors());
app.use(express.json());
app.use(bodyParser.json());

mongoose.connect(process.env.MONGO_URL, {
  useNewUrlParser: true,
  useUnifiedTopology: true,
})
  .then(() => console.log('connected to mongodb'))
  .catch((err) => console.error('failed to connect', err));

const UserSchema = new mongoose.Schema({
  name: String,
  password: String,
  email: String,
});

const User = mongoose.model('User', UserSchema);

app.post('/api/register', async (req, res) => {
  const { name, password, email } = req.body;
  const hash = await bcrypt.hash(password, 10);
  const user = new User({ name, password: hash, email }); 
  try {
    await user.save();
    res.json({ message: 'user created' });
  } catch (err) {
    res.status(500).json({ error: 'error creating user' }); 
  }
});

const PORT = process.env.PORT || 5000; 

app.listen(PORT, () => {
  console.log(`server running on ${PORT}`);
});