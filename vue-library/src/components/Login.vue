/* eslint-disable vue/valid-template-root */
<template>
  <div class="max-w-xs w-full m-auto bg-indigo-100 rounded p-5">
    <header>
      <img
        class="w-20 mx-auto mb-5"
        src="https://img.icons8.com/ultraviolet/240/000000/rebel.png"
      />
    </header>
    <form @submit.prevent="login">
      <div>
        <label class="block mb-2 text-indigo-500">Username</label>
        <input
          v-model="Username"
          class="w-full p-2 mb-6 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-300"
          type="text"
          name="username"
        />
      </div>
      <div>
        <label class="block mb-2 text-indigo-500">Password</label>
        <input
          v-model="Password"
          class="w-full p-2 mb-6 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-300"
          type="password"
          name="password"
        />
      </div>
      <div>
        <button
          class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded"
          type="submit"
        >
          Login
        </button>
        <p class="text-red-700">{{ error }}</p>
      </div>
    </form>
    <footer>
      <a class="text-indigo-700 hover:text-pink-700 text-sm float-left" href="#"
        >Forgot Password?</a
      >
      <router-link
        :to="{ name: 'Register' }"
        class="text-indigo-700 hover:text-pink-700 text-sm float-right"
        href="#"
        >Create Account</router-link
      >
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      Username: '',
      Password: '',
      error: null,
    }
  },
  methods: {
    login() {
      this.$store
        .dispatch('login', {
          email: this.Username,
          password: this.Password,
        })
        .then(() => {
          this.$router.push({ name: 'Home' })
        })
        .catch((err) => {
          this.error = err.response.data.error
        })
    },
  },
}
</script>
