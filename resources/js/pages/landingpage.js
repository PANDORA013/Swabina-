/**
 * Landing Page Specific Module
 * Optimized carousel and tab functionality with minimal animations
 */

// Import only the Bootstrap components we need
import { Carousel, Tab } from 'bootstrap';

class LandingPage {
    constructor() {
        this.carousel = document.querySelector('#carouselExampleFade');
        this.dots = document.querySelectorAll('.carousel-controls .dot');
        this.aboutTabs = document.querySelectorAll('#aboutTab .nav-link');
        
        this.init();
    }

    init() {
        this.setupCarousel();
        this.setupTabs();
    }

    setupCarousel() {
        if (!this.carousel) return;

        // Initialize Bootstrap carousel with optimized settings
        const carouselInstance = new Carousel(this.carousel, {
            interval: 5000, // Increased interval for better UX
            wrap: true,
            keyboard: true
        });

        // Handle carousel slide events with minimal DOM manipulation
        this.carousel.addEventListener('slid.bs.carousel', (event) => {
            const index = Array.from(event.relatedTarget.parentNode.children).indexOf(event.relatedTarget);
            this.updateCarouselDots(index);
        });

        // Add event listeners to dots with debouncing
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', this.debounce((e) => {
                const slideIndex = e.target.getAttribute('data-bs-slide-to');
                carouselInstance.to(slideIndex);
            }, 150));
        });
    }

    updateCarouselDots(activeIndex) {
        this.dots.forEach((dot, i) => {
            dot.style.backgroundColor = i === activeIndex ? '#0454a3' : 'white';
        });
    }

    setupTabs() {
        if (!this.aboutTabs.length) return;

        this.aboutTabs.forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                
                // Remove active state from all tabs
                this.aboutTabs.forEach((nav) => {
                    nav.style.backgroundColor = '';
                    nav.style.color = '#0454a3';
                });

                // Set active state with optimized styling
                link.style.backgroundColor = '#0454a3';
                link.style.color = 'white';

                // Initialize Bootstrap tab if not already done
                const tab = new Tab(link);
                tab.show();
            });
        });
    }

    // Utility function for debouncing rapid clicks
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new LandingPage();
});

export default LandingPage;
