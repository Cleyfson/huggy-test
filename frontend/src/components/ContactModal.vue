<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-medium text-gray-800">Adicionar contato</h2>
        <button @click="$emit('remove')" class="text-gray-400 hover:text-gray-500">
          <XIcon class="h-5 w-5" />
        </button>
      </div>
      
      <form @submit.prevent="addContact">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
          <input 
            type="text" 
            v-model="newContact.name" 
            required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
          />
        </div>
        
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input 
            type="email" 
            v-model="newContact.email" 
            required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
          />
        </div>
        
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
          <input 
            type="tel" 
            v-model="newContact.phone" 
            required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
          />
        </div>
        
        <div class="flex justify-end gap-2">
          <button 
            type="button"
            @click="$emit('remove')"
            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
          >
            Cancelar
          </button>
          <button 
            @click="$emit('remove')"
            type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700"
          >
            Salvar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup>
  import { ref , defineEmits } from 'vue'
  import { XIcon } from 'lucide-vue-next'

  const emit = defineEmits(['update:modelValue', 'remove'])

  const newContact = ref({ name: '', email: '', phone: '' })
</script>
  