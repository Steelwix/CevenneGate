
import React, { useState, useEffect } from 'react';
function Fight(props) {
    const playerData = JSON.parse(props.playerState);
    const bossData = JSON.parse(props.bossState);
    const [player, setPlayer] = useState(playerData);
    const [boss, setBoss] = useState(bossData);
    const [object, setObject] = useState(null);
    const [relic, setRelic] = useState(null);
    const [consoleOutput, setConsoleOutput] = useState(['Le combat commence :']);
    //Functions

    const dodgeSystem = (object, target) => {
        const maxDodge = object.speed + target.speed;
        const randMaxDodge = Math.random();
        const dodgeChance = Math.random();
        if (randMaxDodge * maxDodge < dodgeChance * target.speed) {
            console.log(target.name, " A esquivé le coup de ", object.name);
            setConsoleOutput(prevState => [...prevState, `${target.name} A esquivé le coup de ${object.name}`]);

            return true;
        }

        return false;
    }
    const armorSystem = (target, damage) => {
        let armorEfficient = 75 * (1 - Math.exp(-target.armor / 100));
        let finalDamage = damage - (damage * (armorEfficient / 100));
        return finalDamage;

    }

    const setDamage = (object, target) => {
        let damage = object.physicalDamage;
        const randomValue = Math.random();
        if (object.critChance > randomValue) {
            damage = object.physicalDamage + (object.physicalDamage * object.critDamage);
            console.log("CRITIQUE");
            setConsoleOutput(prevState => [...prevState, `CRITIQUE!`]);
        }
        if (dodgeSystem(object, target)) {
            return damage = 0;
        }
        damage = armorSystem(target, damage);
        return damage;

    }
    const handlerPlayerAttack = () => {
        let damage = setDamage(player, boss);
        setBoss({ ...boss, hp: boss.hp - damage });
        console.log("Le boss a subi ", damage);
        setConsoleOutput(prevState => [...prevState, `${boss.name} a subi ${damage}`]);
        bossAttack();
    }
    const bossAttack = () => {
        let damage = setDamage(boss, player);
        setPlayer({ ...player, hp: player.hp - damage });
        setConsoleOutput(prevState => [...prevState, `Vous subissez ${damage}`]);
        console.log("Vous subissez ", damage);


    }
    const roundTurn = () => {
        if (boss.speed * Math.random() > player.speed * Math.random()) {

            console.log(boss.name, " Vous prend par surprise");
            setConsoleOutput(prevState => [...prevState, `${boss.name} Vous prend par surprise`]);

            bossAttack();
        }

    }
    useEffect(() => {
        // Code à exécuter dès l'ouverture de la page
        roundTurn();
    }, []);
    while (player.hp > 0 && boss.hp > 0) {



        return (<section className="container"><div className="row"><div className="col-12 text-center"><h1>Vous rencontrez {boss.name}</h1></div>
            <div className="col-6"><p>{player.name} : {player.hp}/{player.maxhp}</p>
                <strong> <button onClick={handlerPlayerAttack}>Attaquer </button><br />
                    {relic && <button>Utiliser une relique</button>}<br />
                    {object && <button>Utiliser un objet</button>}<br />
                    <button>Fuir</button></strong><br />
            </div><div className="col-6"><p>{boss.name} : {boss.hp}/ {boss.maxhp}</p></div>
            <div className="col-6"> <ul>{consoleOutput.map((output, index) => (
                <li key={index}>{output}</li>
            ))}</ul></div></div></section >);
    }
    if (player.hp <= 0) {
        return (<div>Vous êtes mort</div>);
    }
    return (<div>Vous avez vaincu {boss.name}</div>);
}
export default Fight;