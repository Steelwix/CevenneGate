
import React, { useState } from 'react';
import { useForm } from "react-hook-form";

function Fight(props) {
    const playerData = JSON.parse(props.playerState);
    const bossData = JSON.parse(props.bossState);

    const [player, setPlayer] = useState(playerData);
    const [boss, setBoss] = useState(bossData);
    while (player.hp > 0 && boss.hp > 0) {
        console.log(player);
        const luckCall = () => {
            const randomValue = Math.random();
            return randomValue;
        }
        const handlerPlayerAttack = () => {
            let damage = player.physicalDamage;
            let luck = luckCall();
            if (player.critChance > luck) {
                damage = player.physicalDamage * player.critDamage;
                console.log("CRITIQUE ", damage, luck);
            }
            setBoss({ ...boss, hp: boss.hp - damage });
            console.log("Le boss a subi ", damage);
            setPlayer({ ...player, hp: player.hp - boss.physicalDamage });
            console.log("Vous subissez ", boss.physicalDamage);

        }

        return (<section class="container"><div class="row"><div class="col-12 text-center"><h1>Vous rencontrez {boss.name}</h1></div>
            <div class="col-6"><p>{player.name} : {player.hp}</p>
                <button onClick={handlerPlayerAttack}>Attaquer</button><br />
                <button>Utiliser une relique</button><br />
                <button>Utiliser un objet</button><br />
                <button>Fuir</button><br />
            </div><div class="col-6"><p>{boss.name} : {boss.hp}</p></div></div></section >);
    }

    return (<div>NTM</div>);

}
export default Fight;