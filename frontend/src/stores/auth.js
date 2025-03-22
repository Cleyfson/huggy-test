import { defineStore } from 'pinia';
import { useApi } from '@/composables/useApi';
import { useToast } from '@/composables/useToast';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: localStorage.getItem('access_token') || null,
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
  },

  actions: {
    setToken(token) {
      this.token = token;
      localStorage.setItem('access_token', token);
    },

    clearToken() {
      this.token = null;
      localStorage.removeItem('access_token');
    },

    async login(credentials) {
      const { api } = useApi();
      const { notifyError, notifySuccess } = useToast();

      try {
        const response = await api.post('/auth/login', credentials);
        this.setToken(response.data.access_token);

        notifySuccess('Login efetuado com sucesso!');
        return response.data;
      } catch (error) {
        notifyError('Erro ao fazer login:', error.response?.data?.message || error);
        throw error.response?.data?.message || error;
      }
    },

    async logout() {
      try {
        const { api } = useApi();
        await api.post('/auth/logout');

        this.clearToken();
      } catch (error) {
        console.error('Erro ao deslogar:', error);
      }
    },
  },
});
