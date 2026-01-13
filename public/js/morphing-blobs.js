/**
 * Morphing Blob Backgrounds - Dynamic SVG Animation
 * Creates organic, morphing blob shapes for modern web aesthetics
 */

(function() {
    'use strict';

    class MorphingBlob {
        constructor(container, options = {}) {
            this.container = typeof container === 'string' ? document.querySelector(container) : container;
            if (!this.container) return;

            this.options = {
                color: options.color || '#8B0000',
                opacity: options.opacity || 0.08,
                complexity: options.complexity || 6,
                speed: options.speed || 20,
                size: options.size || 500,
                ...options
            };

            this.init();
        }

        init() {
            // Create SVG
            this.svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            this.svg.setAttribute('class', 'morphing-blob');
            this.svg.style.cssText = `
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                pointer-events: none;
                z-index: 0;
            `;

            // Create blob path
            this.path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            this.path.setAttribute('fill', this.options.color);
            this.path.setAttribute('opacity', this.options.opacity);
            this.path.setAttribute('filter', 'url(#goo)');
            
            // Create goo filter for smooth blobs
            const defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');
            defs.innerHTML = `
                <filter id="goo">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                    <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                    <feBlend in="SourceGraphic" in2="goo" />
                </filter>
            `;

            this.svg.appendChild(defs);
            this.svg.appendChild(this.path);
            this.container.style.position = 'relative';
            this.container.appendChild(this.svg);

            this.startAnimation();
        }

        createBlobPath(step) {
            const points = [];
            const complexity = this.options.complexity;
            const size = this.options.size;

            for (let i = 0; i < complexity; i++) {
                const angle = (i / complexity) * Math.PI * 2;
                const radius = size / 2 + Math.sin(step + i) * 50;
                
                const x = this.container.offsetWidth / 2 + Math.cos(angle) * radius;
                const y = this.container.offsetHeight / 2 + Math.sin(angle) * radius;
                
                points.push({ x, y });
            }

            // Create smooth curve through points
            let path = `M ${points[0].x},${points[0].y}`;
            
            for (let i = 0; i < points.length; i++) {
                const next = points[(i + 1) % points.length];
                const nextNext = points[(i + 2) % points.length];
                
                const cpX = (next.x + nextNext.x) / 2;
                const cpY = (next.y + nextNext.y) / 2;
                
                path += ` Q ${next.x},${next.y} ${cpX},${cpY}`;
            }
            
            path += ' Z';
            return path;
        }

        startAnimation() {
            let step = 0;
            const animate = () => {
                step += 0.01 * (this.options.speed / 10);
                const pathData = this.createBlobPath(step);
                this.path.setAttribute('d', pathData);
                requestAnimationFrame(animate);
            };
            animate();
        }
    }

    // Auto-initialize blobs
    window.addEventListener('DOMContentLoaded', () => {
        // Check for reduced motion
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) return;

        // Create blobs on marked containers
        document.querySelectorAll('[data-blob-bg]').forEach(container => {
            const color = container.dataset.blobColor || '#8B0000';
            const opacity = parseFloat(container.dataset.blobOpacity) || 0.08;
            const speed = parseInt(container.dataset.blobSpeed) || 20;
            
            new MorphingBlob(container, { color, opacity, speed });
        });

        // Create multiple blobs for hero sections
        document.querySelectorAll('.hero-section, .contact-hero').forEach(hero => {
            // Primary blob
            new MorphingBlob(hero, {
                color: '#8B0000',
                opacity: 0.06,
                size: 600,
                speed: 15
            });
            
            // Secondary blob
            new MorphingBlob(hero, {
                color: '#FFD700',
                opacity: 0.04,
                size: 400,
                speed: 25
            });
        });
    });

    // Export for manual use
    window.MorphingBlob = MorphingBlob;
})();
