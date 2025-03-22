<template>
  <div class="flex items-center justify-between w-full">
    <div class="relative">
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <SearchIcon class="h-4 w-4 text-gray-400" />
      </div>
      <input v-model="searchTerm" type="text" placeholder="Buscar contato" class="pl-10 pr-4 py-2 border border-gray-200 rounded-md bg-gray-100 w-72 text-sm focus:ring-2 focus:ring-indigo-500" />
    </div>
    <div class="flex items-center gap-2">
      <button 
        @click="$emit('add')"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center"
      >
      <PlusIcon class="h-4 w-4 mr-1" />
        Adicionar contato
      </button>
      <button class="p-2 text-gray-500 hover:text-gray-700">
        <img :src="Report" alt="report">
      </button>
    </div>
  </div>
</template>
<script setup>
  import { ref, watch } from 'vue';
  import { useClientStore } from '@/stores/client';
  import { SearchIcon, PlusIcon } from 'lucide-vue-next'
  import Report from '@/assets/svg/report.svg';

  const searchTerm = ref('');
  const clientStore = useClientStore();

  watch(searchTerm, (newVal) => {
    clientStore.filterClients(newVal);
  });
</script>