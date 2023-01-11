import React, { useState } from 'react';
import DisplayFruit from './components/DisplayFruit';
import FruitForm from './components/FruitForm';

function Fruits(props) {
    //state (état, données)
    const [fruits, setFruits] = useState([
        { id: 1, nom: "Abricot" },
        { id: 2, nom: "Banane" },
        { id: 3, nom: "Cerise" },
        { id: 4, nom: "Framboise" }
    ]);
    const [maVariable, setMaVariable] = useState([props.favoriteFruit]);


    //comportements
    const handleDelete = (id, nom) => {
        // Copie du state
        const fruitsCopy = [...fruits];
        //Manipuler le state
        const fruitsCopyUpdated = fruitsCopy.filter(fruit => fruit.id !== id);
        //Modifier le state
        setFruits(fruitsCopyUpdated);
        console.log("You deleted", nom);
    }
    const handleAdd = (addFruit) => {
        const fruitsCopy = [...fruits];
        fruitsCopy.push(addFruit);
        setFruits(fruitsCopy);
    }



    //affichage(render)
    return (
        <div><h1>Liste de fruits</h1>
            <ul>
                {fruits.map((fruit) =>
                    <DisplayFruit fruitInfo={fruit} onFruitDelete={handleDelete} key={fruit.id} />
                )}</ul>
            <h3>Mon fruit préféré est le/la {maVariable}</h3>
            <FruitForm handleAdd={handleAdd} />
        </div>);
}

export default Fruits;

//Creation du formulaire
//Soumission du formulaire
//COllecte des données du formulaire