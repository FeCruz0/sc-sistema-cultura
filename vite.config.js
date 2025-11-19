import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',
        'resources/css/app.scss' // <-- garantir que está listado aqui
      ],
      refresh: true,
    }),
  ],
});
