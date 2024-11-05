<script setup>
import SideBar from '@/components/widgets/SideBar.vue';
import { routes } from '@/router/index.js';
import { useElementHeight } from '@/functions/headerHeight.js';
import { ref } from 'vue';

const header = ref(null);
const section = ref(null);
const { height } = useElementHeight(header);

const sectionHeight = ref(window.screen.height - height.value);


</script>

<template>
  <div class="application">
    <div ref="header" id="application-header" class="header">
      header
    </div>
    <div class="page-wrapper">
      <side-bar :routes="routes" />
      <section ref="section" :height="sectionHeight" class="section">
        <slot></slot>
      </section>
    </div>
  </div>
</template>

<style scoped>
.application {
  height: 100vh;
  width: 100%;
  display: grid;
  grid-template-rows: auto 1fr;
}

.page-wrapper {
  display: grid;
  grid-template-columns: auto 1fr;
  overflow: hidden;
}

.section {
  overflow-y: scroll;
  padding: 1rem;
}

.header {
  background-color: var(--color-primary);
}

</style>
