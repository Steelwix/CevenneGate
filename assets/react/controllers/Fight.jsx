import React, { useState } from 'react';
import { useForm } from "react-hook-form";

function Fight(props) {
    const playerData = JSON.parse(props.player);
    const bossData = JSON.parse(props.boss);
    const [player, setPlayer] = useState([playerData]);
    const [boss, setBoss] = useState([bossData]);
    return (<div class="col-12"><p>Vous rencontrez {bossData.name}</p><br />
        <div class="col-6"><p>{playerData.name} : {playerData.hp}</p><br />
            <button>Attaquer</button><br />
            <button>Utiliser une relique</button><br />
            <button>Utiliser un objet</button><br />
            <button>Fuir</button><br />
        </div><div class="col-12"><p>{bossData.name} : {bossData.hp}</p><br /></div></div>)
}
export default Fight;