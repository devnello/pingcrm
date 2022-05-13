<template>
  <user-menu />
  <main class="container">
    <h1 class="mb-10 pt-10 text-center text-3xl font-bold">Historias Universitario</h1>
    <div id="id_grid" class="grid grid-cols-4">
      <template v-for="capitulo in capitulos">
        <div class="flex flex-col justify-between imagen_div texto texto_margen mx-5 my-10 border-2 border-black">
          <Link :href="`/capitulo/${capitulo.id}`">
            <img class="max-h-48 mx-auto p-3" :src="'/images/' + capitulo.imagen" alt="" />
          </Link>
          <h2 id="texto_Imagen" class="h-8 my-5 text-center font-bold">
            <span class="text-red-900 font-black">{{ capitulo.descripcion }}</span>
          </h2>
        </div>
      </template>
    </div>
  </main>
</template>

<script>

import Icon from '@/Shared/Icon'
import {Link} from '@inertiajs/inertia-vue3'
import UserMenu from '@/Shared/UserMenu'

export default {
  name: 'CapitulosIndex',
  components: {
    Icon,
    Link,
    UserMenu
  },
  props: {
    capitulos: Object,
  },
  data() {
    return {
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
