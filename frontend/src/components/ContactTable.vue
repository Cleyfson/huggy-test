<template>
  <div>
    <table class="min-w-full divide-y divide-gray-200">
      <thead>
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider flex items-center">
            Nome
            <LucideChevronDown class="h-4 w-4 ml-1" />
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Email
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Telefone
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <template v-if="clientStore.clients.length > 0">
          <tr 
            v-for="client in clientStore.clients" 
            :key="client.id" 
            class="hover:bg-gray-50 group"
          >
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              <div class="flex items-center space-x-2">
                <img 
                  v-if="client.photo" 
                  :src="client.photo" 
                  alt="Foto do cliente" 
                  class="h-8 w-8 rounded-full object-cover"
                />
                <LucideUserCircle v-else class="h-8 w-8 text-gray-400" />
                <span>{{ client.name }}</span>
              </div>
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ client.email }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ client.phone }}
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <button 
                  @click="$emit('edit', client)" 
                  class="text-blue-600 hover:text-blue-800"
                >
                  <LucideEdit class="h-5 w-5" />
                </button>
                <button 
                  @click="$emit('delete', client)" 
                  class="text-red-600 hover:text-red-800"
                >
                  <LucideTrash2 class="h-5 w-5" />
                </button>
              </div>
            </td>
          </tr>
        </template>
        <template v-else>
          <tr>
            <td colspan="5" class="px-6 py-50 text-center">
              <div class="flex flex-col items-center justify-center">
                <div class="bg-gray-100 rounded-full p-6 mb-4">
                  <LucideBookOpen class="h-32 w-32 text-gray-400" />
                </div>
                <p class="text-gray-500 mb-4">Ainda não há contatos</p>
                <button 
                  @click="$emit('add')"
                  class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center"
                >
                  <LucidePlus class="h-4 w-4 mr-1" />
                  Adicionar contato
                </button>
              </div>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useClientStore } from '@/stores/client';
import { LucideChevronDown, LucideBookOpen, LucidePlus, LucideEdit, LucideTrash2, LucideUserCircle } from 'lucide-vue-next';

const clientStore = useClientStore();

onMounted(() => {
  clientStore.fetchClients();
});
</script>
