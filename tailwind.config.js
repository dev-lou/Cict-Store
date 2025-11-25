/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/components/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      // Custom Color Palette (2025 Modern Aesthetic)
      colors: {
        // Primary Blues (main brand colors)
        primary: {
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6', // Main brand blue
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
          950: '#172554',
        },
        // Success States (Greens)
        success: {
          50: '#f0fdf4',
          100: '#dcfce7',
          200: '#bbf7d0',
          300: '#86efac',
          400: '#4ade80',
          500: '#22c55e', // Main success green
          600: '#16a34a',
          700: '#15803d',
          800: '#166534',
          900: '#145231',
        },
        // Warning States (Ambers)
        warning: {
          50: '#fffbeb',
          100: '#fef3c7',
          200: '#fde68a',
          300: '#fcd34d',
          400: '#fbbf24',
          500: '#f59e0b', // Main warning
          600: '#d97706',
          700: '#b45309',
          800: '#92400e',
          900: '#78350f',
        },
        // Danger/Error States (Reds)
        danger: {
          50: '#fef2f2',
          100: '#fee2e2',
          200: '#fecaca',
          300: '#fca5a5',
          400: '#f87171',
          500: '#ef4444', // Main danger
          600: '#dc2626',
          700: '#b91c1c',
          800: '#991b1b',
          900: '#7f1d1d',
        },
        // Information States (Light Blues)
        info: {
          50: '#f0f9ff',
          100: '#e0f2fe',
          200: '#bae6fd',
          300: '#7dd3fc',
          400: '#38bdf8',
          500: '#0ea5e9', // Main info
          600: '#0284c7',
          700: '#0369a1',
          800: '#075985',
          900: '#0c3d66',
        },
        // Neutral Grays
        gray: {
          50: '#f9fafb',
          100: '#f3f4f6',
          200: '#e5e7eb',
          300: '#d1d5db',
          400: '#9ca3af',
          500: '#6b7280', // Main neutral
          600: '#4b5563',
          700: '#374151',
          800: '#1f2937',
          900: '#111827',
          950: '#030712',
        },
      },

      // Typography System
      fontFamily: {
        sans: [
          'Inter',
          'system-ui',
          '-apple-system',
          'sans-serif',
        ],
        mono: [
          'Menlo',
          'Monaco',
          'Courier New',
          'monospace',
        ],
      },
      fontSize: {
        xs: ['0.75rem', { lineHeight: '1rem' }],
        sm: ['0.875rem', { lineHeight: '1.25rem' }],
        base: ['1rem', { lineHeight: '1.5rem' }],
        lg: ['1.125rem', { lineHeight: '1.75rem' }],
        xl: ['1.25rem', { lineHeight: '1.75rem' }],
        '2xl': ['1.5rem', { lineHeight: '2rem' }],
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
        '5xl': ['3rem', { lineHeight: '1.2' }],
        '6xl': ['3.75rem', { lineHeight: '1' }],
      },
      fontWeight: {
        thin: '100',
        extralight: '200',
        light: '300',
        normal: '400',
        medium: '500',
        semibold: '600',
        bold: '700',
        extrabold: '800',
        black: '900',
      },

      // Spacing System (8px base)
      spacing: {
        0: '0',
        1: '0.25rem',
        2: '0.5rem',
        3: '0.75rem',
        4: '1rem',
        5: '1.25rem',
        6: '1.5rem',
        7: '1.75rem',
        8: '2rem',
        9: '2.25rem',
        10: '2.5rem',
        12: '3rem',
        14: '3.5rem',
        16: '4rem',
        20: '5rem',
        24: '6rem',
        28: '7rem',
        32: '8rem',
        36: '9rem',
        40: '10rem',
        44: '11rem',
        48: '12rem',
        52: '13rem',
        56: '14rem',
        60: '15rem',
        64: '16rem',
        72: '18rem',
        80: '20rem',
        96: '24rem',
      },

      // Border Radius (Modern rounded design)
      borderRadius: {
        none: '0',
        sm: '0.375rem',
        base: '0.5rem',
        md: '0.75rem',
        lg: '1rem',
        xl: '1.25rem',
        '2xl': '1.5rem',
        '3xl': '2rem',
        full: '9999px',
      },

      // Box Shadows (Depth & Glassmorphism effects)
      boxShadow: {
        none: 'none',
        xs: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
        sm: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)',
        base: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)',
        md: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1)',
        lg: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1)',
        xl: '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
        '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
        // Glassmorphism effects
        glass: 'inset 0 1px 0 0 rgba(255, 255, 255, 0.2), 0 8px 32px 0 rgba(31, 38, 135, 0.37)',
        'glass-lg': 'inset 0 1px 0 0 rgba(255, 255, 255, 0.2), 0 20px 50px 0 rgba(31, 38, 135, 0.37)',
        // Soft shadows
        soft: '0 0 20px rgba(0, 0, 0, 0.08)',
        'soft-lg': '0 0 40px rgba(0, 0, 0, 0.12)',
      },

      // Transitions & Animations
      transitionDuration: {
        75: '75ms',
        100: '100ms',
        150: '150ms',
        200: '200ms',
        300: '300ms',
        500: '500ms',
        700: '700ms',
        1000: '1000ms',
      },
      transitionTimingFunction: {
        linear: 'linear',
        in: 'cubic-bezier(0.4, 0, 1, 1)',
        out: 'cubic-bezier(0, 0, 0.2, 1)',
        'in-out': 'cubic-bezier(0.4, 0, 0.2, 1)',
        'spring': 'cubic-bezier(0.34, 1.56, 0.64, 1)',
      },
      animation: {
        none: 'none',
        spin: 'spin 1s linear infinite',
        ping: 'ping 1s cubic-bezier(0, 0, 0.2, 1) infinite',
        pulse: 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        bounce: 'bounce 1s infinite',
        shimmer: 'shimmer 2s infinite',
        'fade-in': 'fadeIn 0.5s ease-out',
        'slide-in-right': 'slideInRight 0.3s ease-out',
        'slide-in-left': 'slideInLeft 0.3s ease-out',
      },
      keyframes: {
        shimmer: {
          '0%': { backgroundPosition: '200% 0' },
          '100%': { backgroundPosition: '-200% 0' },
        },
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideInRight: {
          '0%': { transform: 'translateX(100%)', opacity: '0' },
          '100%': { transform: 'translateX(0)', opacity: '1' },
        },
        slideInLeft: {
          '0%': { transform: 'translateX(-100%)', opacity: '0' },
          '100%': { transform: 'translateX(0)', opacity: '1' },
        },
      },

      // Backdrop Filters (Glassmorphism)
      backdropBlur: {
        none: '0',
        sm: '4px',
        base: '8px',
        md: '12px',
        lg: '16px',
        xl: '20px',
        '2xl': '24px',
      },

      // Z-index scale
      zIndex: {
        auto: 'auto',
        0: '0',
        10: '10',
        20: '20',
        30: '30',
        40: '40',
        50: '50',
        60: '60',
        70: '70',
        80: '80',
        90: '90',
        100: '100',
        modal: '1000',
        dropdown: '1010',
        sticky: '1020',
        fixed: '1030',
        tooltip: '1040',
      },

      // Opacity scale
      opacity: {
        0: '0',
        5: '0.05',
        10: '0.1',
        20: '0.2',
        25: '0.25',
        30: '0.3',
        40: '0.4',
        50: '0.5',
        60: '0.6',
        70: '0.7',
        75: '0.75',
        80: '0.8',
        90: '0.9',
        95: '0.95',
        100: '1',
      },

      // Width & Height utilities
      width: {
        full: '100%',
        screen: '100vw',
        min: 'min-content',
        max: 'max-content',
        fit: 'fit-content',
      },
      height: {
        full: '100%',
        screen: '100vh',
        min: 'min-content',
        max: 'max-content',
        fit: 'fit-content',
      },

      // Gradient utilities
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
        'gradient-to-tr': 'linear-gradient(to top right, var(--tw-gradient-stops))',
        'gradient-to-tl': 'linear-gradient(to top left, var(--tw-gradient-stops))',
      },

      // Custom utilities for common patterns
      minHeight: {
        screen: '100vh',
      },
      minWidth: {
        screen: '100vw',
      },
    },
  },
  plugins: [
    // Custom utilities
    function ({ addUtilities, e, theme }) {
      const glassmorphism = {
        '.glass': {
          background: 'rgba(255, 255, 255, 0.1)',
          backdropFilter: 'blur(10px)',
          border: '1px solid rgba(255, 255, 255, 0.2)',
        },
        '.glass-dark': {
          background: 'rgba(15, 23, 42, 0.5)',
          backdropFilter: 'blur(10px)',
          border: '1px solid rgba(255, 255, 255, 0.1)',
        },
        '.glass-lg': {
          background: 'rgba(255, 255, 255, 0.15)',
          backdropFilter: 'blur(20px)',
          border: '1px solid rgba(255, 255, 255, 0.3)',
        },
      };

      const textUtilities = {
        '.text-gradient': {
          '@apply bg-gradient-to-r from-primary-500 to-blue-600 bg-clip-text text-transparent': {},
        },
        '.text-shadow': {
          textShadow: '0 2px 4px rgba(0, 0, 0, 0.1)',
        },
        '.text-shadow-lg': {
          textShadow: '0 4px 8px rgba(0, 0, 0, 0.15)',
        },
      };

      const flexUtilities = {
        '.flex-center': {
          '@apply flex items-center justify-center': {},
        },
        '.flex-between': {
          '@apply flex items-center justify-between': {},
        },
        '.flex-col-center': {
          '@apply flex flex-col items-center justify-center': {},
        },
      };

      const gridUtilities = {
        '.grid-auto-fit': {
          gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))',
        },
        '.grid-auto-fill': {
          gridTemplateColumns: 'repeat(auto-fill, minmax(250px, 1fr))',
        },
      };

      const boundaryUtilities = {
        '.container-bounded': {
          maxWidth: '1280px',
          marginLeft: 'auto',
          marginRight: 'auto',
          paddingLeft: '1rem',
          paddingRight: '1rem',
        },
      };

      addUtilities({
        ...glassmorphism,
        ...textUtilities,
        ...flexUtilities,
        ...gridUtilities,
        ...boundaryUtilities,
      });
    },
  ],
  corePlugins: {
    preflight: true,
  },
  safelist: [
    // Status badge colors
    {
      pattern: /bg-(success|warning|danger|info|primary|gray)-(100|500|600)/,
    },
    {
      pattern: /text-(success|warning|danger|info|primary|gray)-(600|700|800|900)/,
    },
    {
      pattern: /border-(success|warning|danger|info|primary|gray)-(200|300|500)/,
    },
  ],
};
