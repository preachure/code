import React, { useState } from "react";
import axios from "axios";

function Signup() {
    const [name, setName] = useState('');
    const [password, setPassword] = useState('');
    const [email, setEmail] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const res = await axios.post('http://localhost:5000/api/register', {
                name,
                password,
                email
            });
            alert("User registered successfully!");
        } catch (err) {
            console.error(err.response?.data?.message || err.message);
            alert('Failed to register user');
        }
    };

    return (
        <div className="min-h-screen bg-black flex flex-col items-center justify-center">
            <h1 className="text-3xl font-bold mb-6">Signup</h1>
            <form onSubmit={handleSubmit} className="bg-white p-8 rounded-lg shadow-md w-full max-w-md space-y-4">
                <div>
                    <label className="block text-gray-700">Username</label>
                    <input
                        type="text"
                        name="name"
                        value={name}
                        placeholder="enter username"
                        onChange={(e) => setName(e.target.value)}
                        className="w-full mt-1 p-2 border border-gray-300 rounded"
                        required
                    />
                </div>
                <div>
                    <label className="block text-gray-700">Password</label>
                    <input
                        type="password"
                        name="password"
                        value={password}
                        placeholder="enter password"
                        onChange={(e) => setPassword(e.target.value)}
                        className="w-full mt-1 p-2 border border-gray-300 rounded"
                        required
                    />
                </div>
                <div>
                    <label className="block text-gray-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="enter email"
                        value={email}
                        
                        onChange={(e) => setEmail(e.target.value)}
                        className="w-full mt-1 p-2 border border-gray-300 rounded"
                        required
                    />
                </div>
                <button
                    type="submit"
                    className="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600"
                >
                    Register
                </button>
            </form>
        </div>
    );
}

export default Signup;
