<template>
  <div>
    <table class="min-w-full divide-y divide-gray-200">
      <ContactTableHeader />
      <tbody class="bg-white">
        <template v-if="clientStore.clients.length > 0">
          <ContactTableRow 
            v-for="client in clientStore.clients" 
            :key="client.id" 
            :client="client"
            @show-details="showClientDetails"
            @edit="$emit('edit', $event)"
            @delete="handleDelete"
          />
        </template>
        <template v-else>
          <tr>
            <td colspan="5" class="px-6 py-50 text-center">
              <div class="flex flex-col items-center justify-center">
                <div class="bg-gray-100 rounded-full p-6 mb-4">
                  <img :src="BookOpen" alt="open book">
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
    
    <ContactDetailsModal 
      v-if="isClientModalOpen" 
      :client="selectedClient"
      @close="closeClientModal"
      @edit="$emit('edit', $event)"
      @delete="handleDelete"
    />
    
    <DeleteConfirmationModal 
      v-if="isDeleteModalOpen" 
      :client="clientToDelete"
      @cancel="cancelDelete"
      @confirm="confirmDelete"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useClientStore } from '@/stores/client';
import { LucidePlus } from 'lucide-vue-next';
import ContactTableHeader from './ContactTableHeader.vue';
import ContactTableRow from './ContactTableRow.vue';
import ContactDetailsModal from './ContactDetailsModal.vue';
import DeleteConfirmationModal from './DeleteConfirmationModal.vue';
import BookOpen from '@/assets/svg/book_open1.svg';

const clientStore = useClientStore();

const isDeleteModalOpen = ref(false);
const clientToDelete = ref(null);
const isClientModalOpen = ref(false);
const selectedClient = ref(null);

onMounted(() => {
  clientStore.fetchClients();
});

const showClientDetails = async (id) => {
  const client = await clientStore.fetchClient(id);
  if (client) {
    selectedClient.value = client;
    isClientModalOpen.value = true;
  } else {
    console.error('Cliente não encontrado');
  }
};

const closeClientModal = () => {
  isClientModalOpen.value = false;
  selectedClient.value = null;
};

const handleDelete = (client) => {
  clientToDelete.value = client;
  isDeleteModalOpen.value = true;
};

const cancelDelete = () => {
  isDeleteModalOpen.value = false;
  clientToDelete.value = null;
};

const confirmDelete = () => {
  if (clientToDelete.value) {
    clientStore.deleteClient(clientToDelete.value.id);
    isDeleteModalOpen.value = false;
    isClientModalOpen.value = false;
    clientToDelete.value = null;
  }
};

defineEmits(['edit', 'add']);
</script>