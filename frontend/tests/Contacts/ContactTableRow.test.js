import { shallowMount } from '@vue/test-utils';
import ContactTableRow from '@/components/contact/ContactTableRow.vue';
import { LucideUserCircle } from 'lucide-vue-next';

describe('ContactTableRow.vue', () => {
  const mockClient = {
    id: 1,
    name: 'John Doe',
    email: 'johndoe@example.com',
    phone: '1234567890',
    photo: 'https://example.com/photo.jpg',
  };

  it('renderiza os dados do cliente corretamente', () => {
    const wrapper = shallowMount(ContactTableRow, {
      props: { client: mockClient },
    });

    expect(wrapper.text()).toContain(mockClient.name);
    expect(wrapper.text()).toContain(mockClient.email);
    expect(wrapper.text()).toContain(mockClient.phone);
  });

  it('emite o evento "show-details" quando clicado em qualquer célula', async () => {
    const wrapper = shallowMount(ContactTableRow, {
      props: { client: mockClient },
    });

    await wrapper.find('td').trigger('click');

    expect(wrapper.emitted('show-details')).toBeTruthy();
    expect(wrapper.emitted('show-details')[0]).toEqual([mockClient.id]);
  });

  it('emite o evento "edit" quando o botão de editar é clicado', async () => {
    const wrapper = shallowMount(ContactTableRow, {
      props: { client: mockClient },
    });

    const editButton = wrapper.find('button.text-blue-600');
    await editButton.trigger('click');

    expect(wrapper.emitted('edit')).toBeTruthy();
    expect(wrapper.emitted('edit')[0]).toEqual([mockClient]);
  });

  it('emite o evento "delete" quando o botão de deletar é clicado', async () => {
    const wrapper = shallowMount(ContactTableRow, {
      props: { client: mockClient },
    });

    const deleteButton = wrapper.find('button.text-red-600');
    await deleteButton.trigger('click');

    expect(wrapper.emitted('delete')).toBeTruthy();
    expect(wrapper.emitted('delete')[0]).toEqual([mockClient]);
  });

  it('mostra a foto do cliente se existir, caso contrário exibe o ícone de usuário', () => {
    const wrapperWithPhoto = shallowMount(ContactTableRow, {
      props: { client: mockClient },
    });

    const imgWithPhoto = wrapperWithPhoto.find('img');
    expect(imgWithPhoto.exists()).toBe(true);
    expect(imgWithPhoto.attributes('src')).toBe(mockClient.photo);

    const wrapperWithoutPhoto = shallowMount(ContactTableRow, {
      props: { client: { ...mockClient, photo: null } },
    });

    const userIcon = wrapperWithoutPhoto.findComponent(LucideUserCircle);
    expect(userIcon.exists()).toBe(true);
  });
});
