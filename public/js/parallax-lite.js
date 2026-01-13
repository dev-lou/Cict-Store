/**
 * Lightweight Parallax Effect
 * CPU-friendly parallax using requestAnimationFrame
 */

(function() {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) return;

    let ticking = false;
    let lastScrollY = 0;
    const parallaxElements = [];

    // Initialize parallax elements
    function initParallax() {
        document.querySelectorAll('[data-parallax]').forEach(el => {
            const speed = parseFloat(el.dataset.parallaxSpeed || 0.5);
            const direction = el.dataset.parallaxDirection || 'up';
            
            parallaxElements.push({
                element: el,
                speed: speed,
                direction: direction,
                initialTop: el.getBoundingClientRect().top + window.pageYOffset
            });
            
            // Enable GPU acceleration
            el.style.willChange = 'transform';
            el.style.transition = 'none';
        });
    }

    // Update parallax positions
    function updateParallax() {
        const scrollY = window.pageYOffset;
        const scrollDelta = scrollY - lastScrollY;
        
        parallaxElements.forEach(item => {
            const elementTop = item.initialTop;
            const windowHeight = window.innerHeight;
            
            // Only animate if element is near viewport
            if (scrollY + windowHeight > elementTop - 200 && scrollY < elementTop + item.element.offsetHeight + 200) {
                const movement = (scrollY - elementTop) * item.speed;
                const yPos = item.direction === 'down' ? movement : -movement;
                
                item.element.style.transform = `translate3d(0, ${yPos}px, 0)`;
            }
        });
        
        lastScrollY = scrollY;
        ticking = false;
    }

    // Smooth scroll handler with RAF
    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }

    // Floating animation for decorative elements
    function initFloatingElements() {
        const floaters = document.querySelectorAll('[data-float]');
        
        floaters.forEach((el, index) => {
            const duration = parseFloat(el.dataset.floatDuration || 3);
            const distance = parseFloat(el.dataset.floatDistance || 20);
            const delay = index * 0.5;
            
            el.style.animation = `float ${duration}s ease-in-out ${delay}s infinite`;
            el.style.setProperty('--float-distance', `${distance}px`);
        });
        
        // Add keyframe if not exists
        if (!document.querySelector('#float-keyframe')) {
            const style = document.createElement('style');
            style.id = 'float-keyframe';
            style.textContent = `
                @keyframes float {
                    0%, 100% {
                        transform: translateY(0);
                    }
                    50% {
                        transform: translateY(var(--float-distance, -20px));
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initParallax();
            initFloatingElements();
            
            if (parallaxElements.length > 0) {
                window.addEventListener('scroll', onScroll, { passive: true });
                updateParallax(); // Initial position
            }
        });
    } else {
        initParallax();
        initFloatingElements();
        
        if (parallaxElements.length > 0) {
            window.addEventListener('scroll', onScroll, { passive: true });
            updateParallax();
        }
    }

    // Cleanup on page unload
    window.addEventListener('beforeunload', function() {
        parallaxElements.forEach(item => {
            item.element.style.willChange = 'auto';
        });
    });

})();
