import { defineStore } from 'pinia';
import { useApi } from '@/composables/useApi';

export const useClientStore = defineStore('clients', {
  state: () => ({
    clients: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetchClients() {
      const { api } = useApi();
      this.loading = true;
      this.error = null;
      try {
        const response = await api.get('clients');
        this.clients = response.data.data;
      } catch (error) {
        this.error = 'Erro ao buscar clientes';
        console.error(this.error, error);
      } finally {
        this.loading = false;
      }
    },

    async fetchClient(id) {
      const { api } = useApi();
      try {
        const response = await api.get(`clients/${id}`);
        return response.data;
      } catch (error) {
        console.error('Erro ao buscar cliente:', error);
        return null;
      }
    },

    async createClient(clientData) {
      const { api } = useApi();
      try {
        const response = await api.post('clients', clientData);
        this.clients.push(response.data);
        return response.data;
      } catch (error) {
        console.error('Erro ao criar cliente:', error);
        throw error;
      }
    },

    async updateClient(id, clientData) {
      const { api } = useApi();
      try {
        await api.put(`clients/${id}`, clientData);
        this.clients = this.clients.map(client => 
          client.id === id ? { ...client, ...clientData } : client
        );
      } catch (error) {
        console.error('Erro ao atualizar cliente:', error);
        throw error;
      }
    },

    async deleteClient(id) {
      const { api } = useApi();
      try {
        await api.delete(`clients/${id}`);
        this.clients = this.clients.filter(client => client.id !== id);
      } catch (error) {
        console.error('Erro ao excluir cliente:', error);
        throw error;
      }
    },

    async callClient(id) {
      const { api } = useApi();
      try {
        await api.post(`clients/${id}/call`);
      } catch (error) {
        console.error('Erro ao chamar cliente:', error);
        throw error;
      }
    },
  },
});
