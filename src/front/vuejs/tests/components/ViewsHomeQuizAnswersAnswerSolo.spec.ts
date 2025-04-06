import { describe, it, expect } from 'vitest'

import { mount } from '@vue/test-utils'
import AnswerSolo from '@/components/Views/Home/Quiz/Answers/AnswerSolo.vue'
import testData from '@tests/fixtures/question-solo.json'

describe('AnswerSolo', () => {
  it('renders properly', () => {
    const question: Question = testData as Question

    const wrapper = mount(AnswerSolo, {
      props: {
        answers: question.answers,
      },
    })

    expect(wrapper.element.children.length).toBe(3)
    expect(wrapper.text()).toContain('50°')
    expect(wrapper.text()).toContain('100°')
    expect(wrapper.text()).toContain('120°')
  })
})
