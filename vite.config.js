import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        chunkSizeWarningLimit: 1600,
        rollupOptions: {
            output: {
                manualChunks: {
                    // Vendor libraries
                    vendor: ['axios'],
                    
                    // Bootstrap components (selective loading)
                    bootstrap: ['bootstrap'],
                    
                    // Animation and performance optimizations
                    animations: []
                }
            }
        },
        // Enable tree shaking
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
                unused: true,
                dead_code: true
            }
        }
    },
    server: {
        hmr: {
            host: 'localhost',
        },
        host: '0.0.0.0',
        cors: true
    },
    optimizeDeps: {
        include: ['axios', 'bootstrap']
    },
    // CSS optimization with PostCSS (PurgeCSS)
    css: {
        devSourcemap: true,
        postcss: './postcss.config.cjs',
        preprocessorOptions: {
            css: {
                charset: false
            }
        }
    }
});
