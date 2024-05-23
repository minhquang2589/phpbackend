
import React from 'react';
import ReactDOM from 'react-dom';

export default function Hello() {
   return (
      <div>
         hello react
      </div>
   );
}

const container = document.getElementById('root');
const root = ReactDOM.createRoot(container);
root.render(<Hello />);
