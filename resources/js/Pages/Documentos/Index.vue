<template>
  <div>
    <Head title="Documentos" />
    <h1 class="mb-8 text-3xl font-bold">Documentos</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/documentos/create">
        <span>Nuevo</span>
        <span class="hidden md:inline">&nbsp;Documento</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Orden</th>
            <th class="pb-4 pt-6 px-6">Descripción</th>
            <th class="pb-4 pt-6 px-6">Imagen</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Publicado</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="documento in documentos.data" :key="documento.id"
            class="hover:bg-gray-100 focus-within:bg-gray-100"
          >
            <td class="border-t">
              <Link
                class="flex items-center px-6 py-4 focus:text-indigo-500"
                :href="`/documentos/${documento.id}/edit`"
              >
                {{ documento.orden }}
                <icon v-if="documento.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/documentos/${documento.id}/edit`" tabindex="-1">
                {{ documento.descripcion }}
              </Link>
            </td>
            <td class="border-t">
              <img class="max-h-20 mx-auto p-3" :src="'/images/adam-smith.png'" alt="" />
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/documentos/${documento.id}/edit`" tabindex="-1">
                {{ convertPublicado(documento.publicado) }}
              </Link>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/documentos/${documento.id}/edit`" tabindex="-1">
                <Icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="documentos.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No hay documentos.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="documentos.links" />
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  name: 'DocumentosIndex',
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    documentos: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/documentos', pickBy(this.form), {preserveState: true})
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    convertPublicado(val) {
      return (val === 1) ? 'S' : 'N'
    },
  },
}
</script>
