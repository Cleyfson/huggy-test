import axios from 'axios';
import { useAuthStore } from '@/stores/auth';

export function useApi() {
  const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    timeout: 5000,
  });

  api.interceptors.request.use(
    (config) => {
      const authStore = useAuthStore();
      const token = authStore.token;

      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }

      return config;
    },
    (error) => Promise.reject(error)
  );

  api.interceptors.response.use(
    (response) => response,
    (error) => {
      console.error('Erro na API:', error);
      return Promise.reject(error);
    }
  );

  return { api };
}
