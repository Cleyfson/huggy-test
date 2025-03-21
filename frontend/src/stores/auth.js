import { defineStore } from 'pinia';

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
      try {
        const { api } = useApi();
        const response = await api.post('/auth/login', credentials);

        this.setToken(response.data.access_token);
        return response.data;
      } catch (error) {
        throw error.response?.data?.message || 'Erro no login';
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
