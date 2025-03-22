<template>
  <tr class="hover:bg-gray-50 group">
    <td @click="$emit('show-details', client.id)" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
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

    <td @click="$emit('show-details', client.id)" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
      {{ client.email }}
    </td>

    <td @click="$emit('show-details', client.id)" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
      {{ client.phone }}
    </td>

    <td class="pl-6 py-4 whitespace-nowrap text-sm text-gray-500">
      <div class="flex items-center opacity-0 group-hover:opacity-100 transition-opacity gap-4">
        <button 
          @click="$emit('edit', client)" 
          class="text-blue-600 hover:text-blue-800"
        >
          <img :src="Edit" alt="pen icon" class="h-5 w-5">
        </button>
        <button 
          @click="$emit('delete', client)" 
          class="text-red-600 hover:text-red-800"
        >
          <img :src="Trash" alt="trash can icon" class="h-5 w-5">
        </button>
      </div>
    </td>
  </tr>
</template>

<script setup>
  import { LucideUserCircle } from 'lucide-vue-next';
  import Edit from '@/assets/svg/edit.svg';
  import Trash from '@/assets/svg/trash.svg';

  defineProps({
    client: {
      type: Object,
      required: true
    }
  });

  defineEmits(['show-details', 'edit', 'delete']);
</script>