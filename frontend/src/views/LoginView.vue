<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center">
      <h1 class="text-xl font-medium text-gray-800 mb-4">Login</h1>
      <button 
          @click="handleLogin"
          class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm py-2 px-4 rounded-lg transition duration-200"
      >
          Fazer login com a Huggy
      </button>
    </div>
  </div>
</template>

<script setup>
  import { useAuthStore } from '@/stores/auth';
  import { useRouter } from 'vue-router';
  import { useToast } from '@/composables/useToast';

  const authStore = useAuthStore();
  const router = useRouter();
  const { notifyError } = useToast();

  const handleLogin = async () => {
    try {
      const credentials = { email: 'user@example.com', password: 'senha123' };
      await authStore.login(credentials);
      
      router.push({ name: 'contact' });
    } catch (error) {
      notifyError('Erro ao fazer login:', error);
    }
  };
</script>