import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './components/App';
import SecondApp from './components/SecondApp';

document.addEventListener('DOMContentLoaded', function() {
  // Premier block
  const container = document.getElementById('react-app');
  if (container) {
    const root = createRoot(container);
    root.render(<App />);
  }

  // Second block (Slider)
  const sliderContainer = document.getElementById('react-app-2');
  if (sliderContainer) {
    const sliderRoot = createRoot(sliderContainer);
    sliderRoot.render(<SecondApp />);
  }
});