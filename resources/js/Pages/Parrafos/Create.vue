<template>
  <div>
    <Head title="Crea Parrafo"/>
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/parrafos">Parrafos</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <select-input
            v-model="docSelectValue"
            :error="form.errors.documentos"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Documento"
            @update:modelValue="selDocumentChange"
          >
            <option v-for="documento in documentos" :key="documento.id" :value="documento.id">
              {{ documento.descripcion }}
            </option>
          </select-input>
          <select-input
            v-model="capSelectValue"
            :error="form.errors.capitulo"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Capitulo"
          >
            <!--<option value="null"></option>-->
            <option v-for="capitulo in capitulos" :key="capitulo.id" :value="capitulo.id">
              {{ capitulo.descripcion }}
            </option>
          </select-input>
          <text-input v-model="form.orden" :error="form.errors.orden" class="pb-8 pr-6 w-full lg:w-1/2" label="Orden"/>
          <text-input
            v-model="form.descripcion" :error="form.errors.descripcion" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Descripción"
          />
          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="Publicado" v-model="form.publicado" class="mr-1" type="checkbox"/>
            <span class="text-sm">¿Publicado?</span>
          </label>
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">
            Update Documento
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
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
// import TrashedMessage from '@/Shared/TrashedMessage'

import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
//import pickBy from 'lodash/pickBy'

import axios from 'axios'

export default {
  components: {
    Head,
    // Icon,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    // TrashedMessage,
    QuillEditor,
  },
  layout: Layout,
  props: {
    //parrafo: Object,
    documentos: Array,
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
      capitulos: [],
      docSelectValue: null,
      capSelectValue: null,
      form: this.$inertia.form({
        orden: null,
        descripcion: null,
        publicado: null,
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

        ['clean'],                                         // remove formatting button
      ],
      content: null,
      options: {
        debug: 'info',
        modules: {
          toolbar: ['bold', 'italic', 'underline'],
        },
        placeholder: 'Compose an epic...',
        readOnly: true,
        theme: 'snow',
      },
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
    async axios() {
      try {
        let url = `http://ping-crm.locl/capitulos/${this.docSelectValue}/sel`
        console.log(url)
        const res = await axios.get(url)
        this.items = res.data
      } catch (error) {
        console.log(error)
      }
    },
    selDocumentChange() {
      this.capitulos = []
      this.capSelectValue = null

      //
      // this.$inertia.get(`/capitulos/${this.docSelectValue}/sel`, pickBy(this.capitulos), {preserveState: true})
      /*
      this.$inertia.get(`/capitulos/${this.docSelectValue}/sel`,
        pickBy({capitulos: this.capitulos}),
        {preserveState: true})
      */
      // this.axios()
      let url = `http://ping-crm.locl/capitulos/${this.docSelectValue}/sel`
      console.log(url)
      axios.get(url).then((res) => {
        console.log(res.data)

        this.capitulos = res.data
      })
    },
  },
}
</script>
