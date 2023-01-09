import React from 'react';
export default function DisplayFruit({ fruitInfo, onFruitDelete }) {
    return (
        <li >{fruitInfo.nom}{" "}
            <button onClick={() => onFruitDelete(fruitInfo.id, fruitInfo.nom)}>X</button></li>);
}
