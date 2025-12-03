/**
 * Service Worker for PT Swabina Gatra
 * Caching Strategy for Performance
 */

const CACHE_VERSION = 'swabina-v1.0';
const CACHE_NAME = `swabina-cache-${CACHE_VERSION}`;

// Assets to cache immediately (only essential files)
const PRECACHE_ASSETS = [
    '/',
    '/assets/css/swabina-main.css',
    '/assets/js/lazy-loader.js'
];

// Install event - cache critical assets with error handling
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                // Try to cache each asset individually
                return Promise.allSettled(
                    PRECACHE_ASSETS.map(asset =>
                        fetch(asset).then(response => {
                            if (response.ok) {
                                return cache.put(asset, response);
                            }
                        }).catch(err => {
                            console.warn(`Failed to cache ${asset}:`, err);
                        })
                    )
                );
            })
            .then(() => self.skipWaiting())
            .catch(err => console.error('Cache installation error:', err))
    );
});

// Activate event - clean old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys()
            .then(cacheNames => {
                return Promise.all(
                    cacheNames
                        .filter(name => name.startsWith('swabina-cache-') && name !== CACHE_NAME)
                        .map(name => caches.delete(name))
                );
            })
            .then(() => self.clients.claim())
    );
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);

    // Skip cross-origin requests
    if (url.origin !== location.origin) {
        return;
    }

    // Handle different types of requests
    if (request.destination === 'image') {
        event.respondWith(handleImageRequest(request));
    } else if (request.destination === 'style' || request.destination === 'script') {
        event.respondWith(handleAssetRequest(request));
    } else {
        event.respondWith(handleDocumentRequest(request));
    }
});

// Image caching strategy: Cache first, fallback to network
async function handleImageRequest(request) {
    const cache = await caches.open(CACHE_NAME);
    const cached = await cache.match(request);
    
    if (cached) {
        return cached;
    }
    
    try {
        const response = await fetch(request);
        if (response.ok) {
            cache.put(request, response.clone());
        }
        return response;
    } catch (error) {
        // Return placeholder if offline
        return new Response('', { status: 404 });
    }
}

// Asset caching strategy: Cache first, update in background
async function handleAssetRequest(request) {
    const cache = await caches.open(CACHE_NAME);
    const cached = await cache.match(request);
    
    const fetchPromise = fetch(request).then(response => {
        if (response.ok) {
            cache.put(request, response.clone());
        }
        return response;
    }).catch(error => {
        console.warn(`Failed to fetch ${request.url}:`, error);
        return new Response('', { status: 404 });
    });
    
    return cached || fetchPromise;
}

// Document caching strategy: Network first, fallback to cache
async function handleDocumentRequest(request) {
    try {
        const response = await fetch(request);
        if (response.ok) {
            const cache = await caches.open(CACHE_NAME);
            cache.put(request, response.clone());
        }
        return response;
    } catch (error) {
        const cached = await caches.match(request);
        if (cached) {
            return cached;
        }
        // Return offline page
        return new Response('Offline', { status: 503 });
    }
}
