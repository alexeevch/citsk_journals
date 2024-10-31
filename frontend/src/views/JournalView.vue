<script setup>
import PageHeading from '@/components/PageHeading.vue';

import axios from 'axios';
import { onMounted, ref } from 'vue';

let isLoading = ref(false);
let incidents = ref([]);

async function getIncidents() {
  try {
    isLoading.value = true;
    const { data } = await axios.get('/incident');
    return data.data;
  } catch (e) {
    console.error(e);
  } finally {
    isLoading.value = false;
  }
}

onMounted(async () => {
  incidents.value = await getIncidents();
});

</script>

<template>
  <PageHeading />

  <div class="page-wrapper">
    <el-table v-loading="isLoading"
              :data="incidents"
              :default-sort="{ prop: 'id', order: 'ascending' }"
              style="width: 100%"
    >
      <el-table-column type="expand">
        <template #default="props">
          <div class="table-item__body">
            <div class="body__row">
              <p class="row-title bold">Время</p>
              <p>Время обнаружения: {{ props.row.detection_time }}</p>
              <p>Время оповещения оперативной группы: {{ props.row.group_alert_time }}</p>
              <p>Время оповещения заведующего сектором: {{ props.row.supervisor_alert_time }}</p>
            </div>

            <div class="body__row">
              <p class="row-title bold">Злоумышленник</p>
              <p>ipv4: {{ props.row.attacker.ipv4 }}</p>
              <p>Страна: {{ props.row.attacker.country }}</p>
              <p>Тип атаки: {{ props.row.type.name }}</p>
            </div>

            <div class="body__row">
              <p class="row-title bold">Жертва</p>
              <p>ipv4: {{ props.row.infrastructure.ipv4 }}</p>
              <p>Субъект: {{ props.row.infrastructure.name }}</p>
              <p>Владелец {{ props.row.infrastructure.owner }}</p>
            </div>

            <div class="body__row">
              <p class="row-title bold">Запись</p>
              <p>Статус: {{ props.row.status.name }}</p>
              <p>Описание: {{ props.row.description }}</p>
            </div>
          </div>
        </template>
      </el-table-column>
      <el-table-column type="selection" width="55" />
      <el-table-column prop="id" label="id" width="65" sortable />
      <el-table-column prop="detection_time" label="Время обнаружения" width="190" />
      <el-table-column prop="group_alert_time" label="Время оповещения оперативной группы" width="180" />
      <el-table-column prop="supervisor_alert_time" label="Время оповещения заведующего сектором" width="180" />
      <el-table-column prop="attacker.ipv4" label="ipv4 злоумышленника" width="180" />
      <el-table-column prop="infrastructure.ipv4" label="ipv4 жертвы" width="180" />
      <el-table-column prop="status.name" label="Статус" width="100" />
    </el-table>
  </div>
</template>

<style scoped>
.page-wrapper {
  overflow-y: hidden;
}

.table-item__body {
  padding: 1rem;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
}

.row-title {
  padding-bottom: 1rem;
}
</style>
