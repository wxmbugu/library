/* eslint-disable vue/valid-template-root */
<template>
  <nav>
    <!-- desktop menu -->
    <div class="bg-gray-900">
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
          <!-- Menu -->
          <div class="flex space-x-4">
            <!--Logo -->

            <a
              v-if="this.$store.state.user"
              class="flex items-center space-x-2 py-5 px-2"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                /></svg
              ><router-link
                v-if="this.$store.state.user.user.id !== 1"
                :to="{ name: 'Home' }"
                class="text-2xl font-extrabold text-white"
                >Library</router-link
              >
              <router-link
                v-if="this.$store.state.user.user.id === 1"
                :to="{ name: 'Dashboard' }"
                class="text-2xl font-extrabold text-white"
                >Library</router-link
              >
            </a>
            <a v-else class="flex items-center space-x-2 py-5 px-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                /></svg
              ><router-link
                :to="{ name: 'Home' }"
                class="text-2xl font-extrabold text-white"
                >Library</router-link
              >
            </a>

            <!--Menu -->
            <div
              v-if="this.$store.state.user"
              class="hidden md:flex items-center space-x-1"
            >
              <!-- Requests link -->
              <p
                v-if="this.$store.state.user.user.id !== 1"
                class="py-5 px-2 text-white hover:text-indigo-200"
              >
                <router-link :to="{ name: 'Requests' }">Requests</router-link>
              </p>

              <!-- Borrowed link -->
              <p
                v-if="this.$store.state.user.user.id !== 1"
                class="py-5 px-2 text-white hover:text-indigo-200"
              >
                <router-link :to="{ name: 'Borrowed' }">Borrowed</router-link>
              </p>
              <p
                v-if="this.$store.state.user.user.id === 1"
                class="py-5 px-2 text-white hover:text-indigo-200"
              >
                <router-link :to="{ name: 'ExtensionBookLoan' }"
                  >Book Loan Extension</router-link
                >
              </p>
              <p
                v-if="this.$store.state.user.user.id === 1"
                class="py-5 px-2 text-white hover:text-indigo-200"
              >
                <router-link :to="{ name: 'UpdateBookLoan' }"
                  >Book Loan</router-link
                >
              </p>
            </div>
          </div>
          <!-- Login -->
          <div
            v-if="!this.$store.state.user"
            class="hidden md:flex items-center space-x-1"
          >
            <router-link
              :to="{ name: 'Login' }"
              class="py-5 px-2 text-white hover:text-indigo-200"
              >Login</router-link
            >
          </div>
          <div v-else>
            <Pmenu class="py-6 float-right"></Pmenu>
          </div>
          <!-- Show Mobile menu -->
          <div class="md:hidden flex items-center">
            <button @click="showmobilemenu = !showmobilemenu" class="py-5 px-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-indigo-100"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h7"
                />
              </svg>
            </button>
          </div>
          <div class="md:hidden flex items-center">
            <button @click="showmobilemenu = !showmobilemenu" class="py-5 px-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-indigo-100"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h7"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- mobile menu -->
    <div class="md:hidden bg-gray-900" :class="{ hidden: showmobilemenu }">
      <a class="block py-2 px-4 text-white hover:text-indigo-200">Categories</a>
    </div>

    <div class="md:hidden flex"></div>
  </nav>
</template>

<script>
import Pmenu from './Menu.vue'
export default {
  components: { Pmenu },

  methods: {
    logout() {
      store.dispatch('logout')
    },
  },
}
</script>
