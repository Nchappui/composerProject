import React from 'react';

const App = () => {
  const [count, setCount] = React.useState(0);
  return (
        <div>
      <h1>Hello from React Component!</h1>
      <p>Counter: {count}</p>
      <button onClick={() => setCount(count + 1)}>
        Click me
      </button>
    </div>

  );
};

export default App;