<template>
  <thead>
    <tr>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider flex items-center">
        Nome
        <img class="pl-2" :src="South" alt="chevron down">
      </th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
        Email
      </th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
        Telefone
      </th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
      </th>
    </tr>
  </thead>
</template>

<script setup>
  import South from '@/assets/svg/south.svg';
</script>