import { describe, it, expect } from 'vitest'

import { mount } from '@vue/test-utils'
import Greeting from '../Greeting.vue'
import DiscountView from '../../views/DiscountView.vue'

describe('Greeting', () => {
  it('Renders greeting', () => {
    const wrapper = mount(Greeting, { props: { msg: 'Test greeting' } })
    expect(wrapper.text()).toContain("Test greeting")
  })

  it('Initializes selection', () => {
    const wrapper = mount(DiscountView)

    expect(wrapper.find('select.selectItem').exists()).toBe(true)
  })

  it('Selection has three options', () => {
    const wrapper = mount(DiscountView);
    const selectElement = wrapper.find('select.selectItem');
    const optionElements = selectElement.findAll('option');
    expect(optionElements.length).toBe(3);
  });
})
