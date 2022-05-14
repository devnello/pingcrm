<template>
  <div>
    <Head :title="form.name"/>
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/documentos">Documentos</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="documento.deleted_at" class="mb-6" @restore="restore"> This documento has been
      deleted.
    </trashed-message>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <!--          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
                    <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
                    <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
                    <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
                    <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
                    <text-input v-model="form.region" :error="form.errors.region" class="pb-8 pr-6 w-full lg:w-1/2" label="Province/State" />
                    <select-input v-model="form.country" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Country">
                      <option :value="null" />
                      <option value="CA">Canada</option>
                      <option value="US">United States</option>
                    </select-input>
                    <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Postal code" />-->
          <text-input v-model="form.orden" :error="form.errors.orden" class="pb-8 pr-6 w-full lg:w-1/2" label="Orden"/>
          <text-input v-model="form.descripcion" :error="form.errors.descripcion" class="pb-8 pr-6 w-full lg:w-1/2"
                      label="Descripción"/>
          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="Publicado" v-model="form.publicado" class="mr-1" type="checkbox"/>
            <span class="text-sm">¿Publicado?</span>
          </label>
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!documento.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button"
                  @click="destroy">Delete Documento
          </button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Documento
          </loading-button>
        </div>
      </form>
    </div>

    <div class="flex flex-row justify-between items-center mt-20">
      <h2 class="text-2xl font-bold">Capitulos</h2>
      <div class="flex items-center bg-gray-50 border-t border-gray-100">
        <button class="text-red-600 hover:underline" tabindex="-1"
                type="button"
                @click="createCapitulo">Nuevo Capitulo
        </button>
      </div>
    </div>

    <div class="mt-1 bg-white rounded shadow overflow-x-auto">

      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 pl-6 pr-2º">Orden</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Texto</th>
        </tr>

        <tr v-for="capitulo in documento.capitulos" :key="capitulo.id"
            class="hover:bg-gray-100 focus-within:bg-gray-100">
          <!--          <td class="border-t">
                      <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/capitulos/${capitulo.id}/edit`">
                        {{ capitulo.name }}
                        <icon v-if="capitulo.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400"/>
                      </Link>
                    </td>-->
          <td class="border-t">
            <Link class="flex items-center pl-6 pr-2" :href="`/capitulos/${capitulo.id}/edit`" tabindex="-1">
              {{ capitulo.orden }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/capitulos/${capitulo.id}/edit`" tabindex="-1">
              {{ capitulo.descripcion }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/capitulos/${capitulo.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400"/>
            </Link>
          </td>
        </tr>

        <tr v-if="documento.capitulos.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No se han encontrado capitulos.</td>
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
// import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    // SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    // documento: Object,
    documento: Object,
  },
  remember: 'form',
  data() {
    return {
      /*form: this.$inertia.form({
        name: this.documento.name,
        email: this.documento.email,
        phone: this.documento.phone,
        address: this.documento.address,
        city: this.documento.city,
        region: this.documento.region,
        country: this.documento.country,
        postal_code: this.documento.postal_code,
      }),*/
      form: this.$inertia.form({
        orden: this.documento.orden,
        descripcion: this.documento.descripcion,
        publicado: this.documento.publicado,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/documentos/${this.documento.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this documento?')) {
        this.$inertia.delete(`/documentos/${this.documento.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this documento?')) {
        this.$inertia.put(`/documentos/${this.documento.id}/restore`)
      }
    },
    createCapitulo(){
      this.$inertia.get(`/capitulos/${this.documento.id}/create`)
    }
  },
}
</script>
