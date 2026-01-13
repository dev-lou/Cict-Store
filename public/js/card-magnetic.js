/**
 * Magnetic Card Hover System
 * Professional 3D tilt + lift effect for cards
 */

(function() {
    'use strict';

    // Respect reduced motion preference
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    function initMagneticCards() {
        const cards = document.querySelectorAll('.product-card, .service-card, .bento-card, .contact-block, .social-card');
        
        if (!cards.length) return;

        cards.forEach(card => {
            card.style.transformStyle = 'preserve-3d';
            card.style.transition = 'box-shadow 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)';

            card.addEventListener('mouseenter', function(e) {
                gsap.to(card, {
                    y: -8,
                    scale: 1.02,
                    boxShadow: '0 20px 40px rgba(139, 0, 0, 0.2)',
                    duration: 0.4,
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                
                const mouseX = e.clientX - centerX;
                const mouseY = e.clientY - centerY;
                
                const rotateX = (mouseY / rect.height) * -10; // ±5deg
                const rotateY = (mouseX / rect.width) * 10;
                
                gsap.to(card, {
                    rotateX: rotateX,
                    rotateY: rotateY,
                    transformPerspective: 1000,
                    duration: 0.3,
                    ease: 'power1.out'
                });
            });

            card.addEventListener('mouseleave', function() {
                gsap.to(card, {
                    y: 0,
                    scale: 1,
                    rotateX: 0,
                    rotateY: 0,
                    boxShadow: '0 4px 12px rgba(0, 0, 0, 0.08)',
                    duration: 0.5,
                    ease: 'elastic.out(1, 0.5)'
                });
            });
        });
    }

    // Initialize when DOM is ready and GSAP is loaded
    if (typeof gsap !== 'undefined') {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMagneticCards);
        } else {
            initMagneticCards();
        }
    } else {
        console.warn('Magnetic cards require GSAP library');
    }
})();
