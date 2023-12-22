<script setup>
import { RouterView } from 'vue-router'
import navbar from './components/Navbar.vue'
</script>

<template>
  <navbar />
  <RouterView />
</template>
<script>
// import axios from 'axios'
import navbar from './components/Navbar.vue'
export default {
  components: { navbar },
  created() {
    const loggedIn = localStorage.getItem('user')
    if (loggedIn) {
      const userData = JSON.parse(loggedIn)
      console.log('Ok', userData.access_token)
      this.$store.commit('SET_USER_DATA', userData)
    }
    axios.interceptors.response.use(
      (response) => response,
      (error) => {
        if (error.response.status === 401) {
          this.$store.dispatch('logout')
        }
        return Promise.reject(error)
      },
    )
  },
}
</script>
