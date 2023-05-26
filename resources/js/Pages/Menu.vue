<template>
    <Layout>
        <div>
            <div class="mt-12 mb-20" v-for="seccion in seccionMenu" :key="seccion.id">
                <div class="m-2 flex justify-center items-center">
                    <div>
                        <img class="h-2 w-11" src="../../img/linea.png" alt="lineas">
                    </div>
                    <h4 class="text-center uppercase text-4xl font-oswald">{{ seccion.title }}</h4>
                    <div>
                        <img class="h-2 w-11" src="../../img/linea.png" alt="lineas">
                    </div>
                </div>

                <h1 class="text-center uppercase mt-0 ml-auto font-semibold text-xl italic font-yellowtail text-yellow-700">
                    {{ seccion.subtitle }}</h1>
                <div class="flex justify-center text-center">
                    <img v-bind:src="'http://lafuenterestaurante.es/storage/secciones/' + seccion.imagen" alt="secciones">
                </div>

                <div
                    class="flex flex-wrap-reverse text-center justify-center max-[425px]:flex max-[425px]:flex-col max-[425px]:text-center max-[425px]:text-xs">
                    <div v-for="datos in datosPlatos" :key="datos.id">
                        <div v-if="datos.id_section == seccion.id">
                            <ul>
                                <li class="m-6">
                                    <h2 class="plato">{{ datos.name }}</h2>
                                    <div>
                                        {{ datos.ingredients }}<span class="ml-2 text-amber-500 font-bold">...{{ datos.price }}€</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>


<script>
import axios from 'axios';
import Layout from '@/Layouts/Layout.vue';
import { ref, watchEffect } from 'vue';

export default {
    components: {
        Layout
    },
    setup() {
        const seccionMenu = ref([]);
        const datosPlatos = ref([]);

        watchEffect(() => {
            axios.get('/secciones')
                .then(response => {
                    seccionMenu.value = response.data;
                    // console.log(seccionMenu);
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });
        watchEffect(() => {
            axios.get('/datosPlatos')
                .then(response => {
                    datosPlatos.value = response.data;
                    // console.log(datosPlatos);
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });

        return {
            seccionMenu,
            datosPlatos
        }
    },
};

</script>
