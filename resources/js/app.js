import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';

// Bind Alpine and Chart.js to the window object
window.Alpine = Alpine;
window.Chart = Chart;

// Start Alpine.js
document.addEventListener('DOMContentLoaded', () => {
    console.log('Alpine is starting');
    Alpine.start();
});