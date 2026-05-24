import js from '@eslint/js';

export default [
  js.configs.recommended,
  {
    ignores: ['public/build/', 'vendor/', 'node_modules/'],
    rules: {
      'no-unused-vars': ['warn', { argsIgnorePattern: '^_' }],
      'no-console': ['warn', { allow: ['warn', 'error'] }],
    },
  },
];
