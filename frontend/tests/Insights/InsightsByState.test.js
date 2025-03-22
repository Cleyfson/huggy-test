import { mount } from '@vue/test-utils'
import { describe, it, expect, beforeEach, vi } from 'vitest'
import InsightsByState from '@/components/insights/InsightsByState.vue'
import { useInsightStore } from '@/stores/insights'

vi.mock('@/stores/insights', () => ({
  useInsightStore: vi.fn(),
}))

describe('InsightsByState.vue', () => {
  let mockStore

  beforeEach(() => {
    mockStore = {
      insights_state: [
        { state: 'São Paulo', total: 50 },
        { state: 'Rio de Janeiro', total: 30 },
      ],
      getClientsByState: vi.fn(),
    }

    useInsightStore.mockReturnValue(mockStore)
  })

  it('renderiza o título corretamente', () => {
    const wrapper = mount(InsightsByState)
    expect(wrapper.find('h2').text()).toBe('Segmentação por estado')
  })

  it('chama getClientsByState ao ser montado', () => {
    mount(InsightsByState)
    expect(mockStore.getClientsByState).toHaveBeenCalled()
  })

  it('renderiza a lista de estados corretamente', async () => {
    const wrapper = mount(InsightsByState)

    await wrapper.vm.$nextTick()

    const items = wrapper.findAll('span.text-sm.text-gray-600')
    expect(items.length).toBe(2)
    expect(items[0].text()).toBe('São Paulo')
    expect(items[1].text()).toBe('Rio de Janeiro')
  })

  it('configura corretamente as opções do gráfico', async () => {
    const wrapper = mount(InsightsByState)
    
    await wrapper.vm.$nextTick()

    expect(wrapper.vm.chartOptions.labels).toEqual(['São Paulo', 'Rio de Janeiro'])
    expect(wrapper.vm.getSeries).toEqual([50, 30])
  })
})
