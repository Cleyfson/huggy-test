<template>
  <div class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-xl font-medium text-gray-800 mb-6">Dados sobre contatos</h1>

      <div class="bg-white rounded-lg p-6 shadow-sm">
        <button 
          @click="goBack"
          class="flex items-center text-gray-600 mb-8 hover:text-gray-800 transition-colors"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Voltar
        </button>

        <InsightsByState />
        <InsightsByDistrict />
      </div>
    </div>
  </div>
</template>

<script setup>
  import InsightsByState from '@/components/insights/InsightsByState.vue';
  import InsightsByDistrict from '@/components/insights/InsightsByDistrict.vue';
  import { useRouter } from 'vue-router'

  const router = useRouter()

  const goBack = () => {
    router.back()
  }
</script>
