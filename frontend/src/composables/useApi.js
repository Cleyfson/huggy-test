import axios from 'axios';
// import { useUserStore } from '@/stores/user';

export function useApi() {
  const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    timeout: 5000,
  });

  api.interceptors.request.use(
    (config) => {
      // const userStore = useUserStore();
      const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3NDI1MTcyMDIsImV4cCI6MTc0MjUyMDgwMiwibmJmIjoxNzQyNTE3MjAyLCJqdGkiOiJHRnVQSWJNZ0dQaTkzT1JiIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.hga_YWebaIwIGFJpPDiL4pNJ1zY37VokbcpsOP0x9Y4';

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
