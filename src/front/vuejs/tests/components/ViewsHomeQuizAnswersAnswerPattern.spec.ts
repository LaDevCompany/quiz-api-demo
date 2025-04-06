import { describe, it, expect } from 'vitest'

import { mount } from '@vue/test-utils'
import testData from '@tests/fixtures/question-pattern.json'
import AnswerPattern from '@/components/Views/Home/Quiz/Answers/AnswerPattern.vue'

describe('AnswerPattern', () => {
  it('renders properly', () => {
    const question: Question = testData as Question

    const wrapper = mount(AnswerPattern, {
      props: {
        answers: question.answers,
      },
    })

    expect(wrapper.html()).toContain('Tapez la réponse ...')
  })
})
