import { defineStore } from 'pinia';
import { useApi } from '@/composables/useApi';

export const useClientStore = defineStore('clients', {
  state: () => ({
    clients: [],
    loading: false,
  }),

  actions: {
    async fetchClients() {
      const { api } = useApi();
      this.loading = true;
      try {
        const response = await api.get('clients');
        this.clients = response.data.data;
      } catch (error) {
        console.error('Erro ao buscar clientes:', error);
      } finally {
        this.loading = false;
      }
    },
  },
});
