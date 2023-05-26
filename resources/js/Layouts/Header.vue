<template>
  <div id="menu">
    <div class="bg-black">
      <nav class="
                      container
                      px-6
                      py-4
                      mx-auto                      
                      md:flex md:justify-center md:items-center
          
                    ">
        <div class="flex items-center justify-between">
          <NavLink href="/" :active="$page.component === 'Home'">
            <img src="../../img/nombre.png"
              class="container mr-10 md:flex md:justify-between md:items-center w-14 py-4" alt="logo">
          </NavLink>

          <!-- Mobile menu button -->
          <div @click="showMenu = !showMenu" class="flex md:hidden">
            <button type="button" class="
                            text-white
                            hover:text-gray-400
                            focus:outline-none focus:text-white
                          ">
              <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                <path fill-rule="evenodd"
                  d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                </path>
              </svg>
            </button>
          </div>
        </div>


        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <ul :class="showMenu ? 'flex' : 'hidden'" class="
                        flex-col
                        mt-8
                        space-y-4
                        md:flex
                        md:space-y-0
                        md:flex-row
                        md:items-center
                        md:space-x-4
                        md:mt-0
            
                      ">

          <li class="seccion">
            <NavLink class=" text-base max-[767px]:text-xl  max-[1024px]:text-xs font-semibold md:ml-2 font-cabin " href="/about"
              :active="$page.component === 'AboutUs'">Nosotros</NavLink>
          </li>
          <li class="seccion">
            <NavLink class=" text-base max-[767px]:text-xl  max-[1024px]:text-xs font-semibold md:ml-2 font-cabin " href="/menu"
              :active="$page.component === 'Location'">Menu</NavLink>
          </li>
          <li class="seccion">
            <NavLink class=" text-base max-[767px]:text-xl  max-[1024px]:text-xs font-semibold md:ml-2 font-cabin " href="/reservation"
              :active="$page.component === 'Reservation'">Reservas
            </NavLink>
          </li>
          <li class="seccion">
            <NavLink class=" text-base max-[767px]:text-xl  max-[1024px]:text-xs font-semibold md:ml-2 font-cabin " href="/location"
              :active="$page.component === 'Location'">Ubicación</NavLink>
          </li>
          <li class="seccion">
            <NavLink class=" text-base max-[767px]:text-xl  max-[1024px]:text-xs font-semibold md:ml-2 font-cabin " href="/blog"
              :active="$page.component === 'Blog'">Blog</NavLink>
          </li>
          <li class="seccion">
            <NavLink class=" text-base max-[767px]:text-xl  max-[1024px]:text-xs font-semibold md:ml-2 font-cabin " href="/opinion"
              :active="$page.component === 'Opinion'">Opinión</NavLink>
          </li>

          <li class="seccion" v-if="$page.props.auth.user && $page.props.auth.user.name === 'admin'">
            <NavLink class=" text-base max-[767px]:text-xl  max-[1024px]:text-xs font-semibold md:ml-2 font-cabin " href="/administration"
              :active="$page.component === 'Administration'">
              Administración</NavLink>
          </li>

          <li class="seccion  ml-2 hover:text-black" v-if="!$page.props.auth.user">
            <NavLink href="/login" :active="$page.component === 'Login'"
              class=" ml-4 text-base max-[767px]:text-xl  max-[1024px]:text-xs border-2 p-2 rounded-lg font-semibold">Login
            </NavLink>
          </li>
          <li class="seccion  hover:text-black">
            <NavLink href="/register" :active="$page.component === 'registrarse'" v-if="!$page.props.auth.user"
              class=" ml-2 max-[1024px]:text-base max-[767px]:text-xl border-2 p-2 rounded-lg">Registrarse</NavLink>
          </li>
          <li>
            <div class="relative float-right" v-if="$page.props.auth.user != null">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button type="button"
                      class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 ">
                      {{ $page.props.auth.user.name }}

                      <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd" />
                      </svg>
                    </button>
                  </span>
                </template>

                <template #content class="max-[767px]:left-0">
                  <!-- <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink> -->
                  <DropdownLink :href="route('logout')" method="post" as="button">
                    Log Out
                  </DropdownLink>
                </template>
              </Dropdown>
            </div>
          </li>
        </ul>
      </nav>
    </div>

  </div>
</template>

<style>
.seccion {
  @apply text-lg ml-4;
}
</style>

<script>

import { Link } from "@inertiajs/vue3";
import NavLink from "../Layouts/NavLink.vue";


export default {
  components: { NavLink, Link },
  data() {
    return {
      showMenu: false,
    };
  },
};

</script>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

</script>

