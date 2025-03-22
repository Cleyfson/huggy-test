<template>
  <div class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
      <div class="flex justify-between items-center px-1 py-2">
        <h1 class="text-xl font-medium text-gray-800 mb-4">Contatos</h1>
        <button 
          @click="goToInsights"
          class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md text-sm text-gray-700 flex justify-between items-center"
        >
          <h1>Dados</h1>
          <ArrowRight class="pl-2"/>
        </button>
      </div>

      <ContactCard>
        <template #header>
          <SearchBar v-model="searchQuery" @add="showAddContactAddModal = true" />
        </template>

        <ContactTable @add="showAddContactAddModal = true" @edit="editContact" />
      </ContactCard>
    </div>

    <ContactAddModal
      v-if="showAddContactAddModal"
      v-model:visible="showAddContactAddModal"
      @remove="closeModal()"
      :contact="selectedContact"s
    />
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import ContactCard from '@/components/contact/ContactCard.vue'
  import SearchBar from '@/components/contact/SearchBar.vue'
  import ContactTable from '@/components/contact/ContactTable.vue'
  import ContactAddModal from '@/components/contact/ContactAddModal.vue'
  import { ArrowRight } from 'lucide-vue-next';
  import { useRouter } from 'vue-router'

  const router = useRouter()

  const searchQuery = ref('')
  const showAddContactAddModal = ref(false)
  const selectedContact = ref(null)

  const closeModal = () => {
    showAddContactAddModal.value = false;
    selectedContact.value = null;
  }

  const editContact = (contact) => {
    selectedContact.value = contact
    showAddContactAddModal.value = true
  }

  const goToInsights = () => {
    router.push('/insights')
  }
</script>
  