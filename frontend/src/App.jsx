import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import Login from './pages/Login';
import Stock from './pages/Stock';
import Navbar from './Components/Navbar';
import Signup from "./pages/Sign up";

function App() {
  

  return (
    <>
    <div>
      <Router>
        <Navbar/>
        <Routes>
          <Route path='/Login' element={<Login/>}/>
          <Route path='/' element={<Signup/>}/>
          <Route path='/Stock' element={<Stock/>}/>
        </Routes>
      </Router>
    </div>
    </>
  )
}

export default App;
