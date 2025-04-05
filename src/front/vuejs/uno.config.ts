import {
  defineConfig,
  presetUno,
  presetIcons,
  transformerVariantGroup,
  transformerDirectives,
  presetWebFonts,
} from 'unocss'

export default defineConfig({
  content: {
    filesystem: ['./*.{html,js,ts,vue}'],
  },
  presets: [
    presetUno(),
    presetIcons({
      extraProperties: {
        display: 'inline-block',
        'vertical-align': 'middle',
      },
    }),
    presetWebFonts({
      provider: 'bunny',
      fonts: {
        sans: ['Fredoka'],
      },
    }),
  ],
  transformers: [transformerVariantGroup(), transformerDirectives()],
})
