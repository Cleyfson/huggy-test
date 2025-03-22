<template>
  <div>
    <h2 class="text-sm font-medium text-gray-700 mb-4">Segmentação por cidade</h2>
    <div class="flex flex-col md:flex-row">
      <div class="w-full md:w-1/2 flex justify-center items-center">
        <div class="w-64 h-64">
          <apexchart
            v-if="chartReady"
            type="pie"
            height="100%"
            width="100%"
            :options="chartOptions"
            :series="getSeries"
          ></apexchart>
        </div>
      </div>
      <div class="w-full md:w-1/2 mt-4 md:mt-0">
        <div class="flex flex-col space-y-2">
          <div v-for="(item, index) in data" :key="index" class="flex items-center">
            <span class="w-3 h-3 rounded-full mr-2" :style="{ backgroundColor: colors[index % colors.length] }"></span>
            <span class="text-sm text-gray-600">{{ item.district }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref, computed, onMounted } from 'vue';
  import { useInsightStore } from '@/stores/insights';

  const insightStore = useInsightStore();
  const chartReady = ref(false);

  const data = computed(() => insightStore.insights_district);
  const colors = ['#3730a3', '#4f46e5', '#6366f1', '#818cf8', '#c7d2fe'];

  const getSeries = computed(() => data.value.map(item => item.total));

  const chartOptions = ref({
    chart: { type: 'pie', toolbar: { show: false } },
    colors,
    labels: computed(() => data.value.map(item => item.district)),
    legend: { show: false },
    dataLabels: {
      enabled: true,
      formatter: val => val.toFixed(0) + '%',
      style: { fontSize: '12px', fontWeight: 'bold' },
    },
    stroke: { width: 0 },
    plotOptions: { pie: { expandOnClick: true } },
  });

  onMounted(async () => {
    await insightStore.getClientsByDistrict();
    chartReady.value = true;
  });
</script>
