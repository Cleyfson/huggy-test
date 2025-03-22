import { mount } from '@vue/test-utils'
import { describe, it, expect, beforeEach, vi } from 'vitest'
import InsightsByDistrict from '@/components/insights/InsightsByDistrict.vue'
import { useInsightStore } from '@/stores/insights'

vi.mock('@/stores/insights', () => ({
  useInsightStore: vi.fn(),
}))

describe('InsightsByDistrict.vue', () => {
  let mockStore

  beforeEach(() => {
    mockStore = {
      insights_district: [
        { district: 'São Paulo', total: 50 },
        { district: 'Rio de Janeiro', total: 30 },
      ],
      getClientsByDistrict: vi.fn(),
    }

    useInsightStore.mockReturnValue(mockStore)
  })

  it('renderiza o título corretamente', () => {
    const wrapper = mount(InsightsByDistrict)
    expect(wrapper.find('h2').text()).toBe('Segmentação por cidade')
  })

  it('chama getClientsByDistrict ao ser montado', () => {
    mount(InsightsByDistrict)
    expect(mockStore.getClientsByDistrict).toHaveBeenCalled()
  })

  it('renderiza a lista de cidades corretamente', async () => {
    const wrapper = mount(InsightsByDistrict)

    await wrapper.vm.$nextTick()

    const items = wrapper.findAll('span.text-sm.text-gray-600')
    expect(items.length).toBe(2)
    expect(items[0].text()).toBe('São Paulo')
    expect(items[1].text()).toBe('Rio de Janeiro')
  })
})
