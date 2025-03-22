import { vi } from 'vitest';
import { shallowMount } from '@vue/test-utils';
import ContactDetailsModal from '@/components/contact/ContactDetailsModal.vue';
import { useClientStore } from '@/stores/client';

// Mock do store
vi.mock('@/stores/client', () => ({
  useClientStore: vi.fn().mockReturnValue({
    callClient: vi.fn(),
  }),
}));

describe('ContactDetailsModal.vue', () => {
  const mockClient = {
    id: 1,
    name: 'John Doe',
    email: 'johndoe@example.com',
    address: '123 Main St',
    district: 'Downtown',
    city: 'Cityville',
    state: 'CV',
    photo: 'https://example.com/photo.jpg',
  };

  it('renderiza os detalhes do cliente corretamente', () => {
    const wrapper = shallowMount(ContactDetailsModal, {
      props: { client: mockClient },
    });

    expect(wrapper.text()).toContain(mockClient.name);
    expect(wrapper.text()).toContain(mockClient.email);
    expect(wrapper.text()).toContain(mockClient.address);
    expect(wrapper.text()).toContain(mockClient.district);
    expect(wrapper.text()).toContain(mockClient.city);
    expect(wrapper.text()).toContain(mockClient.state);
  });

  it('emite o evento "close" ao clicar no botão de fechar', async () => {
    const wrapper = shallowMount(ContactDetailsModal, {
      props: { client: mockClient },
    });
  
    const closeButton = wrapper.find('#close-button');
    await closeButton.trigger('click');
  
    expect(wrapper.emitted('close')).toBeTruthy();
  });
  
  it('emite o evento "delete" ao clicar no botão de deletar', async () => {
    const wrapper = shallowMount(ContactDetailsModal, {
      props: { client: mockClient },
    });
  
    const deleteButton = wrapper.find('#delete-button');
    await deleteButton.trigger('click');
  
    expect(wrapper.emitted('delete')).toBeTruthy();
    expect(wrapper.emitted('delete')[0]).toEqual([mockClient]);
  });
  
  it('emite o evento "edit" ao clicar no botão de editar', async () => {
    const wrapper = shallowMount(ContactDetailsModal, {
      props: { client: mockClient },
    });
  
    const editButton = wrapper.find('#edit-button');
    await editButton.trigger('click');
  
    expect(wrapper.emitted('edit')).toBeTruthy();
    expect(wrapper.emitted('edit')[0]).toEqual([mockClient]);
  });  

  it('chama a função callClient ao clicar no botão de chamada', async () => {
    const wrapper = shallowMount(ContactDetailsModal, {
      props: { client: mockClient },
    });

    const clientStore = useClientStore();
    const callClientMock = clientStore.callClient;

    const callButton = wrapper.find('#call-button');
    await callButton.trigger('click');

    expect(callClientMock).toHaveBeenCalledWith(mockClient.id);
  });
});
