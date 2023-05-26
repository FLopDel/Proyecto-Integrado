<script setup>
import Layout from '@/Layouts/Layout.vue';
 
</script>

<template>
    <div id="fondo" class="h-full bg-no-repeat bg-cover bg-center ">
        <Layout>
            <div class="grid h-screen place-items-center">
                <img src="../../img/nombre.png" alt="Sunset in the mountains">
                <h2 class="text-6xl max-[375px]:text-3xl italic text-center text-white font-semibold relative leeft-0 w-full font-oswald">Bienvenido al restaurante</h2>
                <div class=" rounded overflow-hidden shadow-lg text-center">
                    <div class="px-6 py-4">
                        <div class="text-3xl italic text-center font-yellowtail relative left-0 w-full text-white">
                            Los Chefs crean combinaciones divinas.
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    </div>
</template>
