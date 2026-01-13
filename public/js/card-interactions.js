/**
 * Card Interactions - Magnetic Hover & 3D Tilt
 * Lightweight card effects for product/service cards
 */

(function() {
    'use strict';

    // Check for reduced motion preference
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) return;

    // Initialize magnetic cards
    function initMagneticCards() {
        const cards = document.querySelectorAll('.product-card, .service-card, .bento-card, .paper-card');
        
        cards.forEach(card => {
            let isHovering = false;
            
            // Magnetic hover effect
            card.addEventListener('mouseenter', function() {
                isHovering = true;
                this.style.transition = 'none';
            });
            
            card.addEventListener('mousemove', function(e) {
                if (!isHovering) return;
                
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                // Magnetic movement (15px max)
                const moveX = (x / rect.width) * 15;
                const moveY = (y / rect.height) * 15;
                
                // 3D tilt effect
                const rotateY = (x / rect.width) * 10;
                const rotateX = -(y / rect.height) * 10;
                
                this.style.transform = `
                    translate3d(${moveX}px, ${moveY}px, 0)
                    rotateX(${rotateX}deg)
                    rotateY(${rotateY}deg)
                    scale(1.02)
                `;
            });
            
            card.addEventListener('mouseleave', function() {
                isHovering = false;
                this.style.transition = 'transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
                this.style.transform = 'translate3d(0, 0, 0) rotateX(0) rotateY(0) scale(1)';
            });
        });
    }

    // Button ripple effect
    function initButtonRipple() {
        const buttons = document.querySelectorAll('.btn-interactive, .add-to-cart-btn, button[type="submit"]');
        
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.width = '0';
                ripple.style.height = '0';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                ripple.style.transform = 'translate(-50%, -50%)';
                ripple.style.pointerEvents = 'none';
                ripple.style.transition = 'width 0.6s, height 0.6s, opacity 0.6s';
                ripple.style.opacity = '1';
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.style.width = '300px';
                    ripple.style.height = '300px';
                    ripple.style.opacity = '0';
                }, 0);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });
    }

    // Enhanced image zoom on card hover
    function initImageZoom() {
        const imageContainers = document.querySelectorAll('.product-card, .service-card');
        
        imageContainers.forEach(container => {
            const img = container.querySelector('img');
            if (!img) return;
            
            img.style.transition = 'transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
            
            container.addEventListener('mouseenter', function() {
                if (img) {
                    img.style.transform = 'scale(1.1) rotate(2deg)';
                }
            });
            
            container.addEventListener('mouseleave', function() {
                if (img) {
                    img.style.transform = 'scale(1) rotate(0deg)';
                }
            });
        });
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initMagneticCards();
            initButtonRipple();
            initImageZoom();
        });
    } else {
        initMagneticCards();
        initButtonRipple();
        initImageZoom();
    }

    // Re-initialize on dynamic content load
    window.addEventListener('reinitCardInteractions', function() {
        initMagneticCards();
        initButtonRipple();
        initImageZoom();
    });

})();
