declare global {
  export interface Question {
    id: string
    type: QuestionType
    title: string
    description: string
    difficulty: number
    theme?: Theme
    answers: AnswerClassic[] | AnswerPattern
  }

  export interface AnswerClassic {
    id: string
    title: string
    isValid: boolean
  }

  export interface AnswerPattern {
    id: string
    pattern: string
  }

  export interface Scoring {
    easy: boolean | null
    medium: boolean | null
    hard: boolean | null
  }

  export type QuestionType = 'solo' | 'multi' | 'pattern'
  export type AnswerClassicStatus =
    | 'indeterminate'
    | 'valid'
    | 'invalid'
    | 'missed'
    | 'selected'
    | 'disable'
  export type Difficulties = 'easy' | 'medium' | 'hard'
  export type QuestionState = 'guessing' | 'answered' | 'validated'
}

export {}
