import React, { useState } from 'react';
export default function FruitForm({ handleAdd }) {
    const [newFruit, setNewFruit] = useState("");
    const handleSubmit = (event) => {
        event.preventDefault();

        const id = new Date().getTime();
        const nom = newFruit;
        const addFruit = { id, nom };
        handleAdd(addFruit);
        setNewFruit("");
        console.log("You added", nom);

    }

    const handleChange = (event) => {
        setNewFruit(event.target.value);
        console.log(event.target.value);
    }

    return (<form onSubmit={handleSubmit}>
        <input value={newFruit} type="text" placeholder='Ajouter un fruit...' onChange={handleChange} />
        <button>Ajouter</button>
    </form>)
}


