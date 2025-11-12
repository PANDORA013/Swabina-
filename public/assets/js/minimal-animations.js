/**
 * 🚀 MINIMAL ANIMATIONS & PERFORMANCE MANAGER
 * ==========================================
 * Centralized animation and performance optimization system
 * Handles reduced motion preferences, performance monitoring, and animation coordination
 */

class MinimalAnimationManager {
    constructor() {
        this.prefersReducedMotion = false;
        this.performanceObserver = null;
        this.intersectionObserver = null;
        this.animationFrameId = null;
        
        this.init();
    }

    /**
     * Initialize the animation system
     */
    init() {
        this.detectMotionPreference();
        this.setupPerformanceMonitoring();
        this.setupIntersectionObserver();
        this.optimizeExistingAnimations();
        this.setupEventListeners();
        
        console.log('🎯 Minimal Animation Manager initialized');
    }

    /**
     * Detect user's motion preferences
     */
    detectMotionPreference() {
        this.prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        
        // Listen for changes in motion preference
        window.matchMedia('(prefers-reduced-motion: reduce)').addEventListener('change', (e) => {
            this.prefersReducedMotion = e.matches;
            this.updateAnimationState();
        });
    }

    /**
     * Setup performance monitoring
     */
    setupPerformanceMonitoring() {
        if ('PerformanceObserver' in window) {
            this.performanceObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                entries.forEach(entry => {
                    if (entry.duration > 16) { // Frame drops
                        console.warn('🐌 Animation performance issue:', entry.name, entry.duration + 'ms');
                    }
                });
            });
            
            try {
                this.performanceObserver.observe({ entryTypes: ['measure', 'navigation'] });
            } catch (e) {
                console.log('Performance monitoring not fully supported');
            }
        }
    }

    /**
     * Setup intersection observer for lazy animations
     */
    setupIntersectionObserver() {
        if ('IntersectionObserver' in window) {
            this.intersectionObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.activateAnimation(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '50px'
            });
        }
    }

    /**
     * Optimize existing heavy animations
     */
    optimizeExistingAnimations() {
        // Replace heavy floating button animations
        const floatingBtns = document.querySelectorAll('.btn-img');
        floatingBtns.forEach(btn => {
            btn.classList.remove('emergencyLightGlow');
            btn.classList.add('floating-btn-optimized');
        });

        // Replace heavy scroll indicators
        const scrollIndicators = document.querySelectorAll('.scroll-indicator');
        scrollIndicators.forEach(indicator => {
            indicator.style.animation = '';
            indicator.classList.add('scroll-indicator-minimal');
        });

        // Optimize carousel transitions
        const carouselItems = document.querySelectorAll('.carousel-item');
        carouselItems.forEach(item => {
            item.classList.add('carousel-item-optimized');
        });

        // Add hardware acceleration to animated elements
        const animatedElements = document.querySelectorAll('[class*="animation"], [style*="animation"]');
        animatedElements.forEach(el => {
            el.classList.add('hw-accelerated');
        });
    }

    /**
     * Setup event listeners for interactive animations
     */
    setupEventListeners() {
        // Optimize hover effects
        this.setupOptimizedHovers();
        
        // Setup intersection observer for lazy animations
        document.querySelectorAll('.fade-in-minimal').forEach(el => {
            if (this.intersectionObserver) {
                this.intersectionObserver.observe(el);
            }
        });
    }

    /**
     * Setup optimized hover effects
     */
    setupOptimizedHovers() {
        // Replace heavy hover effects with minimal ones
        const hoverElements = document.querySelectorAll('button, .btn, .nav-link');
        
        hoverElements.forEach(el => {
            // Remove existing heavy hover classes
            el.classList.remove('heavy-hover', 'complex-hover');
            
            // Add minimal hover class
            if (!el.classList.contains('no-hover')) {
                el.classList.add('btn-minimal-hover');
            }
        });

        // Setup navigation link effects
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.classList.add('nav-link-minimal');
        });
    }

    /**
     * Activate animation when element comes into view
     */
    activateAnimation(element) {
        if (this.prefersReducedMotion) {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
            return;
        }

        element.style.animationPlayState = 'running';
        element.classList.add('animate-in');
    }

    /**
     * Update animation state based on user preferences
     */
    updateAnimationState() {
        const body = document.body;
        
        if (this.prefersReducedMotion) {
            body.classList.add('reduce-motion');
            this.pauseHeavyAnimations();
        } else {
            body.classList.remove('reduce-motion');
            this.resumeAnimations();
        }
    }

    /**
     * Pause heavy animations for performance/accessibility
     */
    pauseHeavyAnimations() {
        const heavyAnimations = document.querySelectorAll('[class*="infinite"], [class*="pulse"], [class*="glow"]');
        heavyAnimations.forEach(el => {
            el.style.animationPlayState = 'paused';
        });
    }

    /**
     * Resume animations
     */
    resumeAnimations() {
        const pausedAnimations = document.querySelectorAll('[style*="animation-play-state: paused"]');
        pausedAnimations.forEach(el => {
            el.style.animationPlayState = 'running';
        });
    }

    /**
     * Throttled animation frame helper
     */
    requestAnimationFrame(callback) {
        if (this.animationFrameId) {
            cancelAnimationFrame(this.animationFrameId);
        }
        
        this.animationFrameId = requestAnimationFrame(() => {
            performance.mark('animation-start');
            callback();
            performance.mark('animation-end');
            performance.measure('animation-duration', 'animation-start', 'animation-end');
        });
    }

    /**
     * Optimize page transitions
     */
    optimizePageTransitions() {
        // Add page transition optimization
        document.addEventListener('beforeunload', () => {
            // Pause all animations before page unload
            document.body.style.animation = 'none';
            document.body.style.transition = 'none';
        });
    }

    /**
     * Performance metrics
     */
    getPerformanceMetrics() {
        return {
            reducedMotion: this.prefersReducedMotion,
            activeAnimations: document.querySelectorAll('[style*="animation"]:not([style*="none"])').length,
            hardwareAccelerated: document.querySelectorAll('.hw-accelerated').length
        };
    }

    /**
     * Cleanup method
     */
    destroy() {
        if (this.performanceObserver) {
            this.performanceObserver.disconnect();
        }
        
        if (this.intersectionObserver) {
            this.intersectionObserver.disconnect();
        }
        
        if (this.animationFrameId) {
            cancelAnimationFrame(this.animationFrameId);
        }
    }
}

/**
 * 🎨 CAROUSEL OPTIMIZATION
 */
class OptimizedCarousel {
    constructor(element, options = {}) {
        this.element = element;
        this.options = {
            interval: options.interval || 4000,
            animationDuration: options.animationDuration || 600,
            pauseOnHover: options.pauseOnHover !== false,
            ...options
        };
        
        this.init();
    }

    init() {
        // Optimize carousel for performance
        const items = this.element.querySelectorAll('.carousel-item');
        items.forEach(item => {
            item.style.transition = `transform ${this.options.animationDuration}ms ease-in-out`;
            item.classList.add('hw-accelerated');
        });

        // Setup intersection observer to pause when not visible
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.resume();
                    } else {
                        this.pause();
                    }
                });
            });
            
            observer.observe(this.element);
        }
    }

    pause() {
        this.element.classList.add('carousel-paused');
    }

    resume() {
        this.element.classList.remove('carousel-paused');
    }
}

/**
 * 🚀 INITIALIZATION
 */
document.addEventListener('DOMContentLoaded', () => {
    // Initialize animation manager
    window.MinimalAnimationManager = new MinimalAnimationManager();
    
    // Optimize existing carousels
    document.querySelectorAll('.carousel').forEach(carousel => {
        new OptimizedCarousel(carousel);
    });
    
    // Performance monitoring
    if (typeof window.performance !== 'undefined') {
        window.addEventListener('load', () => {
            setTimeout(() => {
                const metrics = window.MinimalAnimationManager.getPerformanceMetrics();
                console.log('🎯 Animation Performance Metrics:', metrics);
            }, 1000);
        });
    }
});

/**
 * 🔧 UTILITY FUNCTIONS
 */
window.AnimationUtils = {
    // Debounced animation trigger
    debounceAnimation: function(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    // Check if element is in viewport
    isInViewport: function(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    },

    // Smooth scroll with reduced motion support
    smoothScrollTo: function(target, duration = 1000) {
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        
        if (prefersReducedMotion) {
            target.scrollIntoView();
            return;
        }

        target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
};
