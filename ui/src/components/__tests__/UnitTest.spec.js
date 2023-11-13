import { describe, it, expect } from 'vitest'

import { mount } from '@vue/test-utils'
import GreetingItem from '../GreetingItem.vue'
import DiscountView from '../../views/DataView.vue'

describe('Greeting', () => {
  it('Renders greeting', () => {
    const wrapper = mount(GreetingItem, { props: { msg: 'Test greeting' } })
    expect(wrapper.text()).toContain("Test greeting")
  })

  it('Initializes selection', () => {
    const wrapper = mount(DiscountView)

    expect(wrapper.find('select.selectItem').exists()).toBe(true)
  })

  it('Selection has one option for all customers', () => {
    const wrapper = mount(DiscountView);
    const selectElement = wrapper.find('select.selectItem');
    const optionElements = selectElement.findAll('option');
    expect(optionElements[0].text()).toBe('Customers');
  });
})
