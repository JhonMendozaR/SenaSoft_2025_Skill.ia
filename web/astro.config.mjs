// @ts-check
import { defineConfig } from 'astro/config';

import tailwindcss from '@tailwindcss/vite';

import vue from '@astrojs/vue';

// https://astro.build/config
export default defineConfig({
  // Modo estático para despliegue en Render
  output: 'static',
  
  // URL del sitio en producción (actualizar con tu URL de Render)
  site: 'https://skillai.onrender.com',
  
  // Configuración de build
  build: {
    assets: '_astro',
    format: 'directory'
  },

  vite: {
    plugins: [tailwindcss()],
    build: {
      // Optimizaciones para producción
      minify: true,
      cssMinify: true
    }
  },

  integrations: [vue()]
});