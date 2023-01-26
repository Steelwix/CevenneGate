import React, { useState } from 'react';

function Heroe() {
    const handleClick = () => {

        window.location = "/react";


    }

    return (<button onClick={handleClick}>Skip</button>)
}
export default Heroe;