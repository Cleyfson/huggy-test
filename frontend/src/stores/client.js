import { defineStore } from 'pinia';
import { useApi } from '@/composables/useApi';
import { useToast } from '@/composables/useToast';

export const useClientStore = defineStore('clients', {
  state: () => ({
    clients: [],
    filteredClients: [],
  }),

  actions: {
    async fetchClients() {
      const { api } = useApi();
      const { notifyError } = useToast();
      
      try {
        const response = await api.get('clients');
        this.clients = response.data.data;
        this.filteredClients = response.data.data;
      } catch (error) {
        notifyError('Erro ao buscar clientes:', error.response?.data?.message || error);
      }
    },

    async fetchClient(id) {
      const { api } = useApi();
      const { notifyError } = useToast();

      try {
        const response = await api.get(`clients/${id}`);
        return response.data.data;
      } catch (error) {
        notifyError('Erro ao buscar cliente:', error.response?.data?.message || error);
      }
    },

    async createClient(clientData) {
      const { api } = useApi();
      const { notifyError, notifySuccess } = useToast();

      try {
        const response = await api.post('clients', clientData);
        this.fetchClients();
        notifySuccess('Contato criado com sucesso');
        return response.data;
      } catch (error) {
        notifyError('Erro ao criar cliente:', error.response?.data?.message || error);
        throw error.response?.data?.message || error;
      }
    },

    async updateClient(id, clientData) {
      const { api } = useApi();
      const { notifyError, notifySuccess } = useToast();

      try {
        await api.put(`clients/${id}`, clientData);
        this.clients = this.clients.map(client => 
          client.id === id ? { ...client, ...clientData } : client
        );
        this.fetchClient(id);
        this.fetchClients();
        notifySuccess('Contato atualizado com sucesso');
      } catch (error) {
        notifyError('Erro ao atualizar cliente:', error.response?.data?.message || error);
        throw error.response?.data?.message || error;
      }
    },

    async deleteClient(id) {
      const { api } = useApi();
      const { notifyError, notifySuccess } = useToast();

      try {
        await api.delete(`clients/${id}`);
        this.clients = this.clients.filter(client => client.id !== id);
        notifySuccess('Contato deletado com sucesso');
      } catch (error) {
        notifyError('Erro ao exluir cliente:', error.response?.data?.message || error);
        throw error.response?.data?.message || error;
      }
    },

    async callClient(id) {
      const { api } = useApi();
      const { notifyError, notifyInfo } = useToast();

      try {
        const response = await api.post(`clients/${id}/call`);
        notifyInfo(`Chamada em fila de ${response.data.data.from} para ${response.data.data.to}. Status: ${response.data.data.status}`)
      } catch (error) {
        notifyError('Erro ao ligar para cliente:', error.response?.data?.message || error);
        throw error.response?.data?.message || error;
      }
    },

    filterClients(searchTerm) {
      if (!searchTerm) {
        this.filteredClients = this.clients;
      } else {
        const term = searchTerm.toLowerCase();
        this.filteredClients = this.clients.filter(client =>
          client.name.toLowerCase().includes(term) || 
          client.email.toLowerCase().includes(term) ||
          client.phone.toLowerCase().includes(term) ||
          client.mobile.toLowerCase().includes(term) ||
          client.district.toLowerCase().includes(term) ||
          client.state.toLowerCase().includes(term)
        );
      }
    }
  },
});
