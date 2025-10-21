import React from 'react';
import { createRoot } from 'react-dom/client';
import ClickerApp from './components/ClickerApp';
import SliderApp from './components/SliderApp';

const initializeReactComponents = (context = document) => {
  // Premier block - tous les conteneurs
  const clickerContainers = context.querySelectorAll('.react-clicker-app:not(.react-processed)');
  clickerContainers.forEach(container => {
    container.classList.add('react-processed');
    const root = createRoot(container);
    root.render(<ClickerApp />);
  });

  // Second block - tous les conteneurs
  const sliderContainers = context.querySelectorAll('.react-slider-app:not(.react-processed)');
  sliderContainers.forEach(container => {
    container.classList.add('react-processed');
    const root = createRoot(container);
    root.render(<SliderApp />);
  });
};

// Pour le chargement initial
document.addEventListener('DOMContentLoaded', function() {
  initializeReactComponents();
});

// Pour Drupal AJAX
if (typeof Drupal !== 'undefined') {
  Drupal.behaviors.reactComponents = {
    attach: function (context, settings) {
      initializeReactComponents(context);
    }
  };
}