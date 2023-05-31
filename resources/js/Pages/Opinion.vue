<template>
    <div id="fondoComentarios" class="bg-cover bg-center">
        <Layout>
            <div class="mt-4 flex justify-center items-center ">
                <img class="linea" src="../../img/lineas.png" alt="lineas">
                <h2 class="text-center uppercase font-semibold text-3xl	font-mono text-black">Opiniones</h2>
                <img class="linea" src="../../img/lineas.png" alt="lineas">
            </div>

            <div class="flex justify-center  max-[1440px]:grid">

                <div class="h-[520px] border-gray-400 border-2 overflow-y-auto m-2 sm:w-auto max-w-3xl">
                    <div class="opinion" v-for="datos in comentariosPersonas" :key="datos.id">
                        <div class="nombreFecha">
                            <h2 class="nombre">{{ datos.name }}</h2>
                            <p class="fecha">Fecha: {{ formatDate(datos.created_at) }}</p>
                        </div>
                        <p class="font-yellowtail">
                            {{ datos.comments }}
                        </p>
                        <hr class="lineaSeparatoria">
                    </div>

                </div>

                <div class="flex justify-center bg-slate-300/90 m-2">
                    <div class="w-full max-w-xs">
                        <form class="px-8 pt-6 pb-8 mb-4" @submit.prevent="guardarComentarios()" method="post">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    Nombre
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name" type="text" placeholder="Nombre de usuario" name="name" v-model="name" required>
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                    Opinion
                                </label>
                                <textarea class="border rounded w-full h-full resize-none" id="message" cols="30" rows="10"
                                    placeholder="Mesaje -> 255 caracteres" name="comments" v-model="comments" required></textarea>
                            </div>
                            <div class="flex items-center justify-between">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="submit" @click="showSuccessAlert">
                                    Comentar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>



            </div>

            <div class="container mx-auto bg-cover">
                <div class="grid-cols-3 p-20 space-y-2 bg-cover lg:space-y-0 lg:grid lg:gap-3 lg:grid-rows-3">
                    <div class="bg-gallery02 w-full rounded bg-cover">
                        <img src="../../img/gallery01.jpg" alt="image" class="imagenSecundaria">
                    </div>

                    <div class="col-span-2 row-span-2 ">
                        <img src="../../img/gallery02.jpg" class="w-full rounded bg-cover" alt="image">
                    </div>
                    <div class="bg-gallery08 w-full rounded bg-cover">
                        <img src="../../img/gallery03.jpg" alt="image" class="imagenSecundaria">
                    </div>
                    <div class="bg-gallery07 w-full rounded bg-cover">
                        <img src="../../img/gallery04.jpg" alt="image" class="imagenSecundaria">
                    </div>
                    <div class="bg-gallery02 w-full rounded bg-cover">
                        <img src="../../img/gallery05.jpg" alt="image" class="imagenSecundaria">
                    </div>
                    <div class="bg-gallery01 w-full rounded bg-cover">
                        <img src="../../img/gallery06.jpg" alt="image" class="imagenSecundaria">
                    </div>


                </div>
            </div>

        </Layout>

    </div>
</template>

<script>
import axios from 'axios';
import Layout from '@/Layouts/Layout.vue';
import { ref, watchEffect} from 'vue';
import Swal from 'sweetalert';

export default {
    data() {
        return {
            name: '',
            comments: '',
            isValid: false
        };
    },
    methods: {
        validarFormulario() {
            this.isValid = true;
            if (this.name === '' || (!/^[A-Za-z\s]+$/.test(this.name))) {
                this.isValid = false;
            }
            if (this.comments === '' || (!/^[A-Za-z0-9\s]+$/.test(this.comments))) {
                this.isValid = false;
            }
            return this.isValid;
        },
        guardarComentarios() {
            if (this.validarFormulario()) {
                const datosComentario = {
                    name: this.name,
                    comments: this.comments
                };
                //Inserta los datos a la bbdd cuando son validos
                axios.post('/opinion', datosComentario)
                    .then(response => {
                        this.comentariosPersonas = response.data.comentarios;
                        // console.log(response.data)

                        if (!response.data.error) {
                            Swal({
                                title: '¡Ha comentado en la web!',
                                text: 'Un placer atenderle',
                                icon: 'success',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                // window.location = "/opinion";
                            });
                        }
                        if (response.data.logeado) {
                            Swal({
                                title: '¡Debe de iniciar sesión!',
                                text: 'Redirigiendo al login',
                                icon: 'error',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                window.location = '/login';
                            });
                        }
                    });
                this.name = '';
                this.comments = '';
                
            }else{
                Swal({
                    title: '¡Caracteres incorrectos!',
                    text: 'Pruebe nuevamente',
                    icon: 'warning',
                    confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                }).then(function () {
                });
            }
        },
        formatDate(dateTimeString) {
            return dateTimeString.slice(0, dateTimeString.indexOf('T'));
        }
    },
    components: {
        Layout
    },

    setup() {
        const comentariosPersonas = ref([]);
        //Muestra las valoraciones
        watchEffect(() => {
            axios.get('/opiniones')
                .then(response => {
                    comentariosPersonas.value = response.data;
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });
        return {
            comentariosPersonas
        }
    },
};

</script>


