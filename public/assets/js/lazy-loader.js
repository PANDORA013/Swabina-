/**
 * ====================================
 * SWABINA LAZY LOADING SYSTEM
 * High Performance Image Loading
 * ====================================
 */

class SwabinaLazyLoader {
    constructor(options = {}) {
        this.options = {
            rootMargin: options.rootMargin || '50px',
            threshold: options.threshold || 0.01,
            loadDelay: options.loadDelay || 0,
            placeholder: options.placeholder || '/assets/images/placeholder.svg',
            fadeInDuration: options.fadeInDuration || 300
        };
        
        this.images = [];
        this.observer = null;
        this.init();
    }

    init() {
        // Find all lazy images
        this.images = Array.from(document.querySelectorAll('img[data-src], img[loading="lazy"]'));
        
        if ('IntersectionObserver' in window) {
            this.setupIntersectionObserver();
        } else {
            // Fallback: load all images immediately
            this.loadAllImages();
        }
    }

    setupIntersectionObserver() {
        const config = {
            rootMargin: this.options.rootMargin,
            threshold: this.options.threshold
        };

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.loadImage(entry.target);
                }
            });
        }, config);

        this.images.forEach(img => {
            this.observer.observe(img);
            // Add placeholder while loading
            if (!img.src || img.src === window.location.href) {
                img.src = this.options.placeholder;
                img.style.background = '#f0f0f0';
            }
        });
    }

    loadImage(img) {
        const src = img.dataset.src || img.src;
        const srcset = img.dataset.srcset;
        
        if (!src) return;

        // Create a new image to preload
        const tempImg = new Image();
        
        tempImg.onload = () => {
            setTimeout(() => {
                img.src = src;
                if (srcset) img.srcset = srcset;
                
                img.removeAttribute('data-src');
                img.removeAttribute('data-srcset');
                img.classList.add('lazy-loaded');
                
                // Fade in effect
                img.style.opacity = '0';
                img.style.transition = `opacity ${this.options.fadeInDuration}ms ease-in`;
                
                requestAnimationFrame(() => {
                    img.style.opacity = '1';
                });
                
                if (this.observer) {
                    this.observer.unobserve(img);
                }
            }, this.options.loadDelay);
        };
        
        tempImg.onerror = () => {
            img.classList.add('lazy-error');
            console.warn('Failed to load image:', src);
        };
        
        tempImg.src = src;
        if (srcset) tempImg.srcset = srcset;
    }

    loadAllImages() {
        this.images.forEach(img => this.loadImage(img));
    }

    refresh() {
        this.images = Array.from(document.querySelectorAll('img[data-src], img[loading="lazy"]'));
        this.images.forEach(img => {
            if (this.observer) {
                this.observer.observe(img);
            } else {
                this.loadImage(img);
            }
        });
    }

    destroy() {
        if (this.observer) {
            this.observer.disconnect();
        }
    }
}

// Auto-initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    window.swabinaLazyLoader = new SwabinaLazyLoader({
        rootMargin: '100px',
        threshold: 0.01,
        loadDelay: 100,
        fadeInDuration: 400
    });
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = SwabinaLazyLoader;
}
