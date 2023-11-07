import { describe, it, expect } from 'vitest'

import { mount } from '@vue/test-utils'
import SelectItem from '../SelectItem.vue'

describe('SelectItem', () => {
  it('Can select an item', () => {
    const wrapper = mount(SelectItem, { props: { msg: 'sales' } })
    expect(wrapper.text()).toContain("Sales")
  })
})
