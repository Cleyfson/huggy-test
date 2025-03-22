import { vi } from 'vitest'
import { useRouter } from 'vue-router'
import { createPinia } from 'pinia'
import { shallowMount, mount } from '@vue/test-utils'
import InsightView from '@/views/InsightView.vue'
import InsightsByState from '@/components/insights/InsightsByState.vue'
import InsightsByDistrict from '@/components/insights/InsightsByDistrict.vue'

vi.mock('vue-router', () => ({
  useRouter: vi.fn(),
}))

describe('InsightView.vue', () => {
  let mockRouter

  beforeEach(() => {
    mockRouter = {
      back: vi.fn(),
    }
    useRouter.mockReturnValue(mockRouter)
  })

  it('renderiza o título "Dados sobre contatos"', () => {
    const wrapper = shallowMount(InsightView) 
    expect(wrapper.find('h1').text()).toBe('Dados sobre contatos')
  })

  it('verifica se o botão "Voltar" está renderizado e funcional', async () => {
    const wrapper = shallowMount(InsightView)

    const button = wrapper.find('button')
    expect(button.exists()).toBe(true)

    await button.trigger('click')

    expect(mockRouter.back).toHaveBeenCalled()
  })

  it('renderiza os componentes InsightsByState e InsightsByDistrict', () => {
    const pinia = createPinia()

    const wrapper = mount(InsightView, {
      global: {
        plugins: [pinia],
      },
    })

    expect(wrapper.findComponent(InsightsByState).exists()).toBe(true)
    expect(wrapper.findComponent(InsightsByDistrict).exists()).toBe(true)
  })
})
