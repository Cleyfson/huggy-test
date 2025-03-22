import { vi } from 'vitest';
import { shallowMount } from '@vue/test-utils';
import LoginComponent from '@/views/LoginView.vue';
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';
import { useToast } from '@/composables/useToast';

vi.mock('@/stores/auth', () => ({
  useAuthStore: vi.fn(),
}));

vi.mock('vue-router', () => ({
  useRouter: vi.fn(),
}));

vi.mock('@/composables/useToast', () => ({
  useToast: vi.fn(),
}));

describe('LoginComponent.vue', () => {
  let mockRouter;
  let mockAuthStore;
  let mockToast;

  beforeEach(() => {

    mockRouter = { push: vi.fn() };
    useRouter.mockReturnValue(mockRouter);

    mockAuthStore = {
      login: vi.fn(),
    };
    useAuthStore.mockReturnValue(mockAuthStore);

    mockToast = { notifyError: vi.fn() };
    useToast.mockReturnValue(mockToast);
  });

  it('renderiza o botão "Fazer login com a Huggy"', () => {
    const wrapper = shallowMount(LoginComponent);
    const button = wrapper.find('button');
    expect(button.exists()).toBe(true);
    expect(button.text()).toBe('Fazer login com a Huggy');
  });

  it('chama a função handleLogin quando o botão é clicado', async () => {
    const wrapper = shallowMount(LoginComponent);
    const button = wrapper.find('button');

    await button.trigger('click');

    expect(mockAuthStore.login).toHaveBeenCalledWith({
      email: 'user@example.com',
      password: 'senha123',
    });
  });

  it('realiza a navegação para a página "contact" após login bem-sucedido', async () => {
    mockAuthStore.login.mockResolvedValueOnce();

    const wrapper = shallowMount(LoginComponent);
    const button = wrapper.find('button');

    await button.trigger('click');

    expect(mockRouter.push).toHaveBeenCalledWith({ name: 'contact' });
  });

  it('chama a função notifyError se ocorrer um erro no login', async () => {
    const error = new Error('Erro no login');
    mockAuthStore.login.mockRejectedValueOnce(error);

    const wrapper = shallowMount(LoginComponent);
    const button = wrapper.find('button');

    await button.trigger('click');

    expect(mockToast.notifyError).toHaveBeenCalledWith('Erro ao fazer login:', error);
  });
});
