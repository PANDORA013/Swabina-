/**
 * Navbar Common Module
 * Handles responsive navigation with optimized animations
 */

class Navbar {
    constructor() {
        this.navbarToggler = document.querySelector('.navbar-toggler');
        this.navbarCollapse = document.getElementById('navbarNav');
        this.closeBtn = document.querySelector('.close-btn');
        
        if (this.navbarToggler && this.navbarCollapse) {
            this.init();
        }
    }

    init() {
        this.setupEventListeners();
        this.optimizeTransitions();
    }

    setupEventListeners() {
        // Toggle navigation menu
        this.navbarToggler.addEventListener('click', () => {
            this.navbarCollapse.classList.toggle('show');
        });

        // Close navigation menu
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => {
                this.navbarCollapse.classList.remove('show');
            });
        }

        // Close menu when clicking outside (mobile)
        document.addEventListener('click', (e) => {
            if (!this.navbarToggler.contains(e.target) && 
                !this.navbarCollapse.contains(e.target) &&
                this.navbarCollapse.classList.contains('show')) {
                this.navbarCollapse.classList.remove('show');
            }
        });
    }

    optimizeTransitions() {
        // Optimize navbar transitions for better performance
        const style = document.createElement('style');
        style.textContent = `
            .navbar-collapse {
                transition: right 0.2s ease !important;
            }
            
            .navbar-collapse.show {
                transform: translateX(0) !important;
            }
        `;
        document.head.appendChild(style);
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new Navbar();
});

export default Navbar;
