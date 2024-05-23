import './bootstrap';
import './compoment/reacttest';
import './compoment/listproduct';
import React from 'react';
import ReactDOM from 'react-dom';
import DataList from './components/listproduct';

function App() {
    return (
        <div>
            <h1>Ứng dụng React trong Laravel</h1>
            <DataList />
        </div>
    );
}

ReactDOM.render(<App />, document.getElementById('root'));
