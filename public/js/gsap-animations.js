/**
 * Professional Animation System for CICT Website
 * Clean, accessible animations with fade-in and scale effects
 * Optimized for all users including students and accessibility needs
 */

(function () {
    'use strict';

    // Respect reduced motion preference
    const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.gsap-reveal, .reveal-on-scroll, .parallax-hero').forEach(function (el) {
                el.style.opacity = '1';
                el.style.transform = 'none';
            });
        });
        return;
    }

    // Wait for GSAP and ScrollTrigger to load
    function initAnimations() {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            setTimeout(initAnimations, 100);
            return;
        }

        // Ensure ScrollTrigger is registered (safe to call multiple times)
        if (typeof gsap.registerPlugin === 'function') {
            gsap.registerPlugin(ScrollTrigger);
        }

        // Professional easing presets
        const easing = {
            smooth: 'power2.out',
            gentle: 'power1.out',
            bounce: 'back.out(1.4)'
        };

        // ========================================
        // CLEAN CARD ENTRANCE ANIMATIONS
        // Professional fade-in with scale - no blur
        // ========================================
        function initCardReveals() {
            const cardContainers = document.querySelectorAll('.products-grid, .bento-grid, .services-bento-grid, .grid');

            cardContainers.forEach(container => {
                const cards = container.querySelectorAll('.product-card, .bento-card, .service-bento-card, .service-card, .officer-card, .contact-block, .social-card, .location-card');

                if (cards.length === 0) return;

                ScrollTrigger.batch(cards, {
                    onEnter: batch => {
                        gsap.from(batch, {
                            opacity: 0,
                            y: 40,
                            scale: 0.95,
                            duration: 0.6,
                            stagger: 0.1,
                            ease: easing.smooth,
                            clearProps: 'all'
                        });
                    },
                    start: 'top 85%',
                    once: true
                });
            });
        }

        // ========================================
        // SUBTLE HOVER EFFECTS FOR CARDS
        // Professional and accessible
        // ========================================
        function initCardHoverEffects() {
            const cards = document.querySelectorAll('.product-card, .service-card, .bento-card, .contact-block, .social-card');

            if (!cards.length) return;

            cards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    gsap.to(card, {
                        y: -8,
                        scale: 1.02,
                        boxShadow: '0 20px 40px rgba(0, 0, 0, 0.12)',
                        duration: 0.3,
                        ease: easing.smooth
                    });
                });

                card.addEventListener('mouseleave', function () {
                    gsap.to(card, {
                        y: 0,
                        scale: 1,
                        boxShadow: '0 2px 8px rgba(0, 0, 0, 0.06)',
                        duration: 0.3,
                        ease: easing.smooth
                    });
                });
            });
        }

        // ========================================
        // HERO TEXT ANIMATION
        // Clean entrance for hero content
        // ========================================
        function initHeroTextAnimation() {
            const heroKickers = document.querySelectorAll('.hero-kicker, .gsap-hero-kicker');
            const heroTitles = document.querySelectorAll('.hero-title, .gsap-hero-title');
            const heroSubtitles = document.querySelectorAll('.hero-subtitle, .gsap-hero-subtitle');
            const heroButtons = document.querySelectorAll('.hero-button, .gsap-hero-button');

            // Kicker fade-in
            if (heroKickers.length) {
                gsap.from(heroKickers, {
                    opacity: 0,
                    y: -20,
                    duration: 0.6,
                    ease: easing.smooth,
                    delay: 0.2
                });
            }

            // Title scale and fade
            if (heroTitles.length) {
                gsap.from(heroTitles, {
                    opacity: 0,
                    y: 30,
                    scale: 0.98,
                    duration: 0.8,
                    ease: easing.smooth,
                    delay: 0.4
                });
            }

            // Subtitle fade-in
            if (heroSubtitles.length) {
                gsap.from(heroSubtitles, {
                    opacity: 0,
                    y: 20,
                    duration: 0.7,
                    ease: easing.smooth,
                    delay: 0.6
                });
            }

            // Buttons gentle bounce
            if (heroButtons.length) {
                gsap.from(heroButtons, {
                    opacity: 0,
                    y: 20,
                    scale: 0.98,
                    duration: 0.6,
                    stagger: 0.1,
                    ease: easing.bounce,
                    delay: 0.8
                });
            }
        }

        // ========================================
        // FLOATING ELEMENTS
        // Gentle floating animation
        // ========================================
        function initFloatingElements() {
            const floaters = document.querySelectorAll('.gsap-float, .hero-floater');

            if (!floaters.length) return;

            floaters.forEach((el, index) => {
                const duration = 4 + Math.random() * 2;
                const yOffset = 10 + Math.random() * 15;
                const delay = index * 0.3;

                gsap.to(el, {
                    y: yOffset,
                    x: (Math.random() - 0.5) * 10,
                    duration: duration,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut',
                    delay: delay
                });
            });
        }

        // ========================================
        // SECTION FADE-IN
        // Sections fade in as they enter viewport
        // ========================================
        function initSectionFadeIn() {
            const sections = document.querySelectorAll('.featured-section, .services-section, .about-section, .contact-section');

            if (!sections.length) return;

            sections.forEach(section => {
                gsap.from(section, {
                    opacity: 0,
                    y: 30,
                    duration: 0.8,
                    ease: easing.smooth,
                    scrollTrigger: {
                        trigger: section,
                        start: 'top 85%',
                        once: true
                    }
                });
            });
        }

        // ========================================
        // BUTTON ANIMATIONS
        // Professional hover effects
        // ========================================
        function initButtonAnimations() {
            const buttons = document.querySelectorAll('button, .btn, .hero-button, a[class*="button"], .view-all-btn');

            if (!buttons.length) return;

            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', function () {
                    gsap.to(btn, {
                        scale: 1.05,
                        duration: 0.3,
                        ease: easing.smooth
                    });
                });

                btn.addEventListener('mouseleave', function () {
                    gsap.to(btn, {
                        scale: 1,
                        duration: 0.3,
                        ease: easing.smooth
                    });
                });
            });
        }

        // ========================================
        // COUNTER ANIMATION
        // Smooth number counting
        // ========================================
        function initCounters() {
            const counters = document.querySelectorAll('.gsap-counter, [data-gsap="counter"]');

            if (!counters.length) return;

            counters.forEach(counter => {
                const target = parseInt(counter.dataset.target) || parseInt(counter.textContent) || 0;
                const suffix = counter.dataset.suffix || '';
                const prefix = counter.dataset.prefix || '';

                // Initialize counter to 0 using plain JS
                counter.textContent = '0';

                ScrollTrigger.create({
                    trigger: counter,
                    start: 'top 85%',
                    once: true,
                    onEnter: function () {
                        gsap.to(counter, {
                            innerText: target,
                            duration: 2,
                            ease: 'power2.out',
                            snap: { innerText: 1 },
                            onUpdate: function () {
                                counter.textContent = prefix + Math.round(counter.innerText) + suffix;
                            }
                        });
                    }
                });
            });
        }

        // ========================================
        // INITIALIZE ALL ANIMATIONS
        // ========================================
        function init() {
            // Core animations
            initHeroTextAnimation();
            initCardReveals();
            initFloatingElements();
            initSectionFadeIn();

            // Interactive effects
            initCardHoverEffects();
            initButtonAnimations();
            initCounters();

            // Refresh on load
            window.addEventListener('load', () => {
                ScrollTrigger.refresh();
            });
        }

        // Start initialization
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    }

    initAnimations();
})();
