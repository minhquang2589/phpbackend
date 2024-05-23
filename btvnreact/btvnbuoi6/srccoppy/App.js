import React from 'react';
import Question4 from './Question4';

const App = () => {
  const data = ['Learn Redux',
               'Learn React Native', 
               'Practive React JS',
               'Code portfolino in React',
               'Learning ReactJs BAsics',
            ];

  return (
    <div>
      <h1>List of Items</h1>
      <Question4 items={data} />
    </div>
  );
};

export default App;