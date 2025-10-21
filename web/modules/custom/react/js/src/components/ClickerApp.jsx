import React, { useEffect, useRef, useState } from 'react';

const ClickerApp = () => {
  const containerRef = useRef(null);
  const [count, setCount] = useState(0);
  const [initialized, setInitialized] = useState(false);
  
  const getHiddenInput = () => {
    if (!containerRef.current) return null;
    const wrapper = containerRef.current.closest('.react-clicker-wrapper');
    return wrapper?.querySelector('input.react-clicker-value') || null;
  };

  useEffect(() => {
    if (initialized) return;
    
    setTimeout(() => {
      const input = getHiddenInput();
      if (input) {
        const initialValue = parseInt(input.getAttribute('data-initial-value') || input.value || '0', 10);
        setCount(initialValue);
        setInitialized(true);
      }
    }, 200);
  }, [initialized]);

  useEffect(() => {
    if (!initialized) return;
    
    const input = getHiddenInput();
    if (input) {
      input.value = count;
      input.dispatchEvent(new Event('change', { bubbles: true }));
      input.dispatchEvent(new Event('input', { bubbles: true }));
    }
  }, [count, initialized]);

  return (
    <div ref={containerRef}>
      <p>Counter: {count}</p>
      <button 
        type="button" 
        onClick={(e) => {
          e.preventDefault();
          e.stopPropagation();
          setCount(prev => prev + 1);
        }}
      >
        Click me
      </button>
    </div>
  );
};

export default ClickerApp;