
import React, { useState, useEffect } from 'react';

function DataList() {
    const [data, setData] = useState([]);

    useEffect(() => {
        fetch('/data')
            .then(response => response.json())
            .then(data => setData(data))
            .catch(error => console.error('Lỗi khi truy xuất dữ liệu:', error));
    }, []);

    return (
        <div>
            <h2>Danh sách dữ liệu</h2>
            <ul>
                {data.map(item => (
                    <li key={item.id}>{item.name}</li>
                ))}
            </ul>
        </div>
    );
}

export default DataList;
