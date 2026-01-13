/**
 * Text Reveal Animations
 * Elegant text animations for headings and titles
 */

(function() {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) return;

    // Split text into words and animate
    function animateText(element) {
        const text = element.textContent;
        const words = text.split(' ');
        
        element.innerHTML = '';
        element.style.overflow = 'hidden';
        
        words.forEach((word, index) => {
            const span = document.createElement('span');
            span.textContent = word + (index < words.length - 1 ? '\u00A0' : '');
            span.style.display = 'inline-block';
            span.style.opacity = '0';
            span.style.transform = 'translateY(100%)';
            span.style.transition = `
                opacity 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) ${index * 0.05}s,
                transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) ${index * 0.05}s
            `;
            
            element.appendChild(span);
        });
        
        // Trigger animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const spans = entry.target.querySelectorAll('span');
                    spans.forEach(span => {
                        span.style.opacity = '1';
                        span.style.transform = 'translateY(0)';
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        observer.observe(element);
    }

    // Typing effect for hero text
    function typingEffect(element) {
        const text = element.textContent;
        element.textContent = '';
        element.style.borderRight = '2px solid #8B0000';
        element.style.paddingRight = '5px';
        
        let index = 0;
        
        const typeInterval = setInterval(() => {
            if (index < text.length) {
                element.textContent += text[index];
                index++;
            } else {
                clearInterval(typeInterval);
                setTimeout(() => {
                    element.style.borderRight = 'none';
                }, 500);
            }
        }, 50);
    }

    // Gradient text reveal
    function gradientReveal(element) {
        element.style.background = 'linear-gradient(90deg, #8B0000 0%, #FFD700 50%, #8B0000 100%)';
        element.style.backgroundSize = '200% 100%';
        element.style.backgroundClip = 'text';
        element.style.webkitBackgroundClip = 'text';
        element.style.webkitTextFillColor = 'transparent';
        element.style.animation = 'gradientShift 3s ease infinite';
        
        // Add keyframe if not exists
        if (!document.querySelector('#gradient-shift-keyframe')) {
            const style = document.createElement('style');
            style.id = 'gradient-shift-keyframe';
            style.textContent = `
                @keyframes gradientShift {
                    0%, 100% { background-position: 0% 50%; }
                    50% { background-position: 100% 50%; }
                }
            `;
            document.head.appendChild(style);
        }
    }

    // Initialize text animations
    function initTextAnimations() {
        // Animated hero titles
        document.querySelectorAll('[data-text-reveal]').forEach(el => {
            animateText(el);
        });
        
        // Typing effect
        document.querySelectorAll('[data-typing]').forEach(el => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        typingEffect(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(el);
        });
        
        // Gradient text
        document.querySelectorAll('[data-gradient-text]').forEach(el => {
            gradientReveal(el);
        });
    }

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTextAnimations);
    } else {
        initTextAnimations();
    }

    window.reinitTextAnimations = initTextAnimations;

})();
