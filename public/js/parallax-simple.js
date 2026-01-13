/**
 * Lightweight Parallax System
 * CPU-friendly parallax using transform
 */

(function() {
    'use strict';

    // Respect reduced motion preference
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    let ticking = false;
    let parallaxElements = [];

    function initParallax() {
        // Find all parallax elements
        parallaxElements = Array.from(document.querySelectorAll('[data-parallax]'));
        
        if (!parallaxElements.length) return;

        // Set initial transform style
        parallaxElements.forEach(el => {
            el.style.willChange = 'transform';
        });

        // Start listening to scroll
        window.addEventListener('scroll', requestTick, { passive: true });
        
        // Initial update
        updateParallax();
    }

    function requestTick() {
        if (!ticking) {
            window.requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }

    function updateParallax() {
        const scrolled = window.pageYOffset;
        
        parallaxElements.forEach(el => {
            // Get speed from data attribute (default 0.5)
            const speed = parseFloat(el.dataset.parallaxSpeed || el.dataset.parallax || 0.5);
            const yPos = -(scrolled * speed);
            
            // Use transform3d for GPU acceleration
            el.style.transform = `translate3d(0, ${yPos}px, 0)`;
        });
        
        ticking = false;
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initParallax);
    } else {
        initParallax();
    }

    // Clean up will-change on page unload for performance
    window.addEventListener('beforeunload', () => {
        parallaxElements.forEach(el => {
            el.style.willChange = 'auto';
        });
    });
})();
