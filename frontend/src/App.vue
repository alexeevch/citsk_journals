<script setup>
import NavigationPanel from '@/components/NavigationPanel.vue';
</script>

<template>
  <div class="common-layout">
    <el-header class="header">Header</el-header>
    <el-container>
      <NavigationPanel routes="" />
      <el-main>
        <slot>
          <RouterView />
        </slot>
      </el-main>
    </el-container>
  </div>
</template>

<style>
.common-layout {
  height: 100vh;
  min-width: 100vw !important;
}

.header {
  background-color: var(--color-primary);
}
</style>
