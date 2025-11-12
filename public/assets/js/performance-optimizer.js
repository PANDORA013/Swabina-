/**
 * 🚀 PERFORMANCE OPTIMIZATION SCRIPT
 * ================================
 * Centralized performance optimization for all pages
 * Critical CSS inlining, lazy loading, and resource optimization
 */

// Critical CSS inlining for above-the-fold content
const criticalCSS = `
/* Critical styles for immediate rendering */
body { 
  margin: 0; 
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
}

.topheader { 
  background: white; 
  border-bottom: 25px solid white; 
}

.navbar { 
  background-color: #0454a3; 
  position: sticky; 
  top: 0; 
  z-index: 1050; 
}

.carousel-image { 
  height: 70vh; 
  object-fit: cover; 
}

/* Hardware acceleration for smooth animations */
.carousel-item,
.btn,
.nav-link {
  transform: translateZ(0);
  will-change: transform;
}
`;

class PerformanceOptimizer {
    constructor() {
        this.lazyImages = [];
        this.intersectionObserver = null;
        this.performanceMetrics = {};
        
        this.init();
    }

    init() {
        this.inlineCriticalCSS();
        this.setupLazyLoading();
        this.optimizeImages();
        this.setupResourceHints();
        this.monitorPerformance();
        this.optimizeScripts();
        
        console.log('🚀 Performance Optimizer initialized');
    }

    /**
     * Inline critical CSS for faster rendering
     */
    inlineCriticalCSS() {
        const style = document.createElement('style');
        style.textContent = criticalCSS;
        document.head.insertBefore(style, document.head.firstChild);
    }

    /**
     * Setup lazy loading for images and resources
     */
    setupLazyLoading() {
        // Lazy load images
        const images = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            this.intersectionObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        this.intersectionObserver.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            images.forEach(img => {
                this.intersectionObserver.observe(img);
            });
        } else {
            // Fallback for older browsers
            images.forEach(img => {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            });
        }
    }

    /**
     * Optimize images for better performance
     */
    optimizeImages() {
        const images = document.querySelectorAll('img');
        
        images.forEach(img => {
            // Add loading="lazy" for native lazy loading
            if (!img.hasAttribute('loading')) {
                img.setAttribute('loading', 'lazy');
            }

            // Add decode="async" for non-blocking decoding
            img.setAttribute('decoding', 'async');

            // Setup responsive images if not already done
            if (!img.hasAttribute('sizes') && img.classList.contains('img-fluid')) {
                img.setAttribute('sizes', '(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw');
            }
        });
    }

    /**
     * Setup resource hints for better loading
     */
    setupResourceHints() {
        const hints = [
            { rel: 'dns-prefetch', href: 'https://cdn.jsdelivr.net' },
            { rel: 'dns-prefetch', href: 'https://cdnjs.cloudflare.com' },
            { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
            { rel: 'preconnect', href: 'https://fonts.gstatic.com' }
        ];

        hints.forEach(hint => {
            const link = document.createElement('link');
            link.rel = hint.rel;
            link.href = hint.href;
            if (hint.rel === 'preconnect' && hint.href.includes('gstatic')) {
                link.crossOrigin = '';
            }
            document.head.appendChild(link);
        });
    }

    /**
     * Monitor performance metrics
     */
    monitorPerformance() {
        if ('PerformanceObserver' in window) {
            // Monitor Largest Contentful Paint
            const lcpObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                const lastEntry = entries[entries.length - 1];
                this.performanceMetrics.lcp = lastEntry.startTime;
                
                if (lastEntry.startTime > 2500) {
                    console.warn('🐌 LCP is slow:', lastEntry.startTime + 'ms');
                }
            });

            try {
                lcpObserver.observe({ entryTypes: ['largest-contentful-paint'] });
            } catch (e) {
                console.log('LCP monitoring not supported');
            }

            // Monitor First Input Delay
            const fidObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                entries.forEach(entry => {
                    this.performanceMetrics.fid = entry.processingStart - entry.startTime;
                    
                    if (entry.processingStart - entry.startTime > 100) {
                        console.warn('🐌 FID is slow:', entry.processingStart - entry.startTime + 'ms');
                    }
                });
            });

            try {
                fidObserver.observe({ entryTypes: ['first-input'] });
            } catch (e) {
                console.log('FID monitoring not supported');
            }
        }

        // Monitor page load performance
        window.addEventListener('load', () => {
            setTimeout(() => {
                const navigation = performance.getEntriesByType('navigation')[0];
                this.performanceMetrics.loadTime = navigation.loadEventEnd - navigation.loadEventStart;
                this.performanceMetrics.domContentLoaded = navigation.domContentLoadedEventEnd - navigation.domContentLoadedEventStart;
                
                console.log('📊 Performance Metrics:', this.performanceMetrics);
            }, 0);
        });
    }

    /**
     * Optimize script loading
     */
    optimizeScripts() {
        // Defer non-critical scripts
        const nonCriticalScripts = document.querySelectorAll('script[src]:not([async]):not([defer])');
        
        nonCriticalScripts.forEach(script => {
            if (!script.src.includes('bootstrap') && !script.src.includes('minimal-animations')) {
                script.defer = true;
            }
        });

        // Preload critical scripts
        const criticalScripts = [
            '/assets/js/bootstrap.bundle.min.js',
            '/assets/js/minimal-animations.js'
        ];

        criticalScripts.forEach(src => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'script';
            link.href = src;
            document.head.appendChild(link);
        });
    }

    /**
     * Optimize CSS delivery
     */
    optimizeCSS() {
        // Load non-critical CSS asynchronously
        const nonCriticalCSS = [
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css',
            'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css'
        ];

        nonCriticalCSS.forEach(href => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'style';
            link.href = href;
            link.onload = function() {
                this.onload = null;
                this.rel = 'stylesheet';
            };
            document.head.appendChild(link);
        });
    }

    /**
     * Service Worker registration for caching
     */
    setupServiceWorker() {
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('🔧 SW registered:', registration);
                    })
                    .catch(registrationError => {
                        console.log('SW registration failed:', registrationError);
                    });
            });
        }
    }

    /**
     * Cleanup performance observers
     */
    cleanup() {
        if (this.intersectionObserver) {
            this.intersectionObserver.disconnect();
        }
    }
}

/**
 * 🎨 CSS OPTIMIZATION UTILITIES
 */
class CSSOptimizer {
    constructor() {
        this.unusedRules = [];
        this.init();
    }

    init() {
        this.removeUnusedCSS();
        this.optimizeAnimations();
    }

    /**
     * Remove unused CSS rules (development only)
     */
    removeUnusedCSS() {
        if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
            const stylesheets = document.styleSheets;
            
            for (let sheet of stylesheets) {
                try {
                    const rules = sheet.cssRules || sheet.rules;
                    for (let rule of rules) {
                        if (rule.selectorText && !document.querySelector(rule.selectorText)) {
                            this.unusedRules.push(rule.selectorText);
                        }
                    }
                } catch (e) {
                    // Cross-origin stylesheet access
                }
            }
            
            if (this.unusedRules.length > 0) {
                console.log('🧹 Unused CSS rules detected:', this.unusedRules.length);
            }
        }
    }

    /**
     * Optimize animation performance
     */
    optimizeAnimations() {
        // Force hardware acceleration on animated elements
        const animatedElements = document.querySelectorAll('[class*="animate"], [style*="animation"], [style*="transition"]');
        
        animatedElements.forEach(el => {
            if (!el.style.transform.includes('translateZ')) {
                el.style.transform += ' translateZ(0)';
            }
            el.style.willChange = 'transform, opacity';
        });
    }
}

/**
 * 🚀 INITIALIZATION
 */
document.addEventListener('DOMContentLoaded', () => {
    // Initialize optimizers
    window.PerformanceOptimizer = new PerformanceOptimizer();
    window.CSSOptimizer = new CSSOptimizer();
    
    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
        if (window.PerformanceOptimizer) {
            window.PerformanceOptimizer.cleanup();
        }
    });
});

/**
 * 🔧 UTILITY FUNCTIONS
 */
window.PerformanceUtils = {
    // Measure function execution time
    measureFunction: function(func, name) {
        return function(...args) {
            const start = performance.now();
            const result = func.apply(this, args);
            const end = performance.now();
            console.log(`⏱️ ${name} execution time: ${(end - start).toFixed(2)}ms`);
            return result;
        };
    },

    // Get current performance metrics
    getMetrics: function() {
        if (window.PerformanceOptimizer) {
            return window.PerformanceOptimizer.performanceMetrics;
        }
        return {};
    },

    // Force garbage collection (if available)
    forceGC: function() {
        if (window.gc) {
            window.gc();
            console.log('🗑️ Garbage collection forced');
        }
    }
};
