import React, { useState } from 'react';
import { useForm } from "react-hook-form";

function Home() {

    const [playerName, setPlayerName] = useState("");
    const handleChange = (event) => {
        setPlayerName(event.target.value);

    }
    const handleSubmit = (event) => {
        event.preventDefault();
        fetch("/newheroe", {
            method: "POST",
            redirect: 'follow',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ text: playerName })

        }).then(response => {
            if (response.ok) {
                window.location = "/avatar";
            }
        })
            .catch(error => console.error(error));
        console.log(playerName);

    }

    return (<div><form action="submit" onSubmit={handleSubmit}>
        <input value={playerName} type="text" placeholder='votre nom...' onChange={handleChange} />
        <button>Ajouter</button></form></div>)
}
export default Home;