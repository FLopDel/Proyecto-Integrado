<template>
    <Layout v-if="$page.props.auth.user.name == 'admin'">
        <div id="graficos" class="flex justify-center mb-8 h-full mt-8 max-[768px]:grid">
            <div class=" max-[425px]:w-72 h-64 mb-8 w-80 mr-auto ml-auto">
                <Bar v-if="loaded && chartData" :data="chartData" :options="chartOptions" />
            </div>
            <div class=" max-[425px]:w-72 h-64 mb-8 w-80 mr-auto ml-auto">
                <Bar v-if="loaded && graficoReservas" :data="graficoReservas" :options="chartOptions" />
            </div>

        </div>

        <div class="m-4 mb-12">
            <h1 class="font-semibold text-2xl mb-4">Comentarios</h1>

            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr class="border border-grey-500 md:border-none block md:table-row">
                        <th class="th">Nombre</th>
                        <th class="th">Opinion</th>
                        <th class="th">Fecha</th>
                        <th class="th">Eliminar</th>
                        <th class="th">Inabilitar</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    <tr class="trImpar" v-for="(datos, index) in paginatedComentarios" :key="datos.id">
                        <td class="td"><span class="span">Nombre</span>{{ datos.name }}</td>
                        <td class="td"><span class="span">Opinion</span>{{ datos.comments }}</td>
                        <td class="td"><span class="span">Fecha</span>{{ formatDate(datos.created_at) }}</td>
                        <td class="td "><button class="bg-red-600 p-2 text-white rounded text-sm uppercase"
                                @click="eliminarComentario(datos.id)">Eliminar</button></td>
                        <td class="td "><button class="bg-red-600 p-2 text-white rounded text-sm uppercase"
                                @click="desactivarComentario(datos.id)">Inabilitar</button></td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-center mt-4">
                <nav>
                    <ul class="flex justify-center list-none p-0">
                        <li class="pageitem" :class="{ disabled: currentPageComentarios === 1 }">
                            <button class="pagelink" @click="previousPageComentarios">Anterior</button>
                        </li>
                        <li class="pageitem" v-for="pageNumber in totalPages" :key="pageNumber"
                            :class="{ active: pageNumber === currentPageComentarios }">
                            <button class="pagelink" @click="goToPageComentarios(pageNumber)">{{ pageNumber }}</button>
                        </li>
                        <li class="pageitem" :class="{ disabled: currentPageComentarios === totalPages }">
                            <button class="pagelink" @click="nextPageComentarios">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="m-4">
            <h1 class="font-semibold text-2xl mb-4">Reservas</h1>

            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr
                        class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                        <th class="th">Nombre</th>
                        <th class="th">Email</th>
                        <th class="th">Telefono</th>
                        <th class="th" @click="ordenarFecha"><button>Date</button></th>
                        <th class="th">Time</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    <tr class="trImpar" v-for="(datosReservas, index) in paginatedReservas" :key="datosReservas.id">
                        <td class="td"><span class="span">Nombre</span>{{ datosReservas.user.name }}</td>
                        <td class="td"><span class="span">Email</span>{{ datosReservas.user.email }}</td>
                        <td class="td"><span class="span">Telefono</span>{{ datosReservas.phone }}</td>
                        <td class="td"><span class="span">Date</span>{{ datosReservas.date }}</td>
                        <td class="td"><span class="span">Time</span>{{ datosReservas.time }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-center mt-4">
                <nav>
                    <ul class="flex justify-center list-none p-0">
                        <li class="pageitem" :class="{ disabled: currentPage === 1 }">
                            <button class="pagelink" @click="previousPage">Anterior</button>
                        </li>
                        <li class="pageitem" v-for="pageNumber in totalPages" :key="pageNumber"
                            :class="{ active: pageNumber === currentPage }">
                            <button class="pagelink" @click="goToPage(pageNumber)">{{ pageNumber }}</button>
                        </li>
                        <li class="pageitem" :class="{ disabled: currentPage === totalPages }">
                            <button class="pagelink" @click="nextPage">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="m-4">
            <h1 class="font-semibold text-2xl mb-4">Secciones</h1>

            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr
                        class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                        <th class="th">Titulo</th>
                        <th class="th">Lema</th>
                        <th class="th">Imagen</th>
                        <th class="th">Eliminar</th>
                        <th class="th">Editar</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group" v-for="(seccion, index) in paginatedSecciones" :key="seccion.id">
                    <tr class="trImpar">
                        <td class="td"><span class="span">Titulo</span>{{ seccion.title }}</td>
                        <td class="td"><span class="span">Lema</span>{{ seccion.subtitle }}</td>
                        <td class="td"><span class="span">Imagen</span>{{ seccion.imagen }}</td>
                        <td class="td "><button class="bg-red-600 p-2 text-white rounded text-sm uppercase"
                                @click="eliminarSecciones(seccion.id)">Eliminar</button></td>
                        <td class="td "><button class="bg-red-600 p-2 text-white rounded text-sm uppercase"
                                :data-id="seccion.id" @click="modal(seccion)">Editar</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="modal flex justify-center m-4" v-if="mostrarModal">
                <div class="modal-content">
                    <button><span class="close" @click="cerrarModal">&times;</span></button>
                    <form @submit.prevent="editarSeccion(seccionModificada.id)" enctype="multipart/form-data">
                        <label for="titulo">Título:</label>
                        <input class="flex" type="text" id="titulo" v-model="seccionModificadatitle"
                            :placeholder="seccionModificada.title" required>
                        <br>
                        <label for="subtitulo">Subtítulo:</label>
                        <input class="flex" type="text" id="subtitulo" v-model="seccionModificadasubtitle"
                            :placeholder="seccionModificada.subtitle" required>
                        <br>
                        <label for="imagen">Imagen:</label>
                        <input class="campo" id="grid-last-name" type="file" :v-model="seccionModificadaimagen"
                            @change="cargarImagenSeccionModificada" required>
                        <br>
                        <button class="border-2 border-black p-4 rounded bg-blue-500 font-semibold text-black"
                            type="submit">Guardar</button>
                    </form>

                </div>
            </div>
            <div class="flex justify-center mt-4">
                <nav>
                    <ul class="flex justify-center list-none p-0">
                        <li class="pageitem" :class="{ disabled: currentPageSecciones === 1 }">
                            <button class="pagelink" @click="previousPageSecciones">Anterior</button>
                        </li>
                        <li class="pageitem" v-for="pageNumber in totalPagesSecciones" :key="pageNumber"
                            :class="{ active: pageNumber === currentPageSecciones }">
                            <button class="pagelink" @click="goToPage(pageNumber)">{{ pageNumber }}</button>
                        </li>
                        <li class="pageitem" :class="{ disabled: currentPageSecciones === totalPages }">
                            <button class="pagelink" @click="nextPageSecciones">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="m-4">
            <h1 class="font-semibold text-2xl mb-4">Noticias</h1>

            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr
                        class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                        <th class="th">Nombre</th>
                        <th class="th">Noticia</th>
                        <th class="th">Mensaje</th>
                        <th class="th">Dia</th>
                        <th class="th">Imagen</th>
                        <th class="th">Eliminar</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    <tr class="trImpar" v-for="(noticia, index) in paginatedNoticias" :key="noticia.id">
                        <td class="td"><span class="span">Nombre</span>{{ noticia.name }}</td>
                        <td class="td"><span class="span">Noticia</span>{{ noticia.title }}</td>
                        <td class="td"><span class="span">Mensaje</span>{{ noticia.message }}</td>
                        <td class="td"><span class="span">Dia</span>{{ noticia.date }}</td>
                        <td class="td "><span class="span">Imagen</span>{{ noticia.imagen }}</td>
                        <td class="td "><button class="bg-red-600 p-2 text-white rounded text-sm uppercase"
                                @click="eliminarNoticia(noticia.id)">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-center mt-4">
                <nav>
                    <ul class="flex justify-center list-none p-0">
                        <li class="pageitem" :class="{ disabled: currentPageNoticias === 1 }">
                            <button class="pagelink" @click="previousPageNoticias">Anterior</button>
                        </li>
                        <li class="pageitem" v-for="pageNumber in totalPagesNoticias" :key="pageNumber"
                            :class="{ active: pageNumber === currentPageNoticias }">
                            <button class="pagelink" @click="goToPageNoticias(pageNumber)">{{ pageNumber }}</button>
                        </li>
                        <li class="pageitem" :class="{ disabled: currentPageNoticias === totalPagesNoticias }">
                            <button class="pagelink" @click="nextPageNoticias">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="m-4">
            <h1 class="font-semibold text-2xl mb-4">Recetas</h1>

            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr
                        class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                        <th class="th">Nombre</th>
                        <th class="th">Insumos</th>
                        <th class="th">Precio</th>
                        <th class="th">Seccion</th>
                        <th class="th">Eliminar</th>
                        <th class="th">Editar</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    <tr class="trImpar" v-for="(recetas, index) in paginatedRecetas" :key="recetas.id">
                        <td class="td"><span class="span">Nombre</span>{{ recetas.name }}</td>
                        <td class="td"><span class="span">Insumos</span>{{ recetas.ingredients }}</td>
                        <td class="td"><span class="span">Precio</span>{{ recetas.price }}€</td>
                        <td class="td"><span class="span">Seccion:</span> {{ secciones.find(seccion => seccion.id ==
                            recetas.id_section)?.title || 'N/A' }}</td>
                        <td class="td "><button class="bg-red-600 p-2 text-white rounded text-sm uppercase"
                                @click="eliminarRecetas(recetas.id)">Eliminar</button></td>
                        <td class="td "><button class="bg-red-600 p-2 text-white rounded text-sm uppercase"
                                @click="modalReceta(recetas)">Editar</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="modal flex justify-center m-4" v-if="mostrarModalReceta">
                <div class="modal-content">
                    <button><span class="close" @click="cerrarModal">&times;</span></button>
                    <form @submit.prevent="editarReceta(recetaModificada.id)" enctype="multipart/form-data">
                        <label for="titulo">Nombre:</label>
                        <input class="flex" type="text" id="titulo" v-model="recetaModificadaname"
                            :placeholder="recetaModificada.name">
                        <br>
                        <label for="subtitulo">Ingredientes:</label>
                        <input class="flex" type="text" id="subtitulo" v-model="recetaModificadaingredients"
                            :placeholder="recetaModificada.ingredients">
                        <br>
                        <label class="labels" for="grid-last-name">
                            Seccion
                        </label>
                        <select class="campo" id="grid-last-name" v-model="recetaModificadaid_section">
                            <option disabled selected value="">Selecciona una seccion</option>
                            <option v-for="seccion in secciones" :key="seccion.id" :value="seccion.id">{{ seccion.title }}
                            </option>
                        </select>
                        <br>
                        <label for="imagen">Precio:</label>
                        <input class="campo" id="grid-last-name" type="text" v-model="recetaModificadaprice"
                            :placeholder="recetaModificada.price">
                        <br>
                        <button class="border-2 border-black p-4 rounded bg-blue-500 font-semibold text-black"
                            type="submit">Guardar</button>
                    </form>

                </div>
            </div>

            <div class="flex justify-center mt-4">
                <nav>
                    <ul class="flex justify-center list-none p-0">
                        <li class="pageitem" :class="{ disabled: currentPageRecetas === 1 }">
                            <button class="pagelink" @click="previousPageRecetas">Anterior</button>
                        </li>
                        <li class="pageitem" v-for="pageNumber in totalPagesRecetas" :key="pageNumber"
                            :class="{ active: pageNumber === currentPageRecetas }">
                            <button class="pagelink" @click="goToPage(pageNumber)">{{ pageNumber }}</button>
                        </li>
                        <li class="pageitem" :class="{ disabled: currentPageRecetas === totalPages }">
                            <button class="pagelink" @click="nextPageRecetas">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>



        <h1 class="text-center text-2xl m-14 font-semibold">Añadir Seccion</h1>
        <div>
            <div class="flex justify-center m-8">
                <form class="w-9/12" @submit.prevent="guardarSeccion()" method="post">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-8 mb-6">
                            <label class="labels" for="grid-first-name">
                                Titulo
                            </label>
                            <input class="campo" type="text" v-model="title" required>
                        </div>
                        <div class="w-full md:w-1/2 px-8">
                            <label class="labels" for="grid-last-name">
                                Subtitulo
                            </label>
                            <input class="campo" id="grid-last-name" type="text" v-model="subtitle" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-8">
                            <label class="labels" for="grid-password">
                                Imagen
                            </label>
                            <input class="campo" id="grid-last-name" type="file" ref="imageSeccion"
                                @change="cargarImagenSeccion" required>
                        </div>
                    </div>

                    <div class="flex justify-center text-center -mx-3 mb-6">

                        <div class="w-40 md:w-1/2 px-8 ">
                            <button type="submit" class="appearance-none block w-full text-black font-bold border border-black rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
  bg-red-400">Añadir Seccion</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>

        <hr>

        <h1 class="text-center text-2xl m-14 font-semibold">Añadir plato</h1>
        <div>
            <div class="flex justify-center m-8">
                <form class="w-9/12" @submit.prevent="guardarPlato()" method="post">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-8 mb-6">
                            <label class="labels" for="grid-first-name">
                                Nombre Plato
                            </label>
                            <input class="campo" type="text" v-model="name" required>
                        </div>
                        <div class="w-full md:w-1/2 px-8">
                            <label class="labels" for="grid-last-name">
                                Precio
                            </label>
                            <input class="campo" id="grid-last-name" type="text" v-model="price" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-8 mb-6">
                            <label class="labels" for="grid-first-name">
                                Ingredientes
                            </label>
                            <textarea class="campo" id="grid-password" type="text" v-model="ingredients"
                                required></textarea>
                        </div>
                        <div class="w-full md:w-1/2 px-8">
                            <label class="labels" for="grid-last-name">
                                Seccion
                            </label>
                            <select class="campo" id="grid-last-name" v-model="id_section" required>
                                <option v-for="seccion in secciones" :key="seccion.id" :value="seccion.id">{{ seccion.title
                                }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-center text-center -mx-3 mb-6">

                        <div class="w-40 md:w-1/2 px-8 ">
                            <button class="appearance-none block w-full text-black font-bold border border-black rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
  bg-red-400" type="submit">Añadir Plato</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </Layout>
</template>

<script>
import axios from 'axios';
import Layout from '@/Layouts/Layout.vue';
import { ref, watchEffect } from 'vue';
import { Bar, Pie } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, ArcElement, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import Swal from 'sweetalert';
import { reactive } from 'vue';

ChartJS.register(Title, Tooltip, ArcElement, Legend, BarElement, CategoryScale, LinearScale);

export default {
    data() {
        return {
            currentPageRecetas: 1,
            currentPageComentarios: 1,
            currentPageSecciones: 1,
            currentPageNoticias: 1,
            currentPage: 1,
            itemsPerPage: 5,
            comentariosPersonas: [],
            reservas: [],
            noticias: [],

            mostrarModal: false,
            mostrarModalReceta: false,
            isValidSeccion: false,
            isValidPlato: false,


            title: '',
            subtitle: '',
            imageSeccion: null,

            seccionModificadatitle: '',
            seccionModificadasubtitle: '',
            seccionModificadaimagen: null,

            seccionModificada: {},
            imagenModificada: {},


            name: '',
            price: '',
            ingredients: '',
            id_section: '',

            recetaModificadaname: '',
            recetaModificadaprice: '',
            recetaModificadaingredients: '',
            recetaModificadaid_section: '',

            recetaModificada: {},

            loaded: false,
            graficoReservas: null,
            chartData: null,
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false,

            },
        };
    },
    components: {
        Layout,
        Bar,
        Pie
    },
    // funcion para montrar las graficas
    async mounted() {
        this.loaded = false

        try {
            const resSecciones = await axios.get('/tituloSecciones');
            const resPlatos = await axios.get('/numeroPlatos')

            // Ordenar las secciones por un identificador único por  el ID
            const secciones = resSecciones.data.sort((a, b) => a.id - b.id);
            // Ordenar los platos por el mismo identificador único por el ID de la sección a la que pertenecen)
            const platos = resPlatos.data.sort((a, b) => a.section_id - b.section_id);

            if (secciones && platos) {
                const labels = secciones.map(u => u.title);
                this.chartData = {
                    labels: labels,
                    datasets: [{
                        label: 'Platos por sección',
                        backgroundColor: ['#ff6384', '#36a2eb', '#4bc0c0'],
                        data: platos.map(u => u.numPlatos)
                    }]
                }
                this.loaded = true;
            }
        } catch (e) {
            console.error(e)
        }


        try {
            const fechaReserva = await axios.get('/numReservas');
            const reservas = await axios.get('/numReservas')


            const fecha = fechaReserva.data;
            const numReservas = reservas.data;

            // console.log(numReservas.map(u => u.date))
            // console.log(numReservas.map(u => u.count))


            if (fecha && numReservas) {
                const labels = fecha.map(u => u.date);
                this.graficoReservas = {
                    labels: labels,
                    datasets: [{
                        label: 'reservas por fecha',
                        backgroundColor: ['#ff6384', '#36a2eb', '#4bc0c0'],
                        data: numReservas.map(u => u.count)
                    }]
                }

                this.loaded = true
            }

        } catch (e) {
            console.error(e)
        }
    },
    methods: {
        //cargar imagen seccion del formulario
        cargarImagenSeccion(event) {
            this.image = event.target.files[0]
        },
        cargarImagenSeccionModificada(event) {
            this.seccionModificadaimagen = event.target.files[0]
        },
        //validacion seccion
        validarFormularioSeccion() {
            this.isValidSeccion = true;
            if (this.title === '' || (!/[A-Za-z]+$/.test(this.title))) {
                this.isValidSeccion = false;
            }
            if (this.subtitle === '' || (!/[A-Za-z]+$/.test(this.subtitle))) {
                this.isValidSeccion = false;
            }
            if (this.imagen === '') {
                this.isValidSeccion = false;
            }

            return this.isValidSeccion;
        },
        //guardar seccion a la bbdd
        guardarSeccion() {
            if (this.validarFormularioSeccion()) {
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('subtitle', this.subtitle);
                formData.append('imagen', this.image);

                axios.post('/section', formData)
                    .then(response => {
                        // console.log(response.data)

                        if (!response.data.error) {
                            swal({
                                title: "!Ha creado una seccion!",
                                icon: "success"
                            }).then(function () {
                                window.location = "/administration";
                            });
                        }

                        if (response.data.error) {
                            Swal({
                                title: '¡Error al crear la seccion!',
                                icon: 'error',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                // window.location = "/administration";
                            });
                        }
                    }).catch(error => {
                        console.error(error);
                    });

                this.title = '';
                this.subtitle = '';
                this.image = '';
            } else {
                Swal({
                    title: '¡Datos mal introducidos!',
                    text: 'Pruebe nuevamente',
                    icon: 'warning',
                    confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                })
            }

        },
        //validacion plato
        validarFormularioPlato() {
            this.isValidPlato = true;
            if (this.name === '' || (!/[A-Za-z\s]+$/.test(this.name))) {
                this.isValidPlato = false;
                return this.isValidPlato
            }
            if (this.ingredients === '' || (!/[A-Za-z]+$/.test(this.ingredients))) {
                this.isValidPlato = false;
                return this.isValidPlato
            }
            if (this.price === '' || (!/^[0-9]+(\.[0-9]+)?$/.test(this.price))) {
                this.isValidPlato = false;
                return this.isValidPlato
            }
            if (this.id_section === '') {
                this.isValidPlato = false;
                return this.isValidPlato
            }

            return this.isValidPlato;
        },
        //guarda plato en bbdd
        guardarPlato() {
            if (this.validarFormularioPlato()) {
                const datosPlato = {
                    name: this.name,
                    price: this.price,
                    ingredients: this.ingredients,
                    id_section: this.id_section
                };

                axios.post('/menu', datosPlato)
                    .then(response => {
                        // console.log(response.data)

                        if (!response.data.error) {
                            swal({
                                title: "!Ha creado una receta!",
                                icon: "success"
                            }).then(function () {
                                // window.location = "/administration";
                            });
                        }

                        if (response.data.error) {
                            Swal({
                                title: '¡Error al crear la receta!',
                                icon: 'error',
                                confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            }).then(function () {
                                // window.location = "/administration";
                            });
                        }
                    }).catch(error => {
                        // console.error(error);
                    });
                this.name = '';
                this.price = '';
                this.ingredients = '';
                this.id_section = '';
            } else {
                Swal({
                    title: '¡Datos mal introducidos!',
                    text: 'Pruebe nuevamente',
                    icon: 'warning',
                    confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                })
            }

        },
        //funcion para borrar un comentario
        eliminarComentario(id) {
            axios.post(`/comentarios/${id}`, { _method: 'DELETE' })
                .then(response => {
                    // Resto del código
                    if (response.data.error) {
                        swal({
                            title: "!Ha borrado el comentario!",
                            icon: "success"
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }

                    if (!response.data.error) {
                        Swal({
                            title: '¡Error al borrar!',
                            icon: 'error',
                            confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }


                })
                .catch(error => {
                    console.error(error);
                });
        },
        //funcion para desactivar un comentario
        desactivarComentario(id) {
            axios.post(`/desactivarComentario/${id}`)
                .then(response => {
                    // console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        //funcion para borrar un plato del menu
        eliminarRecetas(id) {
            axios.delete(`/recetas/${id}`, { _method: 'DELETE' })
                .then(response => {
                    // console.log(response.data)
                    this.recetas = response.data.recetas;

                    if (response.data.error) {
                        swal({
                            title: "!Ha borrado la receta!",
                            icon: "success"
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }

                    if (!response.data.error) {
                        Swal({
                            title: '¡Error al borrar!',
                            icon: 'error',
                            confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        },
        //funcion para borrar una seccion del menu
        eliminarSecciones(id) {
            axios.delete(`/secciones/${id}`, { _method: 'DELETE' })
                .then(response => {
                    // console.log(response.data)
                    this.secciones = response.data.secciones;

                    if (response.data.error) {
                        swal({
                            title: "!Ha borrado la seccion!",
                            icon: "success"
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }

                    if (!response.data.error) {
                        Swal({
                            title: '¡Error al borrar!',
                            icon: 'error',
                            confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        },
        eliminarNoticia(id) {
            axios.delete(`/noticias/${id}`, { _method: 'DELETE' })
                .then(response => {
                    // console.log(response.data)
                    this.noticias = response.data.noticias;

                    if (response.data.error) {
                        swal({
                            title: "!Ha borrado la noticia!",
                            icon: "success"
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }

                    if (!response.data.error) {
                        Swal({
                            title: '¡Error al borrar la noticia!',
                            icon: 'error',
                            confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        },
        //Funcion muestra modal pasandole la seccion
        modal(seccion) {
            this.seccionModificada = Object.assign(this.seccionModificada, seccion)
            this.mostrarModal = true;
        },
        modalReceta(receta) {
            this.recetaModificada = Object.assign(this.recetaModificada, receta)
            this.mostrarModalReceta = true;
        },
        //cerrar modal
        cerrarModal() {
            this.mostrarModal = false;
            this.mostrarModalReceta = false;
        },
        //funcion para editar una seccion del menu
        editarSeccion(id) {
            const seccionMod = {
                title: this.seccionModificadatitle,
                subtitle: this.seccionModificadasubtitle,
                imagen: this.seccionModificadaimagen,
            };

            axios.post(`/seccionModificada/${id}`, seccionMod, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then(response => {
                    // window.location = '/administration';
                    if (!response.data.error) {
                        swal({
                            title: "!Ha editado la secccion!",
                            icon: "success"
                        }).then(function () {
                            window.location = "/administration";
                        });
                    }

                    if (response.data.error) {
                        Swal({
                            title: '¡Error al editar la seccion!',
                            icon: 'error',
                            confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });

            this.seccionModificadatitle = '';
            this.seccionModificadasubtitle = '';
            this.seccionModificadaimagen = '';
        },
        //funcion para editar una receta del menu
        editarReceta(id) {
            const recetaMod = {
                name: this.recetaModificadaname,
                ingredients: this.recetaModificadaingredients,
                price: this.recetaModificadaprice,
                id_section: this.recetaModificadaid_section
            };

            axios.post(`/recetaModificada/${id}`, recetaMod, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then(response => {
                    window.location = '/administration';
                    if (!response.data.error) {
                        swal({
                            title: "!Ha creado una receta!",
                            icon: "success"
                        }).then(function () {
                            window.location = "/administration";
                        });
                    }

                    if (response.data.error) {
                        Swal({
                            title: '¡Error al crear la receta!',
                            icon: 'error',
                            confirmButtonClass: 'bg-sweetalert-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                        }).then(function () {
                            // window.location = "/administration";
                        });
                    }

                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });

            this.recetaModificadaname = '';
            this.recetaModificadaingredients = '';
            this.recetaModificadaprice = '';
            this.recetaModificadaid_section = '';
        },
        //boton anterior de la paginacion tabla comentarios
        previousPageComentarios() {
            if (this.currentPageComentarios > 1) {
                this.currentPageComentarios--;
            }
        },
        //boton siguiente de la paginacion tabla comentarios
        nextPageComentarios() {
            if (this.currentPageComentarios < this.totalPages) {
                this.currentPageComentarios++;
            }
        },
        goToPageComentarios(pageNumber) {
            this.currentPageComentarios = pageNumber;
        },
        //boton anterior de la paginacion tabla noticias
        previousPageNoticias() {
            if (this.currentPageNoticias > 1) {
                this.currentPageNoticias--;
            }
        },
        //boton siguiente de la paginacion tabla noticias
        nextPageNoticias() {
            if (this.currentPageNoticias < this.totalPages) {
                this.currentPageNoticias++;
            }
        },
        goToPageNoticias(pageNumber) {
            this.currentPageNoticias = pageNumber;
        },
        //boton anterior de la paginacion tabla reservas
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        //boton siguiente de la paginacion tabla reservas
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        goToPage(pageNumber) {
            this.currentPage = pageNumber;
        },
        //boton anterior de la paginacion tabla secciones
        previousPageSecciones() {
            if (this.currentPageSecciones > 1) {
                this.currentPageSecciones--;
            }
        },
        //boton siguiente de la paginacion tabla secciones
        nextPageSecciones() {
            if (this.currentPageSecciones < this.totalPagesSecciones) {
                this.currentPageSecciones++;
            }
        },
        goToPageSecciones(pageNumber) {
            this.currentPageSecciones = pageNumber;
        },
        //boton anterior de la paginacion tabla recetas
        previousPageRecetas() {
            if (this.currentPageRecetas > 1) {
                this.currentPageRecetas--;
            }
        },
        //boton siguiente de la paginacion tabla recetas
        nextPageRecetas() {
            if (this.currentPageRecetas < this.totalPagesRecetas) {
                this.currentPageRecetas++;
            }
        },
        goToPageRecetas(pageNumber) {
            this.currentPageRecetas = pageNumber;
        },
        //format para mostrar la fecha de la tabla comentarios
        formatDate(dateTimeString) {
            return dateTimeString.slice(0, dateTimeString.indexOf('T'));
        }
    },

    computed: {
        //paginacion sobre la tabla de comentarios
        paginatedComentarios() {
            const startIndex = (this.currentPageComentarios - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.comentariosPersonas.slice(startIndex, endIndex);
        },
        //total de pagina 
        totalPages() {
            return Math.ceil(this.comentariosPersonas.length / this.itemsPerPage);
        },
        //paginacion sobre la tabla de reservas
        paginatedReservas() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.reservas.slice(startIndex, endIndex);
        },
        //total de pagina 
        totalPagesReservas() {
            return Math.ceil(this.reservas.length / this.itemsPerPage);
        },
        //paginacion sobre la tabla de secciones
        paginatedSecciones() {
            const startIndex = (this.currentPageSecciones - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.secciones.slice(startIndex, endIndex);
        },
        //total de pagina 
        totalPagesSecciones() {
            return Math.ceil(this.secciones.length / this.itemsPerPage);
        },
        //paginacion sobre la tabla de recetas
        paginatedRecetas() {
            const startIndex = (this.currentPageRecetas - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.recetas.slice(startIndex, endIndex);
        },
        //total de pagina 
        totalPagesRecetas() {
            return Math.ceil(this.recetas.length / this.itemsPerPage);
        },
        //paginacion sobre la tabla de noticias
        paginatedNoticias() {
            const startIndex = (this.currentPageNoticias - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.noticias.slice(startIndex, endIndex);
        },
        //total de noticias 
        totalPagesNoticias() {
            return Math.ceil(this.noticias.length / this.itemsPerPage);
        },
    },
    //funciones para mostrar los datos de la bbdd
    setup() {
        const comentariosPersonas = ref([]);
        const reservas = ref([]);
        const secciones = ref([]);
        const recetas = ref([]);
        const noticias = ref([]);

        //Muestra las valoraciones
        watchEffect(() => {
            axios.get('/opiniones')
                .then(response => {
                    comentariosPersonas.value = response.data;
                    // console.log(comentariosPersonas);
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });
        //Muestra las secciones
        watchEffect(() => {
            axios.get('/secciones')
                .then(response => {
                    secciones.value = response.data;
                    // console.log(secciones);
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });
        //Muestra las reservas
        watchEffect(() => {
            axios.get('/reserva')
                .then(response => {
                    reservas.value = response.data;
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });
        //Muestra las datos de las recetas
        watchEffect(() => {
            axios.get('/datosPlatos')
                .then(response => {
                    recetas.value = response.data;
                    // console.log(recetas);
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });
        //Muestra las noticias
        watchEffect(() => {
            axios.get('/noticias')
                .then(response => {
                    noticias.value = response.data;
                    // console.log(noticias);
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });

        return {
            reservas,
            comentariosPersonas,
            secciones,
            recetas,
            noticias
        }
    },
};

</script>

