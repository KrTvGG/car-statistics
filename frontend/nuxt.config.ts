// https://nuxt.com/docs/api/configuration/nuxt-config
import tsconfigPaths from 'vite-tsconfig-paths'
import path from 'path'

export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: [
    '@nuxt/icon', 
    '@nuxt/image', 
    '@nuxt/eslint'
  ],
  app: {
    head: {
      charset: 'utf-8',
      htmlAttrs: {
        lang: 'ru',
      },
    }
  },
  css: [
    "~/assets/scss/reset.scss",
    "~/assets/scss/additional.scss",
  ],
  vite: {
    resolve: {
      alias: {
        '@assets': path.resolve(__dirname, 'assets'),
      }
    },
    plugins: [
      tsconfigPaths(),
      {
        name: 'vite-plugin-glob-transform',
        transform(code: string, id: string) {
          if (id.includes('nuxt-icons')) {
            return code.replace(/as:\s*['"]raw['"]/g, 'query: "?raw", import: "default"')
          }
          return code
        }
      }
    ],
    css: {
      preprocessorOptions: {
        scss: {
          api: 'modern-compiler',
          silenceDeprecations: ["legacy-js-api"],
          additionalData: `
              @use "~/assets/scss/runtime/modules.scss" as *; 
              @use '~/assets/scss/runtime/mixins' as *;
          `,
          
        }
      }
    },
    server: {
      watch: {
        usePolling: true,
        interval: 500,
      },
    }
  },
  watchers: {
    webpack: {
      aggregateTimeout: 500,
    }
  }
})