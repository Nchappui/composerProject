import { Slider } from '@mui/material';
import React from 'react';


const SliderApp = () => {

  return (
    <div>

        <Slider defaultValue={30} step={10} marks min={10} max={110} />
    </div>
  );
};

export default SliderApp;