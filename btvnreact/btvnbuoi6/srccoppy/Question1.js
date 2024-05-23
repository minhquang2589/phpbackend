import React, { useState } from 'react';

function LoginForm() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = () => {
    if (email === 'aptech@aptech.vn' && password === 'aptech') {
      alert('Login successful');
    } else {
      alert('Login failed. Please check your credentials.');
    }
  };

  return (
    <div>
      <h2>Login Form</h2>
      <label>Email:</label>
      <input 
        type="email" 
        value={email} 
        onChange={(e) => setEmail(e.target.value)} 
      />
      <br />
      <label>Password:</label>
      <input 
        type="password" 
        value={password} 
        onChange={(e) => setPassword(e.target.value)} 
      />
      <br />
      <button onClick={handleLogin}>Login</button>
    </div>
  );
}

function Question1 () {
  return (
    <div>
      <h1>Welcome to my App</h1>
      <LoginForm />
    </div>
  );
}

export default Question1;
