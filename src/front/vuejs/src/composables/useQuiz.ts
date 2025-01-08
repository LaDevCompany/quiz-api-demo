import { reactive } from 'vue'

const score = reactive<Scoring>({
  easy: null,
  medium: null,
  hard: null,
})

export default function useQuiz() {
  const isValid = (question: Question, answers: string | string[]): boolean => {
    switch (question.type) {
      case 'solo':
        return isValidSolo(question.answers as AnswerClassic[], answers as string)
      case 'multi':
        return isValidMulti(question.answers as AnswerClassic[], answers as string[])
      case 'pattern':
        return isValidPattern(question.answers as AnswerPattern, answers as string)
      default:
        throw new Error('Type not implemented ;)')
    }
  }

  const isValidSolo = (answers: AnswerClassic[], id: string): boolean => {
    return answers.find((answer) => answer.id === id)?.isValid ?? false
  }

  const isValidMulti = (answers: AnswerClassic[], ids: string[]): boolean => {
    return answers.every((answer) => {
      // if answer is valid and is included in user answers
      if (answer.isValid && ids.includes(answer.id)) {
        return true
      }
      // if answer is NOT valid and is NOT in user answers
      else if (!answer.isValid && !ids.includes(answer.id)) {
        return true
      }

      return false
    })
  }

  const isValidPattern = (answers: AnswerPattern, answer: string): boolean => {
    return new RegExp(answers.pattern, 'gi').test(answer)
  }

  return {
    score,
    isValid,
    isValidPattern,
  }
}
