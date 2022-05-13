<template>
  <div>
    <Head title="Crea Documento" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/documentos">Documentos</Link>
      <span class="text-indigo-400 font-medium">/</span> Crea
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.orden" :error="form.errors.orden" class="pb-8 pr-6 w-full lg:w-1/2" label="Orden" />
          <text-input v-model="form.descripcion" :error="form.errors.descripcion" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
<!--          <text-input v-model="form.publicado" :error="form.errors.publicado" class="pb-8 pr-6 w-full lg:w-1/2" label="Publicado" />-->

          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="publicado" v-model="form.publicado" class="mr-1" type="checkbox" />
            <span class="text-sm">¿Publicado?</span>
          </label>

          <!--      <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
          <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
          <text-input v-model="form.region" :error="form.errors.region" class="pb-8 pr-6 w-full lg:w-1/2" label="Province/State" />
          <select-input v-model="form.country" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Country">
            <option :value="null" />
            <option value="CA">Canada</option>
            <option value="US">United States</option>
          </select-input>
          <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Postal code" />-->
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Crea Documento</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
// import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    // SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        orden: null,
        descripcion: null,
        publicado: false,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/documentos')
    },
  },
}
</script>
