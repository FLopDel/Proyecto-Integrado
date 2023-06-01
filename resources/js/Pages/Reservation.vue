<template>
    <Layout>
        <div class="linea">
            <img class="w-32 h-2.5" src="../../img/lineas.png" alt="lineas">
            <h2 class="text-center font-semibold text-3xl text-black uppercase font-oswald">Reservas</h2>
            <img class="w-32 h-2.5" src="../../img/lineas.png" alt="lineas">
        </div>

        <div>
            <p class="text-center italic font-normal text-base mb-14 font-yellowtail">
                Reservar una mesa nunca ha sido tan fácil con las reservas de restaurante en línea gratuitas e instantáneas,
                ¡reserva ahora!
            </p>
        </div>
        <div>
            <img class="text-center block w-16 h-14 bg-no-repeat mb-0.5 mt-0 m-auto" src="../../img/gorro.png" alt="gorro">
            <div class="linea">
                <img class="w-32 h-2.5" src="../../img/linea.png" alt="lineas">
                <h4 class="text-center text-xl text-black font-normal font-cabin">No esperes</h4>
                <img class="w-32 h-2.5" src="../../img/linea.png" alt="lineas">
            </div>

            <h1 class="text-center uppercase text-5xl max-[425px]:text-4xl font-medium">Haz tu reservas</h1>
            <div class="linea">
                <img class="w-32 h-2.5" src="../../img/linea.png" alt="lineas">
                <img class="w-32 h-2.5" src="../../img/linea.png" alt="lineas">
            </div>
            <h3 class="text-center uppercase text-3xl font-normal mt-8 ml-0 mb-3.4 mr-0">Tel. 958-543-243</h3>
        </div>

        <div class="mt-10 mb-10 flex flex-wrap-reverse text-center justify-center max-[425px]:flex max-[425px]:flex-col max-[425px]:mb-4 max-[425px]:text-center max-[425px]:text-xs">
            
            <div class="bg-reserv2 bg-cover duration-150 object-cover bottom-0 m-4 border-4 rounded-xl transition ease-in-out w-96 bg-black max-[425px]:mb-4 max-[425px]:m-0 max-[425px]:w-full"
                style="border-color: #C8935F;">
            </div>

            <div class="bg-black/10 bg-cover object-cover bottom-0 m-20 max-[425px]:m-0 max-[425px]:w-full border-4 rounded-xl  ease-in-out w-96 "
                style="border-color: #C8935F;">
                <div class="rounded-xl flex flex-col items-center m-8">
                    <form class="w-9/12 flex flex-col items-center" @submit.prevent="hacerReserva()">
                        <div class="flex flex-col -mx-3 mt-10 mb-6">
                            <div class="w-full md:w-1/2 max-[425px]:mb-4">
                                <label class="labels" for="grid-password">
                                    Telefono
                                </label>
                                <input class="campo" id="grid-password" type="text" placeholder="658689825" v-model="phone" required>
                            </div>

                        </div>
                        <div class="flex flex-col -mx-3 mb-6">
                            <div class="w-full md:w-1/2 max-[425px]:mb-4">
                                <label class="labels" for="grid-password">
                                    Personas
                                </label>
                                <input class="campo" id="grid-password" type="number" v-model="people" min="2" placeholder="Máximo 12" required>
                            </div>

                        </div>
                        <div class="flex flex-col -mx-3 mb-6">
                            <div class="w-full md:w-1/2 max-[425px]:mb-4">
                                <label class="labels" for="grid-password">
                                    Día
                                </label>
                                <input class="fechaHora" id="fechaHora" type="date" v-model="date" required>
                            </div>

                        </div>
                        <div class="flex flex-col -mx-3 mb-6">
                            <div class="w-full md:w-1/2 max-[425px]:mb-4">
                                <label class="labels" for="grid-password">
                                    Hora
                                </label>
                                <input class="fechaHora" id="fechaHora" type="time" v-model="time" required>
                            </div>

                        </div>
                        <button type="submit" class="font-bold border-black border-2 text-center mb-6 h-11 w-52 rounded"
                            style="background-color: #e7cd9d;">Reservar</button>

                    </form>
                </div>
            </div>

            <div class="bg-reserv3 bg-cover duration-150 object-cover bottom-0 m-4 border-4 rounded-xl transition ease-in-out w-96 bg-black max-[425px]:mt-4 max-[425px]:mb-4 max-[425px]:m-0 max-[425px]:w-full"
                style="border-color: #C8935F;">
            </div>

        </div>
    </Layout>
</template>


<script>
import axios from 'axios';
import Layout from '@/Layouts/Layout.vue';
import Swal from 'sweetalert';

export default {
    data() {
        return {
            id_user: '',
            phone: '',
            people: '',
            date: '',
            time: '',
            isValid: false
        };
    },
    methods: {
        validarFormulario() {
            this.isValid = true;
            if (this.phone === '' || (!/^[0-9]{9}$/.test(this.phone))) {
                this.isValid = false;
            }
            if (this.people === '' || this.people > 12 || this.people < 2) {
                this.isValid = false;
            }
            if (this.date === '') {
                this.isValid = false;
            }
            if (this.time === '') {
                this.isValid = false;
            }
            return this.isValid;
        },
        hacerReserva() {
            if (this.validarFormulario()) {
                const datosReserva = {
                    phone: this.phone,
                    people: this.people,
                    date: this.date,
                    time: this.time
                };  
                //inserta los datos a la bbdd cuando son validos
                axios.post('/reservation', datosReserva)
                    .then(response => {
                        console.log(response.data)

                        if (response.data.error) {
                            swal({
                                title: "!No puede reservar!",
                                text: "a la misma hora",
                                icon: "error"
                            }).then(function () {
                                // window.location = "/login";
                            });
                        }

                        if (!response.data.error) {
                            Swal({
                                title: '¡Ha realizado su reserva!',
                                text: 'Le esperamos',
                                icon: 'success',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                window.location = "/menu";
                            });
                        }

                        if (response.data.registro) {
                            Swal({
                                title: '¡Debe de iniciar sesion!',
                                text: 'Redirigiendo al login',
                                icon: 'warning',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                window.location = "/login";
                            });
                        }
                        if (response.data.aforo) {
                            Swal({
                                title: '¡No puede reservar!',
                                text: 'Aforo completado al maximo',
                                icon: 'warning',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                // window.location = "/login";
                            });
                        }

                        if (response.data.fecha) {
                            swal({
                                title: "!No puede reservar antes!",
                                text: "de la fecha actual",
                                icon: "warning"
                            }).then(function () {
                                // window.location = "/login";
                            });
                        }
                    });
                this.phone = '';
                this.date = '';
                this.time = '';
                this.people = '';
            } else {
                Swal({
                    title: '¡Caracteres incorrectos!',
                    text: 'Pruebe nuevamente',
                    icon: 'warning',
                    confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                }).then(function () {
                    // window.location = "/login";
                });
            }
        }
    },
    components: {
        Layout
    },

};
</script>
