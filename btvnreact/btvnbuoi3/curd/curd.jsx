import React, { useState, useEffect } from 'react';

const RecordsViewer = () => {
  const [records, setRecords] = useState([]);
  const [newUsername, setNewUsername] = useState('');
  const [newPassword, setNewPassword] = useState('');
  const [updateId, setUpdateId] = useState(null); // Define updateId state
  const [message, setMessage] = useState('');
  const API_URL = 'https://api.airtable.com/v0/appotNSvSXLDIdvZW/c2307l';
  const API_TOKEN = 'Bearer pat67Ci2J8KYG9Iry.0e6ed02a38fe17c9321b1a29ce2db83bc14537ec2610545170d53e4bd8194fcf';

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    try {
      const response = await fetch(API_URL + '?maxRecords=10&view=Grid%20view', {
        headers: {
          Authorization: API_TOKEN
        }
      });
      if (!response.ok) {
        throw new Error('Failed to fetch data');
      }
      const data = await response.json();
      setRecords(data.records);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };

  const handleUsernameChange = (event) => {
    setNewUsername(event.target.value);
  };

  const handlePasswordChange = (event) => {
    setNewPassword(event.target.value);
  };

  const handleUpload = async () => {
    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: API_TOKEN
        },
        body: JSON.stringify({
          fields: {
            username: newUsername,
            password: newPassword
          }
        })
      });
      if (!response.ok) {
        throw new Error('Failed to upload data');
      }
      setMessage('Upload successful');
      setNewUsername('');
      setNewPassword('');
      fetchData();
    } catch (error) {
      console.error('Error uploading data:', error);
      setMessage('Upload failed');
    }
  };

  const handleDelete = async (id) => {
    try {
      const response = await fetch(`https://api.airtable.com/v0/appotNSvSXLDIdvZW/c2307l/${id}`, {
        method: 'DELETE',
        headers: {
          Authorization: API_TOKEN
        }
      });
      if (!response.ok) {
        throw new Error('Failed to delete record');
      }

      setRecords(records.filter(record => record.id !== id));
    } catch (error) {
      console.error('Error deleting record:', error);
    }
  };

  const handleUpdate = async () => {
    try {
      const response = await fetch(`${API_URL}/${updateId}`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          Authorization: API_TOKEN
        },
        body: JSON.stringify({
          fields: {
            username: newUsername,
            password: newPassword
          }
        })
      });
      if (!response.ok) {
        throw new Error('Failed to update data');
      }
      setMessage('Update successful');
      setNewUsername('');
      setNewPassword('');
      setUpdateId(null);
      fetchData(); // Refresh data after successful update
    } catch (error) {
      console.error('Error updating data:', error);
      setMessage('Update failed');
    }
  };

  const handleEdit = (id, username, password) => {
    setUpdateId(id);
    setNewUsername(username);
    setNewPassword(password);
  };

  return (
    <div>
      <h2>Records Viewer</h2>
      <div>
        <label>Username:</label>
        <input type="text" value={newUsername} onChange={handleUsernameChange} />
      </div>
      <div>
        <label>Password:</label>
        <input type="text" value={newPassword} onChange={handlePasswordChange} />
      </div>
      <button onClick={updateId ? handleUpdate : handleUpload}>
        {updateId ? 'Update' : 'Upload'}
      </button>
      <div>{message}</div>
      <ul>
        {records.map(record => (
          <li key={record.id}>
            <div>
              <strong>Username:</strong> {record.fields.username}
            </div>
            <div>
              <strong>Password:</strong> {record.fields.password}
            </div>
            <button onClick={() => handleDelete(record.id)}>Delete</button>
            <button onClick={() => handleEdit(record.id, record.fields.username, record.fields.password)}>Edit</button>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default RecordsViewer;
