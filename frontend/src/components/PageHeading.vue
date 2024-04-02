<script setup>
import router from '@/router/index.js'
</script>

<template>
  <el-page-header @back="router.back">
    <template #content>
      <span class="text-large font-600 mr-3"> {{ router.currentRoute.value.name }}</span>
    </template>
  </el-page-header>
</template>
