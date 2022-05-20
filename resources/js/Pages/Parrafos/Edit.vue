<template>
  <div>
    <Head :title="form.name"/>
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/documentos">Documentos</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="parrafo.deleted_at" class="mb-6" @restore="restore">
      This documento has been deleted.
    </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.orden" :error="form.errors.orden" class="pb-8 pr-6 w-full lg:w-1/2" label="Orden"/>
          <text-input v-model="form.descripcion" :error="form.errors.descripcion" class="pb-8 pr-6 w-full lg:w-1/2"
                      label="Descripción"/>
          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="Publicado" v-model="form.publicado" class="mr-1" type="checkbox"/>
            <span class="text-sm">¿Publicado?</span>
          </label>

        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!parrafo.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button"
                  @click="destroy">Delete Documento
          </button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Documento
          </loading-button>
        </div>
      </form>
      <QuillEditor v-model:content="content" :toolbar="toolbarOptions" content-type="html"/>
    </div>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
//import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
//import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  name: 'ParrafosEdit',
  components: {
    Head,
    // Icon,
    Link,
    LoadingButton,
    // SelectInput,
    TextInput,
    TrashedMessage,
    QuillEditor,
  },
  layout: Layout,
  props: {
    parrafo: Object,
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
        name: 'Parrafos',
        orden: this.parrafo.orden,
        descripcion: this.parrafo.descripcion,
        publicado: this.parrafo.publicado,
      }),
      toolbarOptions: [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{'header': 1}, {'header': 2}],               // custom button values
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
        [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
        [{'direction': 'rtl'}],                         // text direction

        [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
        [{'header': [1, 2, 3, 4, 5, 6, false]}],

        [{'color': []}, {'background': []}],          // dropdown with defaults from theme
        [{'font': []}],
        [{'align': []}],

        ['clean']                                         // remove formatting button
      ],
      content: null,
      options: {
        debug: 'info',
        modules: {
          toolbar: ['bold', 'italic', 'underline']
        },
        placeholder: 'Compose an epic...',
        readOnly: true,
        theme: 'snow'
      }
    }
  },
  methods: {
    update() {
      this.form.put(`/parrafos/${this.parrafo.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this contact?')) {
        this.$inertia.delete(`/parrafos/${this.parrafo.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this contact?')) {
        this.$inertia.put(`/parrafos/${this.parrafo.id}/restore`)
      }
    },
  },
}
</script>
