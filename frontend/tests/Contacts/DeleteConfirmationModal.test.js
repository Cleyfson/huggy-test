import { shallowMount } from '@vue/test-utils';
import DeleteConfirmationModal from '@/components/contact/DeleteConfirmationModal.vue';

const mockClient = {
  id: 1,
  name: 'John Doe',
};

describe('DeleteConfirmationModal.vue', () => {

  it('emite o evento "cancel" ao clicar no botão "Cancelar"', async () => {
    const wrapper = shallowMount(DeleteConfirmationModal, {
      props: { client: mockClient },
    });

    const cancelButton = wrapper.find('#cancel-button');
    await cancelButton.trigger('click');

    expect(wrapper.emitted('cancel')).toBeTruthy();
  });

  it('emite o evento "confirm" ao clicar no botão "Excluir"', async () => {
    const wrapper = shallowMount(DeleteConfirmationModal, {
      props: { client: mockClient },
    });

    const confirmButton = wrapper.find('#confirm-button');
    await confirmButton.trigger('click');

    expect(wrapper.emitted('confirm')).toBeTruthy();
  });

});
