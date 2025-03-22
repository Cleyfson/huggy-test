import { shallowMount, mount } from '@vue/test-utils';
import { useClientStore } from '@/stores/client';
import { createPinia } from 'pinia'
import ContactTable from '@/components/contact/ContactTable.vue';
import ContactTableRow from '@/components/contact/ContactTableRow.vue';
import ContactTableHeader from '@/components/contact/ContactTableHeader.vue';

import { vi } from 'vitest';

vi.mock('@/stores/client', () => ({
  useClientStore: vi.fn(),
}));

const mockClient = {
  id: 1,
  name: 'John Doe',
  email: 'john.doe@example.com',
  phone: '123456789',
};

describe('ContactTable.vue', () => {
  let wrapper;
  let clientStore;

  beforeEach(() => {
    clientStore = {
      filteredClients: [mockClient],
      fetchClients: vi.fn(),
      fetchClient: vi.fn().mockResolvedValue(mockClient),
      deleteClient: vi.fn(),
    };

    useClientStore.mockReturnValue(clientStore);

    wrapper = shallowMount(ContactTable);
  });

  it('renderiza os dados dos clientes corretamente', () => {
    const rows = wrapper.findAllComponents(ContactTableRow);
    expect(rows.length).toBe(1);
    expect(rows.at(0).props().client).toBe(mockClient);
  });

  it('renderiza os componentes filhos corretamente', () => {
    const pinia = createPinia()

    const wrapper = mount(ContactTable, {
      global: {
        plugins: [pinia],
      },
    })

    expect(wrapper.findComponent(ContactTableRow).exists()).toBe(true)
    expect(wrapper.findComponent(ContactTableHeader).exists()).toBe(true)
  })
});
