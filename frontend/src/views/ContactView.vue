<template>
    <div class="bg-gray-50 min-h-screen p-6">
      <div class="max-w-4xl mx-auto">
        <h1 class="text-xl font-medium text-gray-800 mb-4">Contatos</h1>
        
        <ContactCard>
          <template #header>
            <SearchBar v-model="searchQuery" @add="showAddContactModal = true" />
          </template>
          
          <ContactTable :contacts="filteredContacts" @add="showAddContactModal = true" />
        </ContactCard>
      </div>
  
      <ContactModal v-if="showAddContactModal" v-model:visible="showAddContactModal" @save="addContact" @remove="showAddContactModal = false" />
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue'
  import ContactCard from '@/components/ContactCard.vue'
  import SearchBar from '@/components/SearchBar.vue'
  import ContactTable from '@/components/ContactTable.vue'
  import ContactModal from '@/components/ContactModal.vue'
  
  const contacts = ref([])
  const searchQuery = ref('')
  const showAddContactModal = ref(false)
  
  const filteredContacts = computed(() => {
    if (!searchQuery.value) return contacts.value
    const query = searchQuery.value.toLowerCase()
    return contacts.value.filter(contact =>
      contact.name.toLowerCase().includes(query) ||
      contact.email.toLowerCase().includes(query) ||
      contact.phone.toLowerCase().includes(query)
    )
  })
  
  function addContact(newContact) {
    contacts.value.push({ id: Date.now(), ...newContact })
    showAddContactModal.value = false
  }
  </script>
  