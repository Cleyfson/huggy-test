<template>
  <div class="fixed inset-0 bg-gray-500/30 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-xl w-full">
      <div class="flex justify-between items-center mb-2 px-5 pt-5">
        <h2 class="text-xl font-medium text-gray-800">{{ contact ? 'Editar Contato' : 'Adicionar Contato' }}</h2>
        <button @click="$emit('remove')" class="text-gray-400 hover:text-gray-500">
          <XIcon class="h-5 w-5" />
        </button>
      </div>

      <div class="relative flex py-4 items-center">
        <div class="flex-grow border-t border-gray-400/30"></div>
        <div class="flex-grow border-t border-gray-400/30"></div>
      </div>
      
      <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ errors, isSubmitting }">
        <div class="px-5 pb-5">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
            <Field 
              name="name" 
              type="text" 
              placeholder="Nome"
              class="w-84 px-3 py-1 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              :class="{ 'border-red-500': errors.name }"
              :value="contact?.name"
            />
            <div>
              <ErrorMessage name="name" class="text-red-500 text-xs mt-1" />
            </div>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <Field 
              name="email" 
              type="email" 
              placeholder="Email"
              class="w-84 px-3 py-1 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              :class="{ 'border-red-500': errors.email }"
              :value="contact?.email"
            />
            <div>
              <ErrorMessage name="email" class="text-red-500 text-xs mt-1" />
            </div>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
            <Field 
              name="phone" 
              type="tel" 
              placeholder="Telefone"
              class="w-54 px-3 py-1 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              :class="{ 'border-red-500': errors.phone }"
              :value="contact?.phone"
            />
            <div>
              <ErrorMessage name="phone" class="text-red-500 text-xs mt-1" />
            </div>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Celular</label>
            <Field 
              name="mobile" 
              type="tel" 
              placeholder="Celular"
              class="w-54 px-3 py-1 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              :class="{ 'border-red-500': errors.mobile }"
              :value="contact?.mobile"
            />
            <div>
              <ErrorMessage name="mobile" class="text-red-500 text-xs mt-1" />
            </div>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
            <Field 
              name="address" 
              type="text" 
              placeholder="Endereço"
              class="w-110 px-3 py-1 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              :class="{ 'border-red-500': errors.address }"
              :value="contact?.address"
            />
            <div>
              <ErrorMessage name="address" class="text-red-500 text-xs mt-1" />
            </div>
          </div>

          <div class="mb-4 flex gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
              <Field 
                name="district" 
                type="text" 
                placeholder="Bairro"
                class="w-54 px-3 py-1 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                :class="{ 'border-red-500': errors.district }"
                :value="contact?.district"
              />
              <div>
                <ErrorMessage name="district" class="text-red-500 text-xs mt-1" />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
              <Field 
                name="state" 
                type="text" 
                placeholder="Estado"
                class="w-34 px-3 py-1 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                :class="{ 'border-red-500': errors.state }"
                :value="contact?.state"
              />
              <div>
                <ErrorMessage name="state" class="text-red-500 text-xs mt-1" />
              </div>
            </div>
          </div>

          <div class="relative flex py-4 items-center">
            <div class="flex-grow border-t border-gray-400/30"></div>
            <div class="flex-grow border-t border-gray-400/30"></div>
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
              type="submit"
              :disabled="isSubmitting"
              class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700"
            >
              {{ isSubmitting ? 'Salvando...' : 'Salvar' }}
            </button>
          </div>
        </div>
      </Form>
    </div>
  </div>
</template>

<script setup>
  import { XIcon } from 'lucide-vue-next'
  import { useClientStore } from '@/stores/client'
  import { Form, Field, ErrorMessage } from 'vee-validate'
  import * as yup from 'yup'

  const emit = defineEmits(['remove'])
  const clientStore = useClientStore()

  const schema = yup.object({
    name: yup.string().required('Nome é obrigatório'),
    email: yup.string().required('Email é obrigatório').email('Email inválido'),
    phone: yup.string().required('Telefone é obrigatório'),
    mobile: yup.string().required('Celular é obrigatório'),
    address: yup.string().required('Endereço é obrigatório'),
    district: yup.string().required('Bairro é obrigatório'),
    state: yup.string().required('Estado é obrigatório')
  })

  const props = defineProps({
    contact: Object
  })

  const onSubmit = async (values) => {
    try {
      if (props.contact) {
        await clientStore.updateClient(props.contact.id, values)
      } else {
        await clientStore.createClient(values)
      }
      emit('remove')
    } catch (error) {
      console.error('Erro ao salvar contato', error)
    }
  }
</script>
