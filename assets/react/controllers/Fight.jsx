
import React, { useState, useEffect } from 'react';
function Fight(props) {
    const playerData = JSON.parse(props.playerState);
    const bossData = JSON.parse(props.bossState);
    const [player, setPlayer] = useState(playerData);
    const [boss, setBoss] = useState(bossData);
    const [object, setObject] = useState(null);
    const [relic, setRelic] = useState(null);
    //Functions
    const dodgeSystem = (object, target) => {
        const maxDodge = object.speed + target.speed;
        const randMaxDodge = Math.random();
        const dodgeChance = Math.random();
        if (randMaxDodge * maxDodge < dodgeChance * target.speed) {
            console.log(target.name, " A esquivé le coup de ", object.name);
            return true;
        }

        return false;
    }

    const setDamage = (object, target) => {
        let damage = object.physicalDamage;
        const randomValue = Math.random();
        if (object.critChance > randomValue) {
            damage = object.physicalDamage * object.critDamage;
            console.log("CRITIQUE");
        }
        if (dodgeSystem(object, target)) {
            return damage = 0;
        }
        return damage;

    }
    const handlerPlayerAttack = () => {
        let damage = setDamage(player, boss);
        setBoss({ ...boss, hp: boss.hp - damage });
        console.log("Le boss a subi ", damage);
        bossAttack();
    }
    const bossAttack = () => {
        let damage = setDamage(boss, player);
        setPlayer({ ...player, hp: player.hp - damage });
        console.log("Vous subissez ", damage);

    }
    const roundTurn = () => {
        if (boss.speed * Math.random() > player.speed * Math.random()) {
            console.log(boss.name, " Vous prend par surprise")
            bossAttack();
        }
    }
    useEffect(() => {
        // Code à exécuter dès l'ouverture de la page
        roundTurn();
    }, []);
    while (player.hp > 0 && boss.hp > 0) {



        return (<section class="container"><div class="row"><div class="col-12 text-center"><h1>Vous rencontrez {boss.name}</h1></div>
            <div class="col-6"><p>{player.name} : {player.hp}</p>
                <button onClick={handlerPlayerAttack}>Attaquer</button><br />
                {relic && <button>Utiliser une relique</button>}<br />
                {object && <button>Utiliser un objet</button>}<br />
                <button>Fuir</button><br />
            </div><div class="col-6"><p>{boss.name} : {boss.hp}</p></div></div></section >);
    }

    return (<div>FIN</div>);

}
export default Fight;