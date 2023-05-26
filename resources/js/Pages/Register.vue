<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "../Layouts/NavLink.vue";

export default {
    components: { NavLink, Link },
    data() {
        return {
            showMenu: false,
            estado: true
        }
    },
    methods: {
        cambiaEstadoLogin() {
            this.estado = true
        },
        cambiaEstadoRegistro() {
            this.estado = false
        }
    }
}

</script>

<template>
    <div id="fondoLogin" class="bg-cover bg-center">

        <Layout>
            <div class="flex justify-center">
                <button
                    class="boton"
                    @click="cambiaEstadoLogin">Login</button>
                <button
                    class="boton"
                    @click="cambiaEstadoRegistro">Register</button>
            </div>

            <div id="inicioSesion" class="flex justify-center m-2" v-if="estado">
                <form class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="labels" for="email">
                                Email
                            </label>
                            <input
                                class="inputs"
                                id="email" type="text" placeholder="example@gmail.com">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="labels" for="Password">
                                Password
                            </label>
                            <input
                                class="inputs"
                                id="Password" type="password" placeholder="********">
                        </div>
                    </div>

                    <div class="flex justify-center items-center text-center p-2.5">
                        <button class="bg-white text-blue-500 border-2 border-black rounded px-10 py-2">Login</button>
                    </div>
                </form>
            </div>

            <div id="registro" class="flex justify-center m-2" v-if="estado == false">
                <form class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="labels"
                                for="grid-first-name">
                                First Name
                            </label>
                            <input
                                class="inputs"
                                id="grid-first-name" type="text" placeholder="Jane">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="labels"
                                for="grid-last-name">
                                Last Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-black border border-black rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Doe">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="labels"
                                for="grid-password">
                                Email
                            </label>
                            <input
                                class="inputs"
                                id="grid-password" type="text" placeholder="example@gmail.com">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="labels"
                                for="grid-password">
                                Phone Number
                            </label>
                            <input
                                class="inputs"
                                id="grid-password" type="text" placeholder="9956633254">
                        </div>
                    </div>
                    <div class="flex justify-center items-center p-2.5">
                        <button class="bg-white text-blue-500 border-black border-2 rounded px-10 py-2">Register</button>
                        <NavLink class="text-black ml-20 underline" href="/recoverPassword">
                            <p class="text-black  text-xl ">
                                Recover Password
                            </p>
                        </NavLink>


                    </div>
                </form>
            </div>
        </Layout>
    </div>
</template>


<style scoped>
#fondoLogin {
    background-image: url(../../img/fondoLogin.png);

}

.boton{
    @apply mt-14 mb-8 mr-8 text-2xl overflow-hidden shadow-lg border-black bg-slate-200 text-center focus:bg-stone-500 focus:text-black text-black border-2 font-bold py-2 px-4 rounded;
}

.labels{
    @apply block uppercase tracking-wide text-black text-xs font-bold mb-2;
}

.inputs{
    @apply appearance-none block w-full bg-gray-200 text-black border border-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
}
</style>
