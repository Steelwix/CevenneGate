import React, { useState } from 'react';
import { useForm } from "react-hook-form";

function Fight(props) {
    const playerData = JSON.parse(props.player);
    const [player, setPlayer] = useState([playerData]);
    const [boss, setBoss] = useState([props.boss]);
    console.log(props.player);
    console.log(player);
    console.log(playerData);
    return (<div><p>Vous êtes {playerData.name}</p></div>)
}
export default Fight;