import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './components/App';
import SecondApp from './components/SecondApp';

document.addEventListener('DOMContentLoaded', function() {
  // Premier block - tous les conteneurs
  document.querySelectorAll('.react-app').forEach(container => {
    const root = createRoot(container);
    root.render(<App />);
  });

  // Second block - tous les conteneurs
  document.querySelectorAll('.react-app-2').forEach(container => {
    const root = createRoot(container);
    root.render(<SecondApp />);
  });
});