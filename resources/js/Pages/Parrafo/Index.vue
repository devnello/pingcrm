<template>
  <user-menu/>
  <main class="contenedor h-screen">
    <h1 class="mb-10 pt-10 text-center text-3xl font-bold">Historias Universitario</h1>
    <div>
      <!--Imagen Bot-->
      <img class="w-40 mx-auto" src="/images/chatbot.png" alt="Imagen chatbot"/>

      <!--Navegación-->
      <div class="flex flex-row justify-between mt-4">
        <div>
          <button
            :disabled="index === 0"
            class="border-2 border-solid border-black mr-1"
            @click="inicio"
          >
            <img src="/images/antes.svg" alt="boton antes"/>
          </button>
          <button
            :disabled="index === 0"
            class="border-2 border-solid border-black"
            @click="decrement"
          >
            <img src="/images/antes.svg" alt="boton antes"/>
          </button>
        </div>

        <!--Contador paginas-->
        <p class="font-bold">{{ index + 1 }}/{{ parrafos.length }}</p>

        <div>
          <button
            :disabled="index === parrafos.length - 1"
            class="bg-gray-200
                       border-2
                       border-solid
                       border-black
                       hover:bg-orange-100
                       mr-1"
            @click="increment"
          >
            <img src="/images/siguiente.svg" alt="boton siguiente"/>
          </button>
          <button
            :disabled="index === parrafos.length - 1"
            class="bg-gray-200
                       border-2
                       border-solid
                       border-black
                       hover:bg-orange-100"
            @click="fin"
          >
            <img src="/images/siguiente.svg" alt="boton siguiente"/>
          </button>
        </div>
      </div>

      <!--Titulo-->
      <div class="border-2 border-solid border-black rounded-2xl text-center my-2 py-3">
        <h1 id="parrafo" class="text-4xl">{{ descripcion_cap }}</h1>
      </div>

      <!--Parrafo-->
      <div
        v-if="parrafos != null && parrafos.length > 0 && parrafos[index].descripcion"
        class="border-2 border-solid border-black rounded-2xl text-center my-2 py-3 text-3xl"
        v-html="parseFromString(parrafos[index].descripcion)"
      />
      <div v-else>
        <p>No se han encontrado Parrafos para este capitulo</p>
      </div>
    </div>
  </main>
</template>

<script>

//import Icon from '@/Shared/Icon'
//import {Link} from '@inertiajs/inertia-vue3'
import UserMenu from '@/Shared/UserMenu'

export default {
  name: 'ParrafoIndex',
  components: {
    //Icon,
    //Link,
    UserMenu
  },
  props: {
    data: Object,
  },
  data() {
    return {
      capitulo_id: this.data.capitulo.id,
      index: 0,
      descripcion_cap: this.data.capitulo.descripcion,
      parrafos: this.data.parrafos,
      nombre: ['N 1', 'N 2', 'N 3', 'N 4', 'N 5', 'N 6', 'N 7', 'N 8', 'N 9', 'N 10'],
      images: ['adam-smith.png', 'alberto-benegas-lynch.png', 'alisa-zinóvievna-rosenbaum.png',
        'anxo-bastos.png', 'carl-menger.png', 'chatbot.png', 'claude-fréderic-bastiat.png',
        'eugen-ritter-von-böhm-bawerk.png', 'friederich-von-wieser.png', 'friedrich-august-hayek.png',
        'hans-hermann-hoppe.png', 'herny-hazlitt.png', 'israel-kirzner.png', 'javier-milei.png',
        'jesús-huerta-de-soto.png', 'jhon-locke.png', 'juan-ramón-rallo.png', 'lew-rockwell.png',
        'ludwig-heinrich-edler-von-mises.png', 'milton-friedman.png', 'murray-newton-rothbard.png',
        'robert-nozick.png', 'walter-block.png'],
    }
  },
  beforeCreate() {
    // document.querySelector('body').setAttribute('style', 'background:#fff')
  },
  beforeUnmount() {
    // document.querySelector('body').setAttribute('style', '')
  },
  methods: {
    increment() {
      this.index++
      if (this.index > this.parrafos.length - 1) {
        this.index = this.parrafos.length - 1
      }
    },
    decrement() {
      this.index--
      if (this.index < 0) {
        this.index = 0
      }
    },
    inicio() {
      this.index = 0
    },
    fin() {
      this.index = this.parrafos.length - 1
    },
    parseFromString(str) {
      let parser = new DOMParser()
      let doc = parser.parseFromString(str, 'text/html')
      return doc.body.innerHTML
    },
  },
}
</script>

<style scoped>
/*
.grid-container {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  column-gap: 2rem;
}

body {
  background-image: url(/images/background.jpeg);
  background-repeat: no-repeat;
  background-size: cover;
}

.image {
  height: 150px;
  background-image: url(/images/background.jpeg);
  background-repeat: no-repeat;
}
*/
</style>
