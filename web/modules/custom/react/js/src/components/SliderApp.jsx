import { Slider } from '@mui/material';
import React, { useEffect, useState, useRef } from 'react';

const SliderApp = () => {
  const containerRef = useRef(null);
  const [value, setValue] = useState(30);
  const [initialized, setInitialized] = useState(false);
  
  const getHiddenInput = () => {
    if (!containerRef.current) return null;
    const wrapper = containerRef.current.closest('.react-slider-wrapper');
    return wrapper?.querySelector('input.react-slider-value') || null;
  };

  useEffect(() => {
    if (initialized) return;
    
    setTimeout(() => {
      const input = getHiddenInput();
      if (input) {
        const initialValue = parseInt(input.getAttribute('data-initial-value') || input.value || '30', 10);
        setValue(initialValue);
        setInitialized(true);
      }
    }, 200);
  }, [initialized]);

  useEffect(() => {
    if (!initialized) return;
    
    const input = getHiddenInput();
    if (input) {
      input.value = value;
      input.dispatchEvent(new Event('change', { bubbles: true }));
      input.dispatchEvent(new Event('input', { bubbles: true }));
    }
  }, [value, initialized]);

  return (
    <div ref={containerRef}>
      <Slider
        value={value} 
        onChange={(_, newValue) => setValue(newValue)}
        aria-label="Temperature" 
        color="secondary" 
        step={10} 
        marks 
        min={10}
        max={100} 
        valueLabelDisplay="on"
      />
    </div>
  );
};

export default SliderApp;