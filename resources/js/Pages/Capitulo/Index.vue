<template>
  <user-menu/>
  <main class="container mx-auto">
    <div class="u-center-text u-margin-bottom-big">
      <h2 class="heading-secondary">
        Historias Universitario
      </h2>
    </div>
    <h1 class="mb-10 pt-10 text-center text-3xl font-bold">Historias Universitario</h1>
    <div id="id_grid" class="grid grid-cols-4">
      <template v-for="capitulo in capitulos" :key="capitulo.id">
        <div class="flex flex-col justify-between imagen_div texto texto_margen mx-5 my-10 border-2 border-black">
          <!--
          <Link :href="`/capitulo/${capitulo.id}`">
            <img class="max-h-48 mx-auto p-3" :src="'/images/' + capitulo.imagen" alt="" />
          </Link>
          -->
          <!--Card-->
          <div class="card">
            <div class="card__side card__side--front">
              <div
                class="card__picture"
                :style="getBackground(capitulo.imagen)">
              </div>
              <!--Heading-->
              <!--<h4 class="card__heading">
                    <span class="card__heading-span card__heading-span&#45;&#45;2">{{ capitulo.descripcion }}</span>
                  </h4>-->
              <div class="card__details">
                <ul>
                  <li>{{ capitulo.descripcion }}</li>
                  <li>Texto 1</li>
                  <li>Texto 2</li>
                </ul>
              </div>
            </div>
            <div class="card__side card__side--back card__side--back-2">
              <div class="card__cta">
                <div class="card__price-box">
                  <p class="card__price-only">Texto 1</p>
                  <p class="card__price-only">Texto 2</p>
                  <p class="card__price-value">Texto 3</p>
                  <p class="card__price-value">Texto 4</p>
                </div>
                <!--<a href="#popup" class="btn btn&#45;&#45;white">Haz algo!</a>-->
                <Link class="btn btn--white" :href="`/capitulo/${capitulo.id}`">
                  Inicio!
                </Link>
              </div>
            </div>
          </div>
          <!--Fin-Card-->
          <!--
          <h2 id="texto_Imagen" class="h-8 my-5 text-center font-bold">
            <span class="text-red-900 font-black">{{ capitulo.descripcion }}</span>
          </h2>
          -->
        </div>
      </template>
    </div>
    <section class="section-tours" id="section-tours">
      <div class="u-center-text u-margin-bottom-big">
        <h2 class="heading-secondary">
          Most popular tours
        </h2>
      </div>

      <div class="row">
        <div class="col-1-of-3">
          <div class="card">
            <div class="card__side card__side--front">
              <div class="card__picture card__picture--1">
                &nbsp;
              </div>
              <h4 class="card__heading">
                <span class="card__heading-span card__heading-span--1">The Sea Explorer</span>
              </h4>
              <div class="card__details">
                <ul>
                  <li>3 day tours</li>
                  <li>Up to 30 people</li>
                  <li>2 tour guides</li>
                  <li>Sleep in cozy hotels</li>
                  <li>Difficulty: easy</li>
                </ul>
              </div>
            </div>
            <div class="card__side card__side--back card__side--back-1">
              <div class="card__cta">
                <div class="card__price-box">
                  <p class="card__price-only">Only</p>
                  <p class="card__price-value">$297</p>
                </div>
                <a href="#popup" class="btn btn--white">Book now!</a>
              </div>
            </div>
          </div>
        </div>


        <div class="col-1-of-3">
          <div class="card">
            <div class="card__side card__side--front">
              <div class="card__picture card__picture--2">
                &nbsp;
              </div>
              <h4 class="card__heading">
                <span class="card__heading-span card__heading-span--2">The Forest Hiker</span>
              </h4>
              <div class="card__details">
                <ul>
                  <li>7 day tours</li>
                  <li>Up to 40 people</li>
                  <li>6 tour guides</li>
                  <li>Sleep in provided tents</li>
                  <li>Difficulty: medium</li>
                </ul>
              </div>

            </div>
            <div class="card__side card__side--back card__side--back-2">
              <div class="card__cta">
                <div class="card__price-box">
                  <p class="card__price-only">Only</p>
                  <p class="card__price-value">$497</p>
                </div>
                <a href="#popup" class="btn btn--white">Book now!</a>
              </div>
            </div>
          </div>
        </div>


        <div class="col-1-of-3">
          <div class="card">
            <div class="card__side card__side--front">
              <div class="card__picture card__picture--3">
                &nbsp;
              </div>
              <h4 class="card__heading">
                <span class="card__heading-span card__heading-span--3">The Snow Adventurer</span>
              </h4>
              <div class="card__details">
                <ul>
                  <li>5 day tours</li>
                  <li>Up to 15 people</li>
                  <li>3 tour guides</li>
                  <li>Sleep in provided tents</li>
                  <li>Difficulty: hard</li>
                </ul>
              </div>

            </div>
            <div class="card__side card__side--back card__side--back-3">
              <div class="card__cta">
                <div class="card__price-box">
                  <p class="card__price-only">Only</p>
                  <p class="card__price-value">$897</p>
                </div>
                <a href="#popup" class="btn btn--white">Book now!</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="u-center-text u-margin-top-huge">
        <a href="#" class="btn btn--green">Discover all tours</a>
      </div>
    </section>
  </main>
</template>

<script>

//import Icon from '@/Shared/Icon'
import {Link} from '@inertiajs/inertia-vue3'
import UserMenu from '@/Shared/UserMenu'

export default {
  name: 'CapituloIndex',
  components: {
    //Icon,
    Link,
    UserMenu,
  },
  props: {
    capitulos: Object,
  },
  methods: {
    imagen(capImage) {
      return '/images/' + capImage
    },
    getBackground(url) {
      let overlay1 = 'linear-gradient(to right bottom, #ffb900, #ff7730)'
      let overlay2 = 'linear-gradient(to right bottom,#7ed56f, #28b485)'
      let overlay3 = 'linear-gradient(to right bottom, #2998ff, #5643fa)'

      let overlay1_webkit = '-webkit-gradient(linear, left top, right bottom, from(#ffb900), to(#ff7730))'
      let overlay2_webkit = '-webkit-gradient(linear, left top, right bottom, from(#7ed56f), to(#28b485))'
      let overlay3_webkit = '-webkit-gradient(linear, left top, right bottom, from(#2998ff), to(#5643fa))'

      if (url !== null) {
        return 'background-image:' + overlay2_webkit + ' , url(' + '/uploads/' + url + ');' +
          'background-image:' + overlay2 + ' , url(' + '/uploads/' + url + ')'
      } else {
        return 'background-image:' + overlay2_webkit + ' ' + 'background-image:' + overlay2
      }

      // return 'background-image:' + overlay2 + ' , url(' + url + ');'

    }
  },
  data() {
    return {
      htmlStyle: null,
      bodyStyle: null,
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
    // document.querySelector('body').setAttribute('style', 'background:#fff'
    this.htmlStyle = document.querySelector('html').getAttribute('style')
    // console.log(htmlStyle)
    this.bodyStyle = document.querySelector('body').getAttribute('style')
    // console.log(bodyStyle)
    document.querySelector('html').setAttribute('style', 'font-size:62.5%')
    document.querySelector('body').setAttribute('style', 'padding:3rem')
  },
  beforeUnmount() {
    // document.querySelector('body').setAttribute('style', '')
    document.querySelector('html').setAttribute('style', this.htmlStyle)
    document.querySelector('body').setAttribute('style', this.bodyStyle)
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
