import React, { useState } from 'react';

const Question3 = ({ items }) => {
  const [checkedItems, setCheckedItems] = useState([]);

  const handleCheckboxChange = (index) => {
    const newCheckedItems = [...checkedItems];
    newCheckedItems[index] = !newCheckedItems[index];
    setCheckedItems(newCheckedItems);
  };

  return (
    <ul >
      {items.map((item, index) => (
        <li key={index} style={{ color: checkedItems[index] ? 'red' : 'black' }}>
          <label>
            <input type="checkbox" onChange={() => handleCheckboxChange(index)} />
            {item}
          </label>
        </li>
      ))}
    </ul>
  );
};

export default Question3;
