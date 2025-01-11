import { describe, it, expect } from 'vitest'

import { mount } from '@vue/test-utils'
import AnswerSolo from '@/components/Views/Home/Quiz/Answers/AnswerSolo.vue'
import testData from '@tests/fixtures/question-solo.json'
import { ref } from 'vue'

describe('AnswerSolo', () => {
  it('renders properly', () => {
    const question: Question = testData as Question

    const wrapper = mount(AnswerSolo, {
      props: {
        answers: question.answers,
      },
      global: {
        provide: {
          chosenAnswer: ref(''),
          setChosenAnswer: (answer: string) => {},
        },
      },
    })
    expect(wrapper.text()).toContain('Hello Vitest')
  })
})
