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
      if (authStore.token) {
        config.headers.Authorization = `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3NDI2MDM2ODksImV4cCI6MTc0MjYwNzI4OSwibmJmIjoxNzQyNjAzNjg5LCJqdGkiOiJ2M0x4aWNYUnZ6bjlEZVZjIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.zMnqRFIcOFZ7R0ERKYfhiDE1byeqfc_sIyViEJPy23E`;
      }
      return config;
    },
    (error) => Promise.reject(error)
  );

  api.interceptors.response.use(
    (response) => response,
    (error) => {
      const authStore = useAuthStore();

      if (error.response?.status === 401) {
        console.warn('Token expirado ou inválido. Realizando logout automático.');
        authStore.clearToken();
      }

      console.error('Erro na API:', error);
      return Promise.reject(error);
    }
  );

  return { api };
}
