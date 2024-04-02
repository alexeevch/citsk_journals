<script setup>
import { Aim, House, Notebook, School } from '@element-plus/icons-vue';

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
      <el-menu class="menu">
        <router-link to="/home">
          <el-menu-item>
            <el-icon>
              <el-icon>
                <House />
              </el-icon>
            </el-icon>
            Главная
          </el-menu-item>
        </router-link>

        <router-link to="/journal">
          <el-menu-item>
            <el-icon>
              <Notebook />
            </el-icon>
            Журнал вторжений
          </el-menu-item>
        </router-link>

        <router-link to="/attackers">
          <el-menu-item>
            <el-icon>
              <Aim />
            </el-icon>
            Злоумышленники
          </el-menu-item>
        </router-link>

        <router-link to="/infrastructures">
          <el-menu-item>
            <el-icon>
              <School />
            </el-icon>
            Атакованные ресурсы
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
