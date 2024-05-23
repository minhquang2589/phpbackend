import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.css';
import "./layout/main.css";
function TodoList() {
  const [todos, setTodos] = useState([]);
  const [inputValue, setInputValue] = useState('');

  const addTodo = () => {
    if (inputValue.trim() !== '') {
      setTodos([...todos, { id: Date.now(), text: inputValue, completed: false }]);
      setInputValue('');
    }
  };

  const removeTodo = id => {
    setTodos(todos.filter(todo => todo.id !== id));
  };

  const toggleTodo = id => {
    setTodos(
      todos.map(todo =>
        todo.id === id ? { ...todo, completed: !todo.completed } : todo
      )
    );
  };
  const totalTodos = todos.length;

  return (
    <div className='container'>
      <div className=' list align-items-center '>
        <h2>Things To Do</h2>
          <input
           className='form-group'
            placeholder='Add New'
            type="text"
            value={inputValue}
            onChange={e => setInputValue(e.target.value)}
          />
          <button  className='btn btn-sm btn-primary' onClick={addTodo}>Add</button>
          <ul className=' mt-2 list-unstyled'>
            {todos.map(todo => (
              <li  key={todo.id}>
                <span
                  className='spanlist'
                  style={{ textDecoration: todo.completed ? 'line-through' : 'none' }}
                  onClick={() => toggleTodo(todo.id)}
                >
                  {todo.text}
                </span>
                <button className=' btn btn-sm btn-danger' onClick={() => removeTodo(todo.id)}>X</button>
              </li>
            ))}
          </ul>
          <p>{totalTodos} Items left!</p>
      </div>
    </div>
    
  );
}

export default TodoList;
