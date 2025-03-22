import { vi } from 'vitest';
import { shallowMount } from '@vue/test-utils';
import SearchBar from '@/components/contact/SearchBar.vue';
import { useClientStore } from '@/stores/client';

vi.mock('@/stores/client', () => ({
  useClientStore: vi.fn(),
}));

describe('SearchBar.vue', () => {
  let mockClientStore;

  beforeEach(() => {
    mockClientStore = {
      filterClients: vi.fn(),
    };
    useClientStore.mockReturnValue(mockClientStore);
  });

  it('renderiza o campo de busca com o placeholder correto', () => {
    const wrapper = shallowMount(SearchBar);

    const input = wrapper.find('input');
    expect(input.exists()).toBe(true);
    expect(input.attributes('placeholder')).toBe('Buscar contato');
  });

  it('chama filterClients no clientStore quando o valor do input de busca muda', async () => {
    const wrapper = shallowMount(SearchBar);

    const input = wrapper.find('input');
    await input.setValue('Novo contato');

    expect(mockClientStore.filterClients).toHaveBeenCalledWith('Novo contato');
  });

  it('emite o evento "add" quando o botão "Adicionar contato" é clicado', async () => {
    const wrapper = shallowMount(SearchBar);

    const button = wrapper.find('button');
    await button.trigger('click');

    expect(wrapper.emitted('add')).toBeTruthy();
  });
});
