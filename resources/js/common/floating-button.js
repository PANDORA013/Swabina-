/**
 * Floating Button Common Module
 * Optimized for low animations and better UX
 * Reduced animation duration from 1.7s to 0.3s for better performance
 */

class FloatingButton {
    constructor(buttonSelector = '.floating-btn') {
        this.btn = document.querySelector(buttonSelector);
        this.floatingBtn = document.querySelector('.floating-btn .btn-img');
        this.icons = document.querySelectorAll('.floating-btn .social-icons .icon');
        this.isDragging = false;
        this.offsetY = 0;
        this.isOpen = false;
        
        if (this.btn) {
            this.init();
        }
    }

    init() {
        this.setupEventListeners();
        this.optimizeAnimations();
    }

    setupEventListeners() {
        // Touch and mouse events for dragging
        this.btn.addEventListener("mousedown", (e) => this.startDrag(e));
        this.btn.addEventListener("touchstart", (e) => this.startDrag(e));
        
        document.addEventListener("mousemove", (e) => this.drag(e));
        document.addEventListener("touchmove", (e) => this.drag(e));
        
        document.addEventListener("mouseup", () => this.endDrag());
        document.addEventListener("touchend", () => this.endDrag());
        
        // Click handler for toggling icons
        this.floatingBtn?.addEventListener('click', (e) => {
            if (!this.isDragging) {
                this.toggleIcons();
            }
        });
    }

    optimizeAnimations() {
        // Reduce animation duration for better performance (low animation approach)
        const style = document.createElement('style');
        style.textContent = `
            .btn-img {
                animation: emergencyLightGlow 0.3s infinite alternate !important;
            }
            
            @keyframes emergencyLightGlow {
                0% {
                    background-color: white;
                    box-shadow: 0 0 2px 2px rgb(216, 215, 215);
                    filter: brightness(1.0);
                }
                100% {
                    background-color: white;
                    box-shadow: 0 0 3px 3px rgb(216, 215, 215);
                    filter: brightness(1.1);
                }
            }
            
            .floating-btn .social-icons .icon {
                transition: all 0.2s ease !important;
            }
        `;
        document.head.appendChild(style);
    }

    toggleIcons() {
        this.isOpen = !this.isOpen;
        const radius = 100; // Reduced radius for better mobile experience
        const totalIcons = this.icons.length;

        this.icons.forEach((icon, index) => {
            if (this.isOpen) {
                const angle = Math.PI / 2 + (Math.PI / (totalIcons - 1)) * index;
                const x = Math.cos(angle) * radius;
                const y = Math.sin(angle) * radius;
                icon.style.transform = `translate(${x}px, ${y}px)`;
                icon.style.opacity = '1';
            } else {
                icon.style.transform = 'translate(0, 0)';
                icon.style.opacity = '0';
            }
        });
    }

    startDrag(e) {
        e.preventDefault();
        this.isDragging = true;
        this.offsetY = (e.clientY || e.touches[0].clientY) - this.btn.getBoundingClientRect().top;
        this.btn.style.cursor = 'grabbing';
    }

    drag(e) {
        if (this.isDragging) {
            const newYPosition = (e.clientY || e.touches[0].clientY) - this.offsetY;
            if (newYPosition >= 0 && (newYPosition + this.btn.offsetHeight) <= window.innerHeight) {
                this.btn.style.top = `${newYPosition}px`;
            }
        }
    }

    endDrag() {
        this.isDragging = false;
        this.btn.style.cursor = 'grab';
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new FloatingButton();
});

export default FloatingButton;
