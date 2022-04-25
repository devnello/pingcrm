<template>
  <main class="contenedor h-screen">
    <h1 class="mb-10 pt-10 text-center text-3xl font-bold">Historias Universitario</h1>
    <div>
      <img class="mx-auto" src="/images/chatbot.png" alt="">
      <div class="border-2 border-solid rounded border-black m-10">
        <div id="texto_imagen" class="text-center">
          <p class="m-10 font-bold">Vas a ver en esta sección:
            <span class="text-red-900 font-black">{{ descripcion }}</span>
          </p>
          <div class="flex flex-row justify-around m-10">
            <Link href="/">
              <button class="
              w-32
              bg-white
              text-black
              px-2
              py-1
              border-black
              hover:bg-black
              hover:text-white
              rounded">
                Atrás..
              </button>
            </Link>
            <p id="span_imagen">Texto a cambiar</p>
            <Link :href="`/capitulo/${capitulos.id}/parrafo`">
              <button class="
              w-32
              bg-white
              text-black
              px-2
              py-1
              border-black
              hover:bg-black
              hover:text-white
              rounded">.. Continuar
              </button>
            </Link>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>

import Icon from "@/Shared/Icon";
import {Link} from "@inertiajs/inertia-vue3";

export default {
  name: 'CapituloShow',
  components: {
    Icon,
    Link,
  },
  props: {
    capitulos: Object,
  },
  beforeCreate() {
    // document.querySelector('body').setAttribute('style', 'background:#fff')
  },
  beforeUnmount() {
    // document.querySelector('body').setAttribute('style', '')
  },
  data() {
    return {
      descripcion: this.capitulos.descripcion,
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
