<template>
  <main class="contenedor h-screen">
    <h1 class="mb-10 pt-10 text-center text-3xl font-bold">Historias Universitario</h1>
    <div>
      <img class="mx-auto" src="/images/chatbot.png" alt="">

      <div class="border-2 border-solid border-black text-center my-2 py-3">
        <h2 id="parrafo">{{ descripcion_cap }}</h2>
      </div>

      <div v-if="parrafos[index].descripcion" class="border-2 border-solid border-black text-center my-2 py-3"
           v-html="parseFromString(parrafos[index].descripcion)">
      </div>

      <div class="flex flex-row justify-between">
        <button :disabled="index === 0" class="border-2 border-solid border-black" v-on:click="decrement">
          <img src="/images/antes.svg" alt="boton antes">
        </button>
        <button :disabled="index === parrafos.length - 1" class="border-2 border-solid border-black"
                v-on:click="increment">
          <img src="/images/siguiente.svg" alt="boton siguiente">
        </button>
      </div>
    </div>
  </main>
</template>

<script>

import Icon from "@/Shared/Icon";
import {Link} from "@inertiajs/inertia-vue3";

export default {
  name: 'ParrafoIndex',
  components: {
    Icon,
    Link,
  },
  props: {
    data: Object,
  },
  beforeCreate() {
    // document.querySelector('body').setAttribute('style', 'background:#fff')
  },
  beforeUnmount() {
    // document.querySelector('body').setAttribute('style', '')
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
    parseFromString(str) {
      let parser = new DOMParser()
      let doc = parser.parseFromString(str, 'text/html')
      return doc.body.innerHTML
    }
  }
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
