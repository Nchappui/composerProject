import { createRoot } from 'react-dom/client';
import ClickerApp from './components/ClickerApp';
import SliderApp from './components/SliderApp';
import React from 'react';

document.addEventListener('DOMContentLoaded', function() {
  // Premier block - tous les conteneurs
  document.querySelectorAll('.react-clicker-app').forEach(container => {
    const root = createRoot(container);
    root.render(<ClickerApp />);
  });

  // Second block - tous les conteneurs
  document.querySelectorAll('.react-slider-app').forEach(container => {
    const root = createRoot(container);
    root.render(<SliderApp />);
  });
});