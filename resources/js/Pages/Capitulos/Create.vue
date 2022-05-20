<template>
  <div>
    <Head title="Crea Capitulo"/>
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/capitulos">Capitulos</Link>
      <span class="text-indigo-400 font-medium">/</span>Crea
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.orden" :error="form.errors.orden" class="pb-8 pr-6 w-full lg:w-1/2" label="Orden"/>
          <text-input
            v-model="form.descripcion" :error="form.errors.descripcion" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Descripción"
          />
          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="publicado" v-model="form.publicado" class="mr-1" type="checkbox"/>
            <span class="text-sm">¿Publicado?</span>
          </label>
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Contact</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  name: 'CapitulosCreate',
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  props: {
    documento: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        orden: null,
        descripcion: null,
        publicado: false,
        documento_id: this.documento.id
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/capitulos')
    },
  },
}
</script>
