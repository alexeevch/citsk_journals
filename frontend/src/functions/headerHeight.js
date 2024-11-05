import { onMounted, onUnmounted, ref } from 'vue';

export function useElementHeight(elementRef) {
  const height = ref(0);

  function update() {
    height.value = elementRef.value.offsetHeight;
  }

  onMounted(() => window.addEventListener('resize', update));
  onUnmounted(() => window.removeEventListener('resize', update));

  return { height };
}
