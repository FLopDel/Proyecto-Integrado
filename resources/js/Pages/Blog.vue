<template>
    <Layout>
        <div class="linea">
            <img class="w-32 h-2.5" src="../../img/lineas.png" alt="lineas">
            <h2 class="text-center font-semibold text-3xl text-black uppercase font-oswald  dark:text-black">Noticias</h2>
            <img class="w-32 h-2.5" src="../../img/lineas.png" alt="lineas">
        </div>

        <div>
            <p class="text-center italic font-normal text-base font-yellowtail">
                Muestra tus fotos de la visita al mejor restaurante de Andalucia!
            </p>
        </div>

        <div class="flex justify-center items-center mt-4">
            <button class="text-white bg-blue-600 rounded dark:bg-blue-500 px-2" @click="scrollToTarget">Rellena tu
                Noticia</button>
        </div>


        <div class="bg-white dark:bg-white">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="grid gap-8 lg:grid-cols-2">
                    <article v-for="noticias in noticiasClientes" :key="noticias.id"
                        class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <span class="text-sm font-cabin">Autor: {{ noticias.name }}</span>
                            <span class="font-medium dark:text-white font-cabin">
                                Día: {{ noticias.date }}
                            </span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ noticias.title
                        }}
                        </h2>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400 font-yellowtail">
                            {{ noticias.message }}
                        </p>
                        <div class="flex items-center justify-center">
                            <div class="flex items-center space-x-4">
                                <img v-bind:src="'http://lafuenterestaurante.es/storage/blog/' + noticias.imagen"
                                    alt="secciones">
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>


        <!-- Formulario -->
        <h1
            class="mt-4 mb-4 text-2xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-2xl dark:text-black ">
            Rellena el
            <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">formulario</mark> para publicar tu
            <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">visita</mark>
        </h1>
        <div class="container ml-auto mr-auto flex items-center justify-center">
            <div class="w-full m-4" id="target">
                <form class="bg-white px-8 pt-6 pb-8" @submit.prevent="guardarBlogCliente()" method="post">
                    <div class="mb-4">
                        <div class="grid grid-flow-row sm:grid-flow-col gap-3">
                            <div class="sm:col-span-4 justify-center">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name"> Nombre
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name" v-model="name" type="text" placeholder="Carlos Torres" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="grid grid-flow-row sm:grid-flow-col gap-3">
                            <div class="sm:col-span-4 justify-center">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title"> Titulo de la
                                    Publicacion
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="title" v-model="title" type="text" placeholder="Titulo de la noticia" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="grid grid-flow-row sm:grid-flow-col gap-3">
                            <div class="sm:col-span-4 justify-center">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Foto de la visita
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="image" type="file" ref="image" @change="cargarImagenCliente" accept="image/*"
                                    required>
                            </div>
                            <div class="sm:col-span-4 justify-center">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="date"> Dia de la visita
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="date" type="date" v-model="date" placeholder="Dia de la visita" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="message"> Mensaje
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="message" v-model="message" rows="5" placeholder="Mensaje" required></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit"> Publicar </button>
                    </div>
                </form>

            </div>
        </div>
    </Layout>
</template>

<script>
import axios from 'axios';
import Layout from '@/Layouts/Layout.vue';
import Swal from 'sweetalert';
import { ref, watchEffect } from 'vue';


export default {
    data() {
        return {
            name: '',
            title: '',
            date: '',
            message: '',
            image: null,
            isValid: false

        };
    },
    components: {
        Layout,
    },
    methods: {
        scrollToTarget() {
            const targetElement = document.getElementById('target');
            const offset = targetElement.offsetTop;
            window.scrollTo({ top: offset, behavior: 'smooth' });
        },
        cargarImagenCliente() {
            this.image = this.$refs.image.files[0];
        },
        validarFormularioNoticia() {
            this.isValid = true;
            if (this.name === '' || (!/^[A-Za-z\s]+$/.test(this.name))) {
                this.isValid = false;
            }
            if (this.title === '' || (!/^[A-Za-z\s]+$/.test(this.title))) {
                this.isValid = false;
            }
            if (this.message === '' || (!/^[A-Za-z0-9.,!]$/.test(this.message))) {
                this.isValid = false;
            }

            return this.isValid;
        },
        //guardar seccion a la bbdd
        guardarBlogCliente() {
            if (this.validarFormularioNoticia()) {
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('title', this.title);
                formData.append('date', this.date);
                formData.append('message', this.message);
                formData.append('imagen', this.image);

                axios.post('/blog', formData)
                    .then(response => {
                        console.log(response.data)
                        this.noticiasClientes = response.data.comentarios;

                        if (!response.data.error) {
                            Swal({
                                title: '¡Ha publicado una noticia!',
                                text: 'Gracias por su visita',
                                icon: 'success',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                noticiasClientes.value = response.data;
                            });
                        }
                        if (response.data.error) {
                            Swal({
                                title: '¡Es necesario iniciar sesion!',
                                text: 'Redirigiendo al login',
                                icon: 'error',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                window.location = '/login';
                            });
                        }
                    });

                this.name = '';
                this.title = '';
                this.date = '';
                this.message = '';
                this.image = '';
            } else {
                Swal({
                    title: '¡Caracteres incorrectos!',
                    text: 'Prube nuevamente',
                    icon: 'warning',
                    confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                })
            }

        },
    },
    setup() {
        const noticiasClientes = ref([]);
        //Peticion muestra de datos
        watchEffect(() => {
            axios.get('/blogs')
                .then(response => {
                    noticiasClientes.value = response.data;
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });
        return {
            noticiasClientes
        }
    },
}

</script>


