import { describe, it, expect } from 'vitest'

import { mount } from '@vue/test-utils'
import testData from '@tests/fixtures/question-multi.json'
import { ref } from 'vue'
import AnswerMulti from '../../src/components/Views/Home/Quiz/Answers/AnswerMulti.vue'

describe('AnswerMulti', () => {
  it('renders properly', () => {
    const question: Question = testData as Question

    const wrapper = mount(AnswerMulti, {
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

    expect(wrapper.find('.grid').element.children.length).toBe(4)
    expect(wrapper.text()).toContain('Plusieurs réponses sont possible')
    ;['Brésil', 'Égypte', 'Afrique du Sud', 'Kenya'].forEach((country) => {
      expect(wrapper.text()).toContain(country)
    })
  })
})