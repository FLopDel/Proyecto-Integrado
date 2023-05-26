<template>
    <header>
        <Nav />
    </header>

    <section clas="cuerpo">
        <div>
            <slot />
        </div>

        <div>
            <Pie />
        </div>
    </section>
</template>

<script>

import Nav from "./Header.vue";
import { Head } from "@inertiajs/vue3";
import Pie from "./Footer.vue";
export default {
    components: { Nav, Head, Pie },

    // props: { username: String }

    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    }
}

</script>

<style>
/* Quita la bar de scroll */
::-webkit-scrollbar {
    display: none;
}

.cuerpo {
    @apply flex flex-col justify-between min-h-screen
}

/* Styles de la página administracion */
.linea {
    @apply m-4 flex justify-center items-center;
}

.campo {
    @apply appearance-none block w-full bg-gray-200 text-gray-700 border border-black rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
}

.trImpar {
    @apply bg-gray-300 border border-gray-500 md:border-none block md:table-row;
}

.trPar {
    @apply bg-white border border-gray-500 md:border-none block md:table-row;
}

.td {
    @apply p-2 m-auto md:border md:border-gray-500 text-left block md:table-cell;
}

.span {
    @apply inline-block w-1/4 md:hidden font-bold;
}

.th {
    @apply bg-gray-600 p-2 text-white font-bold max-[750px]:hidden md:border md:border-gray-500 text-left block md:table-cell;
}

.botonCancelar {
    @apply bg-red-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell;
}

.pagelink {
    @apply block bg-white border-2 border-white cursor-pointer;
}

.pageitem {
    @apply block bg-white border-2 border-white cursor-pointer m-1;
}

/* Styles de la página aboutUs */


.lineas {
    @apply align-text-bottom m-3.5 text-black;
}

.sliider {
    @apply flex justify-center items-center w-full h-full;
}
.slider {
    @apply flex justify-center items-center w-full h-full;
}

.caja {
    @apply flex justify-center m-auto p-4 max-[1440px]:flex-col items-center;
}

/* Styles de la página Home */
#fondo {
    -webkit-animation: change-background 20s infinite;
    /* Prefijo para Safari y Chrome */
    -moz-animation: change-background 20s infinite;
    /* Prefijo para Firefox */
    animation: change-background 20s infinite;
    will-change: transform; /* Agrega esta línea */
    image-rendering:optimizeSpeed;
    transition: background-image 1s ease-in-out;
    
}


@keyframes change-background {
    0% {
        background-image: url(http://lafuenterestaurante.es/resources/img/01.jpg);
    }

    33% {
        background-image: url(http://lafuenterestaurante.es/resources/img/02.jpg);
    }

    66% {
        background-image: url(http://lafuenterestaurante.es/resources/img/03.jpg);
    }

    100% {
        background-image: url(http://lafuenterestaurante.es/resources/img/01.jpg);
    }
}

/* Styles de la página Location */

.info {
    @apply text-white underline text-xl font-bold mb-2;
}

.parrafo {
    @apply text-white text-base;
}

.cajaInformacion {
    @apply bg-gray-800 flex m-auto flex-col justify-center w-4/5 h-auto text-gray-400 border-4 text-center;
}

/* Styles de la página Menu */
.plato {
    @apply font-bold uppercase;
}

.menu {
    @apply ml-12 mr-12 font-serif grid grid-cols-3;
}


/* Styles de la página Opinion */
.opinion {
    @apply m-2 text-justify
}

.imagenSecundaria {
    @apply hover:opacity-0 bg-cover transition duration-1000 ease-in-out;
}

.nombre {
    @apply text-black text-2xl font-cabin mr-4 underline;
}

.fecha {
    @apply text-sm right-0 ml-auto font-cabin;
}

.lineaSeparatoria {
    @apply text-black m-2 font-semibold;
}

.nombreFecha {
    @apply flex flex-row text-center;
}

.linea {
    @apply align-text-bottom m-3.5 text-black
}


/* Styles de la página Reservas */
.linea {
    @apply m-4 flex justify-center items-center;
}

.campo {
    @apply appearance-none text-center block w-auto bg-gray-200/30 placeholder:text-black placeholder:text-xl border-t-0  border-r-0 border-l-0 text-gray-700 border border-black rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
}

.fechaHora{
    @apply appearance-none text-center block w-auto bg-gray-200/30 placeholder:text-black placeholder:text-xl border-t-0  border-r-0 border-l-0 text-gray-700 border border-black rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
}


.labels {
    @apply block uppercase tracking-wide w-52 text-black text-2xl rounded-3xl font-extrabold mb-2;
}
</style>
