<template>
  <div>
    <Head title="Reports" />
    <h1 class="mb-8 text-3xl font-bold">Reports</h1>
    <h1 class="mb-0 text-3xl font-bold">{{ report.nombre }}</h1>
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'

export default {
  components: {
    Head,
  },
  layout: Layout,
  props: {
    report: Object,
  },
}
</script>
