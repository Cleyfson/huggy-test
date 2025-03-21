import { defineStore } from 'pinia';
import { useApi } from '@/composables/useApi';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    loading: false,
  }),

  actions: {
    async fetchUser() {
      const { api } = useApi();
      try {
        this.loading = true;
        const response = await api.get('/user');
        this.user = response.data;
      } catch (error) {
        console.error('Erro ao buscar usuário:', error);
      } finally {
        this.loading = false;
      }
    },
  },
});
