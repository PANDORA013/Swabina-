/**
 * Image Optimization Utility
 * Handles WebP conversion and lazy loading implementation
 */

class ImageOptimizer {
    constructor() {
        this.init();
    }

    init() {
        this.setupLazyLoading();
        this.setupWebPSupport();
    }

    // Native lazy loading for images
    setupLazyLoading() {
        const images = document.querySelectorAll('img:not([loading])');
        images.forEach(img => {
            // Add native lazy loading to images below the fold
            const rect = img.getBoundingClientRect();
            if (rect.top > window.innerHeight) {
                img.setAttribute('loading', 'lazy');
            }
        });
    }

    // WebP support detection and fallback
    setupWebPSupport() {
        const webPSupported = this.supportsWebP();
        
        if (webPSupported) {
            // Replace image sources with WebP versions if available
            const images = document.querySelectorAll('img[data-webp]');
            images.forEach(img => {
                img.src = img.getAttribute('data-webp');
            });
        }
    }

    supportsWebP() {
        const canvas = document.createElement('canvas');
        canvas.width = 1;
        canvas.height = 1;
        return canvas.toDataURL('image/webp').indexOf('data:image/webp') === 0;
    }

    // Optimize image loading with Intersection Observer
    observeImages() {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });

        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => imageObserver.observe(img));
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new ImageOptimizer();
});

export default ImageOptimizer;
