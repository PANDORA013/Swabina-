import './bootstrap';

// Import only necessary Bootstrap components for better performance
import { Modal, Tooltip, Popover, Carousel, Tab } from 'bootstrap';

// Import common modules
import './common/floating-button.js';
import './common/navbar.js';

// Modern JavaScript utilities with optimized Bootstrap usage
class App {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.initializeComponents();
    }

    setupEventListeners() {
        // DOM Content Loaded
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Laravel App Initialized - Optimized');
        });

        // Handle AJAX errors globally
        window.addEventListener('unhandledrejection', (event) => {
            console.error('Unhandled promise rejection:', event.reason);
        });
    }

    initializeComponents() {
        // Initialize components with lazy loading approach
        this.initializeTooltips();
        this.initializeModals();
        this.initializePopovers();
    }

    initializeTooltips() {
        // Initialize Bootstrap tooltips only when elements exist
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        if (tooltipTriggerList.length > 0) {
            tooltipTriggerList.forEach(tooltipTriggerEl => {
                new Tooltip(tooltipTriggerEl, {
                    // Optimize tooltip performance
                    animation: false, // Disable animations for better performance
                    trigger: 'hover focus'
                });
            });
        }
    }

    initializeModals() {
        // Initialize Bootstrap modals only when needed
        const modalElements = document.querySelectorAll('.modal');
        if (modalElements.length > 0) {
            modalElements.forEach(modalEl => {
                new Modal(modalEl, {
                    // Optimize modal performance
                    backdrop: true,
                    keyboard: true,
                    focus: true
                });
            });
        }
    }

    initializePopovers() {
        // Initialize Bootstrap popovers only when elements exist
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        if (popoverTriggerList.length > 0) {
            popoverTriggerList.forEach(popoverTriggerEl => {
                new Popover(popoverTriggerEl, {
                    // Optimize popover performance
                    animation: false,
                    trigger: 'click'
                });
            });
        }
    }
}

// Initialize app
const app = new App();

// Make bootstrap components globally available for legacy code
window.Bootstrap = { Modal, Tooltip, Popover, Carousel, Tab };

export default app;
