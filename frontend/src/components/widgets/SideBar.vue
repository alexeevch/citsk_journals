<script setup>
const props = defineProps({
  routes: {
    required: true,
    type: Array
  }
});
</script>

<template>
  <el-aside width="200px">
    <el-scrollbar>
      <el-menu
        v-for="(route, key) in props.routes"
        :key="key"
        class="menu">
        <router-link :to="route.path">
          <el-menu-item>
            {{ route.props.label }}
          </el-menu-item>
        </router-link>
      </el-menu>
    </el-scrollbar>
  </el-aside>
</template>

<style scoped>
.menu {
  height: 100% !important;
}
</style>
