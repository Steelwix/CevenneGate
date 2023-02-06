import React, { useState } from 'react';

function Heroe() {
    const handleClick = () => {

        window.location = "/fight";


    }

    return (<button onClick={handleClick}>Skip</button>)
}
export default Heroe;