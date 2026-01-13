/**
 * Scroll Reveal Animations
 * Lightweight scroll-triggered animations using Intersection Observer
 */

(function() {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) {
        // Make all elements visible immediately
        document.querySelectorAll('[data-reveal]').forEach(el => {
            el.style.opacity = '1';
            el.style.transform = 'none';
        });
        return;
    }

    // Intersection Observer options
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    // Create observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                
                // Unobserve after animation to improve performance
                if (entry.target.dataset.revealOnce !== 'false') {
                    observer.unobserve(entry.target);
                }
            } else if (entry.target.dataset.revealOnce === 'false') {
                entry.target.classList.remove('is-visible');
            }
        });
    }, observerOptions);

    // Reveal sections
    function initSectionReveals() {
        const sections = document.querySelectorAll('[data-reveal]');
        
        sections.forEach((section, index) => {
            // Set initial state
            section.style.opacity = '0';
            section.style.transform = 'translateY(40px)';
            section.style.filter = 'blur(8px)';
            section.style.transition = `
                opacity 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) ${index * 0.1}s,
                transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) ${index * 0.1}s,
                filter 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) ${index * 0.1}s
            `;
            
            observer.observe(section);
        });
    }

    // Staggered card animations
    function initCardStagger() {
        const cardContainers = document.querySelectorAll('.product-grid, .service-grid, .bento-grid, .options-grid');
        
        cardContainers.forEach(container => {
            const cards = container.querySelectorAll('.product-card, .service-card, .bento-card, .paper-card');
            
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px) scale(0.95)';
                card.style.transition = `
                    opacity 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) ${index * 0.08}s,
                    transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) ${index * 0.08}s
                `;
            });
            
            const containerObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const cards = entry.target.querySelectorAll('.product-card, .service-card, .bento-card, .paper-card');
                        cards.forEach(card => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0) scale(1)';
                        });
                        containerObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            containerObserver.observe(container);
        });
    }

    // Add visible class styles
    const style = document.createElement('style');
    style.textContent = `
        [data-reveal].is-visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
            filter: blur(0) !important;
        }
        
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .fade-in-up.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    `;
    document.head.appendChild(style);

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initSectionReveals();
            initCardStagger();
        });
    } else {
        initSectionReveals();
        initCardStagger();
    }

    // Export for reinitializing on dynamic content
    window.reinitScrollReveals = function() {
        initSectionReveals();
        initCardStagger();
    };

})();
