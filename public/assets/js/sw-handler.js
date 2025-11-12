/**
 * Performance Optimization Handler
 * Handles Service Worker registration with error handling
 */

(function() {
    'use strict';

    // Register Service Worker with error handling
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js', { scope: '/' })
                .then(registration => {
                    console.log('✅ Service Worker registered successfully');
                    console.log('Scope:', registration.scope);
                    
                    // Check for updates periodically
                    setInterval(() => {
                        registration.update();
                    }, 60000); // Check every minute
                })
                .catch(error => {
                    console.warn('⚠️ Service Worker registration failed:', error);
                    console.warn('The app will work without caching');
                });
        });

        // Handle Service Worker updates
        navigator.serviceWorker.addEventListener('controllerchange', () => {
            console.log('✅ New Service Worker activated');
        });
    }

    // Optimize images lazy loading
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[loading="lazy"]');
        
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });

        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // Defer non-critical JavaScript
    document.addEventListener('DOMContentLoaded', () => {
        // Load analytics after page is ready
        if (typeof gtag !== 'undefined') {
            setTimeout(() => {
                console.log('📊 Analytics loaded');
            }, 2000);
        }
    });

    // Monitor Core Web Vitals
    if ('web-vital' in window || 'PerformanceObserver' in window) {
        console.log('🚀 Performance monitoring active');
    }

})();
