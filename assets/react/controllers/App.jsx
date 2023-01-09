import React, { useState } from 'react';

function App() {
    //state (état, données)
    const [count, setCount] = useState(0);
    //comportements
    const handleClick = () => {
        setCount(count + 1);
        console.log("The count is now ", count + 1)
    }
    //affichage(render)
    return (
        <div><h1>{count}</h1><button onClick={handleClick}>Click me</button>
        </div>);
}

export default App;
