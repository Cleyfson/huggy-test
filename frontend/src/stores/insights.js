import { defineStore } from 'pinia';
import { useApi } from '@/composables/useApi';
import { useToast } from '@/composables/useToast';

export const useInsightStore = defineStore('insights', {
  state: () => ({
    insights_district: [],
    insights_state: [],
  }),

  actions: {
    async getClientsByDistrict() {
      const { api } = useApi();
      const { notifyError } = useToast();
      
      try {
        const response = await api.get('/insights/clients/district');
        this.insights_district = response.data.data;
      } catch (error) {
        notifyError('Erro ao buscar clientes:' + (error.response?.data?.message || error));
      }
    },

    async getClientsByState() {
      const { api } = useApi();
      const { notifyError } = useToast();
      
      try {
        const response = await api.get('/insights/clients/state');
        this.insights_state = response.data.data;
      } catch (error) {
        notifyError('Erro ao buscar clientes:' + (error.response?.data?.message || error));
      }
    },
  },
});
