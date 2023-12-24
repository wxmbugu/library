<template>
  <ErrorToast :error="error" @close-error="closeError" />
  <SuccessToast :success="success" @close-success="closeSuccess" />

  <div class="max-w-sm mx-auto">
    <form @submit.prevent="submitForm" class="my-20">
      <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2"
          >Username:</label
        >

        <input
          v-model="form.name"
          type="text"
          id="name"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>

      <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2"
          >Email:</label
        >
        <input
          v-model="form.email"
          type="email"
          id="email"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>

      <div class="mb-4">
        <label for="isbn" class="block text-gray-700 text-sm font-bold mb-2"
          >Password</label
        >
        <input
          v-model="form.password"
          type="password"
          id="password"
          name="password"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>
      <div class="mb-4">
        <label for="isbn" class="block text-gray-700 text-sm font-bold mb-2"
          >Repeat Password</label
        >
        <input
          v-model="form.repeatpassword"
          type="password"
          id="repeatpassword"
          name="repeatpassword"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>

      <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">
        Submit
      </button>
    </form>
  </div>
</template>

<script>
import { registerUser } from '../client'

import ErrorToast from '@/components/ErrorToast.vue'
import SuccessToast from '@/components/SuccessToast.vue'

export default {
  components: {
    ErrorToast,
    SuccessToast,
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        repeatpassword: '',
      },
      error: null,
      success: null,
    }
  },
  methods: {
    async submitForm() {
      try {
        if (this.form.password !== this.form.repeatpassword) {
          this.error = 'Passwords do not match'
          return
        }
        const response = await registerUser(
          this.form.name,
          this.form.email,
          this.form.password,
        )
        this.success = response.message
        this.form = {
          name: '',
          email: '',
          password: '',
          repeatpassword: '',
        }
        console.log(response)
      } catch (error) {
        this.error = err.response.data.error
      }
    },
    closeError() {
      this.error = null
    },
    closeSuccess() {
      this.success = null
    },
  },
}
</script>
