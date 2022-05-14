<template>
  <div>
    <Head :title="form.name"/>
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/documentos">Documentos</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="capitulo.deleted_at" class="mb-6" @restore="restore">
      This documento has been
      deleted.
    </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
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
          <div style="height: 500px; width: 500px; border: 1px solid red; position: relative;">
            <DropZone
              :max-files="Number(10000000000)"
              url="#"
              :upload-on-drop="true"
              :multiple-upload="true"
              :parallel-upload="3"
              @sending="sending"
              @added-file="onFileAdd"
            />
          </div>
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button
            v-if="!capitulo.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button"
            @click="destroy"
          >
            Delete Documento
          </button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">
            Update Documento
          </loading-button>
        </div>
      </form>
    </div>
    <h2 class="mt-12 text-2xl font-bold">Parrafos</h2>
    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 pl-6 pr-2º">Orden</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Texto</th>
        </tr>

        <tr
          v-for="parrafo in capitulo.parrafos" :key="parrafo.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
        >
          <!--          <td class="border-t">
                      <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/parrafos/${parrafo.id}/edit`">
                        {{ parrafo.name }}
                        <icon v-if="parrafo.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400"/>
                      </Link>
                    </td>-->
          <td class="border-t">
            <Link class="flex items-center pl-6 pr-2" :href="`/parrafos/${parrafo.id}/edit`" tabindex="-1">
              {{ parrafo.orden }}
            </Link>
          </td>
          <td class="border-t">
            <!--            <Link class="flex items-center px-6 py-4" :href="`/parrafos/${parrafo.id}/edit`" tabindex="-1">
                          {{ parrafo.descripcion }}
                        </Link>-->
            <div
              class="flex items-center px-6 py-4"
              v-html="parseFromString(parrafo.descripcion)"
            />
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/parrafos/${parrafo.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400"/>
            </Link>
          </td>
        </tr>

        <tr v-if="capitulo.parrafos.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No se han encontrado parrafos.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
//import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

import DropZone from 'dropzone-vue';

// optionally import default styles
import 'dropzone-vue/dist/dropzone-vue.common.css';

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    // SelectInput,
    TextInput,
    TrashedMessage,
    DropZone,
  },
  layout: Layout,
  props: {
    capitulo: Object,
    // organizations: Array,
  },
  remember: 'form',
  data() {
    return {
      /*
      form: this.$inertia.form({
        first_name: this.contact.first_name,
        last_name: this.contact.last_name,
        organization_id: this.contact.organization_id,
        email: this.contact.email,
        phone: this.contact.phone,
        address: this.contact.address,
        city: this.contact.city,
        region: this.contact.region,
        country: this.contact.country,
        postal_code: this.contact.postal_code,
      }),
      */
      form: this.$inertia.form({
        name: 'Capitulos',
        orden: this.capitulo.orden,
        descripcion: this.capitulo.descripcion,
        publicado: this.capitulo.publicado,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/capitulos/${this.capitulo.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this contact?')) {
        this.$inertia.delete(`/capitulos/${this.capitulo.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this contact?')) {
        this.$inertia.put(`/capitulos/${this.capitulo.id}/restore`)
      }
    },
    parseFromString(str) {
      let parser = new DOMParser()
      let doc = parser.parseFromString(str, 'text/html')
      return doc.body.innerHTML
    },
    sending(files, xhr, formData) {
      console.log('sending')
      console.log(files)
      console.log(xhr)
      console.log(formData)
    },
    onFileAdd(item) {
      console.log('onFileAdd')
      console.log(item)
    },
    setup() {
      return {}
    },
  }
}
</script>
