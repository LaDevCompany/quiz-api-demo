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
          chosenAnswer: {
            chosenAnswer: ref(''),
            setChosenAnswer: () => {},
          },
          questionState: ref<QuestionState>('guessing'),
        },
      },
    })

    expect(wrapper.element.children.length).toBe(3)
    expect(wrapper.text()).toContain('50°')
    expect(wrapper.text()).toContain('100°')
    expect(wrapper.text()).toContain('120°')
  })
})
