import React, { useState } from 'react';

const LoginForm = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [isDisabled, setIsDisabled] = useState(true);
  const [message, setMessage] = useState('');

  const handleUsernameChange = (event) => {
    const value = event.target.value;
    setUsername(value);
    setIsDisabled(value.length < 4 || password.length < 4);
  };

  const handlePasswordChange = (event) => {
    const value = event.target.value;
    setPassword(value);
    setIsDisabled(username.length < 4 || value.length < 4);
  };

  const handleLogin = () => {
    if (username === 'admin' && password === '123456') {
      setMessage('Login successfully');
    } else {
      setMessage('Login failed');
    }
  };

  return (
    <div>
      <h2>Login Form</h2>
      <div>
        <label>Username:</label>
        <input type="text" value={username} onChange={handleUsernameChange} />
      </div>
      <div>
        <label>Password:</label>
        <input type="password" value={password} onChange={handlePasswordChange} />
      </div>
      <button onClick={handleLogin} disabled={isDisabled}>
        Login
      </button>
      <div>{message}</div>
    </div>
  );
};

export default LoginForm;
