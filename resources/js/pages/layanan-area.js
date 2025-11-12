/**
 * Layanan Area Page Module
 * Optimized content switching and interaction handling
 */

class LayananArea {
    constructor() {
        this.buttons = document.querySelectorAll('.why-choose-us-btn');
        this.sections = document.querySelectorAll('.why-choose-us-content-section');
        
        this.init();
    }

    init() {
        this.setupContentSwitching();
    }

    setupContentSwitching() {
        if (!this.buttons.length) return;

        this.buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons (optimized loop)
                this.buttons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');

                // Hide all sections efficiently
                this.sections.forEach(section => {
                    section.style.display = 'none';
                });

                // Show target section
                const targetId = button.getAttribute('data-target');
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.style.display = 'block';
                }
            });
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new LayananArea();
});

export default LayananArea;
