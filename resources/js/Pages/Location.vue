<script setup>
import Layout from '@/Layouts/Layout.vue';
</script>

<template>
    <Layout>
        <div class="m-12 flex justify-center items-center">
            <img id="linea" src="../../img/lineas.png" alt="lineas">
            <h2 class="text-center ml-2 mr-2 font-semibold text-3xl uppercase">Ubicacion</h2>
            <img id="linea" src="../../img/lineas.png" alt="lineas">
        </div>
        <div class=" cajaGrande min-[1025px]:grid min-[1025px]:gap-8 min-[1025px]:items-center min-[1025px]:grid-cols-2 grid grid-cols-2 justify-center items-center m-4 max-[1440px]:flex max-[1440px]:flex-col ">
            <div class="cajaMapa flex justify-center w-full h-full mb-4 border-2 border-black">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d204611.22855081735!2d-4.181099705468721!3d36.7453602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd7225120e60abc7%3A0x2240ffb35c030fff!2sRestaurante%20La%20Fuente!5e0!3m2!1ses!2ses!4v1683729819458!5m2!1ses!2ses"
                    width="1500" height="850" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                
            </div>
            <div class="cajaInformacion">

                <div class="m-4 mb-4">
                    <h2 class="info">Nombre </h2>
                    <p id="info" class="parrafo">
                        Restaurante La Fuente
                    </p>
                </div>
                <div class="m-4 mb-4">
                    <h2 class="info">Dirección </h2>
                    <p id="info" class="parrafo">
                        Avenida Federico, 12
                    </p>
                </div>
                <div class="m-4 mb-4">
                    <h2 class="info">Teléfono </h2>
                    <p id="info" class="parrafo">
                        +34 958543243
                    </p>
                </div>
                <div class="m-4 mb-4">
                    <h2 class="info">Email </h2>
                    <p id="info" class="parrafo">
                        lafuente@restaurante.com
                    </p>
                </div>
            </div>
        </div>
    </Layout>
</template>


<!-- <style scoped>
/* Estilos para tablets y dispositivos con mayor resolución */
@media screen and (min-width: 1025) {
    #cajaGrande {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 2rem;
        align-items: center;
    }

    #cajaMapa {
        margin-bottom: 0;
        height: auto;
    }

    #information {
        padding: 1rem;
        text-align: center;
    }

    #information div {
        margin-bottom: 2rem;
    }

    #information h2 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    #information p {
        font-size: 1.2rem;
    }
}

.info {
    @apply text-white underline text-xl font-bold mb-2;
}

.parrafo {
    @apply text-white text-base;
}

.cajaInformacion {
    @apply bg-gray-800 flex m-auto flex-col justify-center w-4/5 h-auto text-gray-400 border-4 text-center;
}
</style> -->


  