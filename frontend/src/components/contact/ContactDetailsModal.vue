<template>
    <div class="fixed inset-0 z-10 bg-gray-500/40">
      <div class="absolute top-1/2 left-0 right-0 mx-auto max-w-2xl bg-white rounded-lg shadow-sm transform -translate-y-1/2">
        <div class="flex justify-between items-center px-6 pt-6">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-purple-700 text-white flex items-center justify-center text-sm font-medium">
              <img :src="client.photo" alt="">
            </div>
            <h2 class="text-lg font-medium text-gray-800">{{ client.name }}</h2>
          </div>
          <div class="flex items-center gap-7">
            <button @click="callContact(client.id)" class="text-gray-400 hover:text-gray-500">
              <PhoneCallIcon class="h-5 w-5" />
            </button>
            <button @click="$emit('delete', client)" class="p-1">
              <img :src="Trash" alt="trash can icon">
            </button>
            <button @click="$emit('edit', client)" class="p-1">
              <img :src="Edit" alt="pen icon">
            </button>
            <button @click="$emit('close')" class="text-gray-400 hover:text-gray-500">
              <XIcon class="h-5 w-5" />
            </button>
          </div>
        </div>
        <div class="relative flex py-4 items-center">
          <div class="flex-grow border-t border-gray-400/30"></div>
          <div class="flex-grow border-t border-gray-400/30"></div>
        </div>
        <div class="space-y-4 px-6 pb-6">
          <div class="flex">
            <div class="w-24 text-sm text-gray-500 text-right pr-3">Email</div>
            <div class="flex-1 text-sm text-gray-800">{{ client.email }}</div>
          </div>
          
          <div class="flex">
            <div class="w-24 text-sm text-gray-500 text-right pr-3">Endereço</div>
            <div class="flex-1 text-sm text-gray-800">{{ client.address }}</div>
          </div>
          
          <div class="flex">
            <div class="w-24 text-sm text-gray-500 text-right pr-3">Bairro</div>
            <div class="flex-1 text-sm text-gray-800">{{ client.district }}</div>
          </div>
          
          <div class="flex">
            <div class="w-24 text-sm text-gray-500 text-right pr-3">Cidade</div>
            <div class="flex-1 text-sm text-gray-800">{{ client.city }}</div>
          </div>
          
          <div class="flex">
            <div class="w-24 text-sm text-gray-500 text-right pr-3">Estado</div>
            <div class="flex-1 text-sm text-gray-800">{{ client.state }}</div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { XIcon, PhoneCallIcon } from 'lucide-vue-next';
  import Edit from '@/assets/svg/edit.svg';
  import Trash from '@/assets/svg/trash.svg';
  import { useClientStore } from '@/stores/client';
 
  const clientStore = useClientStore();

  defineProps({
    client: {
      type: Object,
      required: true
    }
  });
  
  defineEmits(['close', 'edit', 'delete']);

  const callContact = async (id) => {
    await clientStore.callClient(id);
  };
</script>