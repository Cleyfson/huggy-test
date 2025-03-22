import { vi } from 'vitest'
import { defineComponent } from 'vue'
import { config } from '@vue/test-utils'

vi.spyOn(console, 'error').mockImplementation(() => {})
vi.spyOn(console, 'warn').mockImplementation((msg) => {
  if (msg.includes('Failed to resolve component: apexchart')) return
  console.warn(msg)
})

config.global.mocks = {
  $t: (msg) => msg,
}

vi.mock('vue3-apexcharts', () => ({
  default: defineComponent({
    template: '<div />',
  }),
}))
