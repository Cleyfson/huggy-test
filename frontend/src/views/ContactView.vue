<template>
  <div class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-xl font-medium text-gray-800 mb-4">Contatos</h1>

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

  const searchQuery = ref('')
  const showAddContactAddModal = ref(false)
  const selectedContact = ref(null)

  const closeModal = () => {
    showAddContactAddModal.value = false;
    selectedContact.value = {};
  }

  const editContact = (contact) => {
    selectedContact.value = contact
    showAddContactAddModal.value = true
  }
</script>
  