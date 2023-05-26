<template>
  <Layout>
    <div class="imgNosotros">
      <div class="m-4 flex justify-center items-center">
        <img class="lineas" src="../../img/lineas.png" alt="lineas">
        <h2 class="text-center uppercase font-semibold text-3xl	font-oswald text-black ">Sobre Nosotros</h2>
        <img class="lineas" src="../../img/lineas.png" alt="lineas">
      </div>
      <div class="mt-4 flex justify-center">
        <p class="text-center italic font-normal text-base font-cabin">
          Nos encantan los restaurantes tanto como a ti. Por eso les ayudamos a llenar mesas desde 1999. Bienvenidos a
          restaurante LaFuente
        </p>
      </div>
    </div>

    <div class="max-[1440px]:m-0 ml-60 mr-60">
      <div class="caja">
        <p
          class="max-[1440px]:w-auto max-[1440px]:h-auto max-[1440px]:ml-0 max-[1440px]:mt-4 max-[1440px]:mb-4  m-8 justify-center text-center flex items-center font-cabin max-w-xl max-h-xl">
          Sabor maduro traidor por el tiempo
          Todos nuestros bistecs y chuletas de primera calidad se añejan en seco en el lugar y los sirve un personal
          dedicado y experto con años de experiencia en asadores. El entorno está preparado para impresionar: ya sea
          para
          una cena romántica, un almuerzo energético, una cena para un cliente o una celebración familiar.
        </p>
        <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
          delay: 8000,
          disableOnInteraction: false,
        }" :navigation="false" :modules="modules" class="sliider">
          <swiper-slide class="swiper">
            <img class="m-auto" src="../../img/img1.jpg" alt="image slide 1" />
          </swiper-slide>
          <swiper-slide class="swiper">
            <img class="m-auto" src="../../img/img2.jpg" alt="image slide 2" />
          </swiper-slide>
          <swiper-slide class="swiper">
            <img class="m-auto" src="../../img/img3.jpg" alt="image slide 3" />
          </swiper-slide>
        </swiper>


      </div>
    </div>

    <div class="max-[1440px]:m-0 ml-60 mr-60">
      <div class="caja">
        <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
          delay: 7000,
          disableOnInteraction: false,
        }" :pagination="{ clickable: false }" :navigation="false" :modules="modules" class="slider">
          <swiper-slide class="swiper">
            <img class="m-auto" src="../../img/about1.jpg" alt="image slide 1" />
          </swiper-slide>
          <swiper-slide class="swiper">
            <img class="m-auto" src="../../img/about2.jpg" alt="image slide 2" />
          </swiper-slide>
          <swiper-slide class="swiper">
            <img class="m-auto" src="../../img/about3.jpg" alt="image slide 3" />
          </swiper-slide>
        </swiper>

        <p id="description"
          class="m-8 justify-center text-center flex items-center font-cabin max-w-xl max-h-xl font-baskerville">
          Bienvenido a LaFuente, un restaurante moderno con un enfoque en los sabores de comida premium
          Te invitamos a celebrar las deliciosas recetas de nuestro restaurante ya sea que estés aquí para un almuerzo o
          una cena de negocios. Descubre nuevos sabores y recetas inspiradas de todo el mundo.
        </p>
      </div>
    </div>
  </Layout>
</template>


<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
import { Autoplay, Pagination, Navigation } from "swiper";
import Layout from '@/Layouts/Layout.vue';


export default {
  components: {
    Swiper,
    SwiperSlide,
    Layout
  },
  setup() {
    return {
      modules: [Autoplay, Pagination, Navigation],
    };
  },
};
</script>
