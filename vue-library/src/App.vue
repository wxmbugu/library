<script setup>
import { RouterView } from 'vue-router'
import navbar from './components/Navbar.vue'
import axios from 'axios'
</script>

<template>
  <navbar v-if="!['Login'].includes($route.name)" />
  <RouterView />
</template>

<script>
export default {
  components: { navbar },
  data() {
    return {
      isRefreshing: false,
    }
  },
  created() {
    const loggedIn = localStorage.getItem('user')
    if (loggedIn) {
      const userData = JSON.parse(loggedIn)
      this.$store.commit('SET_USER_DATA', userData)
    }

    setInterval(
      () => {
        if (!this.isRefreshing) {
          this.refreshToken()
        }
      },
      50 * 60 * 1000,
    )

    axios.interceptors.response.use(
      (response) => response,
      async (error) => {
        if (error.response.status === 401) {
          this.$router.push({ name: 'Login' })
        }
        return Promise.reject(error)
      },
    )
  },

  methods: {
    async refreshToken() {
      try {
        this.isRefreshing = true
        const refresh_response = await axios.post(
          '//127.0.0.1:8000/api/auth/refresh/',
        )
        this.$store.commit('SET_USER_DATA', refresh_response.data)
      } catch (error) {
        this.$router.push({ name: 'Login' })
      } finally {
        this.isRefreshing = false
      }
    },
  },
}
</script>
