/// <reference types="vite/client" />

// Pour étendre l'interface ImportMetaEnv
interface ImportMetaEnv {
  readonly VITE_API_URL: string
  readonly VITE_QUIZAPI_URL: string
}

interface ImportMeta {
  readonly env: ImportMetaEnv
}
