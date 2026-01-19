/**
 * CICT Store - Professional Modern Animations 2026
 * Optimized GSAP animations for a WOW effect
 * Designed for CS/IT students and faculty
 * SAFE: Elements are always visible, animations are enhancement only
 */

(function () {
    'use strict';

    // Wait for GSAP to load
    function initAnimations() {
        if (typeof gsap === 'undefined') {
            setTimeout(initAnimations, 100);
            return;
        }

        // Check for reduced motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) return;

        // Register ScrollTrigger if available
        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }

        // ========================================
        // HERO SECTION - Staggered Text Reveal
        // ========================================
        const heroTitle = document.querySelector('.hero-title, .gsap-hero-title');
        const heroSubtitle = document.querySelector('.hero-subtitle, .gsap-hero-subtitle');
        const heroBadge = document.querySelector('.hero-badge');
        const heroButtons = document.querySelectorAll('.hero-buttons a, .hero-button');

        // Ensure hero elements are visible first
        if (heroTitle) gsap.set(heroTitle, { opacity: 1, y: 0 });
        if (heroSubtitle) gsap.set(heroSubtitle, { opacity: 1, y: 0 });
        if (heroBadge) gsap.set(heroBadge, { opacity: 1, y: 0 });
        if (heroButtons.length) gsap.set(heroButtons, { opacity: 1, y: 0 });

        // Now animate with fromTo (safe)
        const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        if (heroBadge) {
            heroTl.fromTo(heroBadge,
                { opacity: 0, y: -20, scale: 0.95 },
                { opacity: 1, y: 0, scale: 1, duration: 0.5, clearProps: 'all' }
            );
        }

        if (heroTitle) {
            heroTl.fromTo(heroTitle,
                { opacity: 0, y: 40 },
                { opacity: 1, y: 0, duration: 0.6, ease: 'power4.out', clearProps: 'all' },
                '-=0.2'
            );
        }

        if (heroSubtitle) {
            heroTl.fromTo(heroSubtitle,
                { opacity: 0, y: 25 },
                { opacity: 1, y: 0, duration: 0.5, clearProps: 'all' },
                '-=0.3'
            );
        }

        if (heroButtons.length) {
            heroTl.fromTo(heroButtons,
                { opacity: 0, y: 15 },
                { opacity: 1, y: 0, stagger: 0.1, duration: 0.4, clearProps: 'all' },
                '-=0.2'
            );
        }

        // ========================================
        // SCROLL REVEAL - Cards & Sections
        // ========================================
        if (typeof ScrollTrigger !== 'undefined') {
            // Product Cards - Stagger reveal
            const productCards = document.querySelectorAll('.product-card');
            if (productCards.length) {
                ScrollTrigger.batch(productCards, {
                    onEnter: batch => {
                        gsap.fromTo(batch,
                            { opacity: 0.3, y: 30, scale: 0.98 },
                            {
                                opacity: 1,
                                y: 0,
                                scale: 1,
                                stagger: 0.06,
                                duration: 0.4,
                                ease: 'power2.out',
                                clearProps: 'all'
                            }
                        );
                    },
                    start: 'top 90%',
                    once: true
                });
            }

            // Service Cards
            const serviceCards = document.querySelectorAll('.service-card');
            if (serviceCards.length) {
                ScrollTrigger.batch(serviceCards, {
                    onEnter: batch => {
                        gsap.fromTo(batch,
                            { opacity: 0.3, y: 25 },
                            {
                                opacity: 1,
                                y: 0,
                                stagger: 0.05,
                                duration: 0.35,
                                ease: 'power2.out',
                                clearProps: 'all'
                            }
                        );
                    },
                    start: 'top 90%',
                    once: true
                });
            }

            // Contact Cards
            const contactCards = document.querySelectorAll('.contact-card, .social-link');
            if (contactCards.length) {
                ScrollTrigger.batch(contactCards, {
                    onEnter: batch => {
                        gsap.fromTo(batch,
                            { opacity: 0.3, x: -20 },
                            {
                                opacity: 1,
                                x: 0,
                                stagger: 0.08,
                                duration: 0.4,
                                ease: 'power2.out',
                                clearProps: 'all'
                            }
                        );
                    },
                    start: 'top 90%',
                    once: true
                });
            }
        }

        // ========================================
        // SMOOTH SCROLL INDICATOR
        // ========================================
        const scrollIndicator = document.querySelector('.scroll-indicator');
        if (scrollIndicator) {
            gsap.to(scrollIndicator, {
                y: 8,
                duration: 0.8,
                repeat: -1,
                yoyo: true,
                ease: 'power1.inOut'
            });
        }

        console.log('✨ CICT Animations initialized');
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAnimations);
    } else {
        initAnimations();
    }
})();
