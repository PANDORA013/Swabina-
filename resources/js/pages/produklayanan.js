/**
 * Produk & Layanan Page Module
 * Optimized carousel and floating menu functionality
 */

// Import selective Bootstrap components
import { Carousel } from 'bootstrap';

class ProdukLayanan {
    constructor() {
        this.carousel = document.querySelector('#carouselExampleFade');
        this.dots = document.querySelectorAll('.carousel-controls .dot');
        
        this.init();
    }

    init() {
        this.setupCarousel();
    }

    setupCarousel() {
        if (!this.carousel) return;

        // Initialize carousel with performance optimizations
        const carouselInstance = new Carousel(this.carousel, {
            interval: 4000,
            wrap: true,
            keyboard: true,
            pause: 'hover' // Pause on hover for better UX
        });

        // Optimized slide event handler
        this.carousel.addEventListener('slid.bs.carousel', (event) => {
            const index = Array.from(event.relatedTarget.parentNode.children).indexOf(event.relatedTarget);
            this.updateDots(index);
        });

        // Dot click handlers with event delegation
        if (this.dots.length) {
            this.dots.forEach((dot) => {
                dot.addEventListener('click', (e) => {
                    const index = e.target.getAttribute('data-bs-slide-to');
                    carouselInstance.to(parseInt(index));
                });
            });
        }
    }

    updateDots(activeIndex) {
        this.dots.forEach((dot, i) => {
            dot.style.backgroundColor = i === activeIndex ? '#0454a3' : 'white';
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new ProdukLayanan();
});

export default ProdukLayanan;
