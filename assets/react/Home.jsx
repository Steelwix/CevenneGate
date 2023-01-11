import React, { useState } from 'react';
import FruitForm from './components/FruitForm';

function Home() {

    const [player, setPlayer] = useState([]);


    const handleAdd = (newName) => {
        const playerCopy = [...player];
        playerCopy.push(newName);
        setPlayer(playerCopy);
    }
    return (
        <div>
            <h1>Votre nom est : </h1>
            <FruitForm handleAdd={handleAdd} />
        </div>);
}