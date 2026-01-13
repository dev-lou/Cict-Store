/**
 * Text Split Animation System
 * Line-by-line reveals for headlines (Apple/Stripe style)
 */

(function() {
    'use strict';

    // Respect reduced motion preference
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    function initTextAnimations() {
        // Check if GSAP is available
        if (typeof gsap === 'undefined') {
            console.warn('Text animations require GSAP library');
            return;
        }

        const headings = document.querySelectorAll('.hero-title, .section-title, .section-heading, h1:not(.no-animate), h2:not(.no-animate)');
        
        if (!headings.length) return;

        headings.forEach(heading => {
            // Skip if already processed or empty
            if (heading.dataset.textAnimated || !heading.textContent.trim()) return;
            heading.dataset.textAnimated = 'true';

            const text = heading.textContent.trim();
            const words = text.split(' ');

            // Only animate if there are words
            if (words.length === 0) return;

            // Create wrapper structure
            heading.innerHTML = words.map(word => 
                `<span class="word-wrapper"><span class="word">${word}</span></span>`
            ).join(' ');

            const wordElements = heading.querySelectorAll('.word');

            if (!wordElements.length) return;

            // Animate words
            gsap.fromTo(wordElements,
                {
                    y: '120%',
                    opacity: 0,
                    rotateX: -90
                },
                {
                    y: '0%',
                    opacity: 1,
                    rotateX: 0,
                    duration: 0.8,
                    stagger: 0.04,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: heading,
                        start: 'top 90%',
                        once: true
                    }
                }
            );
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTextAnimations);
    } else {
        initTextAnimations();
    }
})();
