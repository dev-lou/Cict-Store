/**
 * Particle System - Floating particles for modern web aesthetics
 * GPU-accelerated canvas-based particle effects
 */

(function () {
    'use strict';

    class ParticleSystem {
        constructor(container, options = {}) {
            this.container = typeof container === 'string' ? document.querySelector(container) : container;
            if (!this.container) return;

            this.options = {
                particleCount: options.particleCount || 50,
                color: options.color || '#FFFFFF',
                opacity: options.opacity || 0.3,
                minSize: options.minSize || 2,
                maxSize: options.maxSize || 6,
                speed: options.speed || 0.5,
                interactive: options.interactive !== undefined ? options.interactive : true,
                connections: options.connections !== undefined ? options.connections : true,
                connectionDistance: options.connectionDistance || 150,
                ...options
            };

            this.particles = [];
            this.mouse = { x: null, y: null, radius: 150 };
            this.init();
        }

        init() {
            // Create canvas
            this.canvas = document.createElement('canvas');
            this.canvas.className = 'particle-canvas';
            this.canvas.style.cssText = `
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: ${this.options.interactive ? 'auto' : 'none'};
                z-index: 1;
            `;

            this.ctx = this.canvas.getContext('2d');
            this.container.style.position = 'relative';
            this.container.appendChild(this.canvas);

            this.resize();
            this.createParticles();
            this.setupEvents();
            this.animate();
        }

        resize() {
            this.canvas.width = this.container.offsetWidth;
            this.canvas.height = this.container.offsetHeight;
        }

        createParticles() {
            this.particles = [];
            for (let i = 0; i < this.options.particleCount; i++) {
                this.particles.push({
                    x: Math.random() * this.canvas.width,
                    y: Math.random() * this.canvas.height,
                    vx: (Math.random() - 0.5) * this.options.speed,
                    vy: (Math.random() - 0.5) * this.options.speed,
                    size: Math.random() * (this.options.maxSize - this.options.minSize) + this.options.minSize
                });
            }
        }

        setupEvents() {
            if (this.options.interactive) {
                this.canvas.addEventListener('mousemove', (e) => {
                    const rect = this.canvas.getBoundingClientRect();
                    this.mouse.x = e.clientX - rect.left;
                    this.mouse.y = e.clientY - rect.top;
                });

                this.canvas.addEventListener('mouseleave', () => {
                    this.mouse.x = null;
                    this.mouse.y = null;
                });
            }

            window.addEventListener('resize', () => this.resize());
        }

        drawParticle(particle) {
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            this.ctx.fillStyle = this.options.color;
            this.ctx.globalAlpha = this.options.opacity;
            this.ctx.fill();
        }

        drawConnection(particle1, particle2, distance) {
            const opacity = 1 - (distance / this.options.connectionDistance);
            this.ctx.beginPath();
            this.ctx.moveTo(particle1.x, particle1.y);
            this.ctx.lineTo(particle2.x, particle2.y);
            this.ctx.strokeStyle = this.options.color;
            this.ctx.globalAlpha = opacity * this.options.opacity * 0.5;
            this.ctx.lineWidth = 1;
            this.ctx.stroke();
        }

        updateParticle(particle) {
            // Move particle
            particle.x += particle.vx;
            particle.y += particle.vy;

            // Bounce off walls
            if (particle.x < 0 || particle.x > this.canvas.width) particle.vx *= -1;
            if (particle.y < 0 || particle.y > this.canvas.height) particle.vy *= -1;

            // Keep in bounds
            particle.x = Math.max(0, Math.min(this.canvas.width, particle.x));
            particle.y = Math.max(0, Math.min(this.canvas.height, particle.y));

            // Mouse interaction
            if (this.mouse.x !== null && this.mouse.y !== null) {
                const dx = this.mouse.x - particle.x;
                const dy = this.mouse.y - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < this.mouse.radius) {
                    const force = (this.mouse.radius - distance) / this.mouse.radius;
                    const angle = Math.atan2(dy, dx);
                    particle.vx -= Math.cos(angle) * force * 0.5;
                    particle.vy -= Math.sin(angle) * force * 0.5;
                }
            }

            // Damping
            particle.vx *= 0.99;
            particle.vy *= 0.99;

            // Minimum speed
            if (Math.abs(particle.vx) < 0.1) particle.vx = (Math.random() - 0.5) * this.options.speed;
            if (Math.abs(particle.vy) < 0.1) particle.vy = (Math.random() - 0.5) * this.options.speed;
        }

        animate() {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

            // Update and draw particles
            this.particles.forEach(particle => {
                this.updateParticle(particle);
                this.drawParticle(particle);
            });

            // Draw connections
            if (this.options.connections) {
                for (let i = 0; i < this.particles.length; i++) {
                    for (let j = i + 1; j < this.particles.length; j++) {
                        const dx = this.particles[i].x - this.particles[j].x;
                        const dy = this.particles[i].y - this.particles[j].y;
                        const distance = Math.sqrt(dx * dx + dy * dy);

                        if (distance < this.options.connectionDistance) {
                            this.drawConnection(this.particles[i], this.particles[j], distance);
                        }
                    }
                }
            }

            requestAnimationFrame(() => this.animate());
        }
    }

    // Auto-initialize particles
    window.addEventListener('DOMContentLoaded', () => {
        // Check for reduced motion
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) return;

        // Create particles on marked containers
        document.querySelectorAll('[data-particles]').forEach(container => {
            const count = parseInt(container.dataset.particleCount) || 50;
            const color = container.dataset.particleColor || '#FFFFFF';
            const opacity = parseFloat(container.dataset.particleOpacity) || 0.3;

            new ParticleSystem(container, {
                particleCount: count,
                color,
                opacity,
                interactive: container.dataset.particleInteractive !== 'false',
                connections: container.dataset.particleConnections !== 'false'
            });
        });

        // Add particles to hero sections (reduced on mobile for performance)
        const isMobile = window.innerWidth < 768;
        const particleCount = isMobile ? 25 : 60;
        const connectionDistance = isMobile ? 80 : 120;

        document.querySelectorAll('.hero-section, .hero, .contact-hero, .shop-hero, .services-hero').forEach(hero => {
            new ParticleSystem(hero, {
                particleCount: particleCount,
                color: '#FFFFFF',
                opacity: 0.4,
                speed: 0.3,
                minSize: 1,
                maxSize: 3,
                interactive: !isMobile, // Disable mouse interaction on mobile
                connections: true,
                connectionDistance: connectionDistance
            });
        });
    });

    // Export for manual use
    window.ParticleSystem = ParticleSystem;
})();
