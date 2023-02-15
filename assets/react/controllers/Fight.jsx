import React, { useState } from 'react';
import { useForm } from "react-hook-form";

function Fight(props) {
    const playerData = JSON.parse(props.playerState);
    const bossData = JSON.parse(props.bossState);

    const [player, setPlayer] = useState(playerData);
    const [boss, setBoss] = useState(bossData);

    const handlerPlayerAttack = () => {
        setBoss({ ...boss, hp: boss.hp - playerData.physicalDamage });
        console.log("The boss took ", playerData.physicalDamage);

    }
    while (player.hp > 0 && boss.hp > 0) {
        return (<section class="container"><div class="row"><div class="col-12 text-center"><h1>Vous rencontrez {bossData.name}</h1></div>
            <div class="col-6"><p>{playerData.name} : {playerData.hp}</p>
                <button onClick={handlerPlayerAttack}>Attaquer</button><br />
                <button>Utiliser une relique</button><br />
                <button>Utiliser un objet</button><br />
                <button>Fuir</button><br />
            </div><div class="col-6"><p>{bossData.name} : {boss.hp}</p></div></div></section >);
    }

    return (<div>NTM</div>);

}
export default Fight;