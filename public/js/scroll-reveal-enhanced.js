/**
 * Enhanced Scroll Reveal System
 * Staggered fade + blur reveals with GSAP ScrollTrigger
 */

(function() {
    'use strict';

    // Respect reduced motion preference
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    function initScrollReveals() {
        // Check if GSAP and ScrollTrigger are available
        if (typeof gsap === 'undefined') {
            console.warn('Scroll reveals require GSAP library');
            return;
        }

        if (typeof ScrollTrigger === 'undefined') {
            console.warn('Scroll reveals require GSAP ScrollTrigger plugin');
            return;
        }

        gsap.registerPlugin(ScrollTrigger);

        // Enhanced section reveals
        const sections = document.querySelectorAll('[data-reveal], .reveal-on-scroll, section');
        
        if (!sections.length) return;

        sections.forEach((section, i) => {
            // Skip if already animated
            if (section.dataset.revealInitialized) return;
            section.dataset.revealInitialized = 'true';

            gsap.fromTo(section,
                {
                    opacity: 0,
                    y: 50,
                    scale: 0.96,
                    filter: 'blur(8px)'
                },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    filter: 'blur(0px)',
                    duration: 0.8,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top 85%',
                        end: 'top 20%',
                        toggleActions: 'play none none reverse',
                        once: false
                    }
                }
            );
        });

        // Product/Service grid stagger animations
        const grids = document.querySelectorAll('.products-grid, .product-grid, .service-grid, .bento-grid, .services-bento');
        
        grids.forEach(grid => {
            const items = grid.querySelectorAll('.product-card, .service-card, .bento-card, .service-bento-card');
            
            if (!items.length) return;

            gsap.fromTo(items,
                { 
                    opacity: 0, 
                    y: 30,
                    scale: 0.92
                },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.5,
                    stagger: {
                        amount: 0.4,
                        from: 'start',
                        ease: 'power2.out'
                    },
                    scrollTrigger: {
                        trigger: grid,
                        start: 'top 80%',
                        once: true
                    }
                }
            );
        });

        // About grid reveals
        const aboutGrids = document.querySelectorAll('.about-grid, .contact-grid');
        aboutGrids.forEach(grid => {
            const items = grid.querySelectorAll('.about-content, .about-image, .contact-info, .contact-form');
            
            if (!items.length) return;

            gsap.fromTo(items,
                {
                    opacity: 0,
                    x: -30,
                    scale: 0.95
                },
                {
                    opacity: 1,
                    x: 0,
                    scale: 1,
                    duration: 0.6,
                    stagger: 0.2,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: grid,
                        start: 'top 75%',
                        once: true
                    }
                }
            );
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initScrollReveals);
    } else {
        initScrollReveals();
    }

    // Refresh ScrollTrigger on window load (for images)
    window.addEventListener('load', () => {
        if (typeof ScrollTrigger !== 'undefined') {
            ScrollTrigger.refresh();
        }
    });
})();
