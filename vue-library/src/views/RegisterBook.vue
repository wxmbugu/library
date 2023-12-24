<template>
  <ErrorToast :error="error" @close-error="closeError" />
  <SuccessToast :success="success" @close-success="closeSuccess" />

  <div class="max-w-sm mx-auto">
    <form @submit.prevent="submitForm" class="my-20">
      <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2"
          >Name:</label
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
        <label
          for="description"
          class="block text-gray-700 text-sm font-bold mb-2"
          >Description:</label
        >
        <textarea
          v-model="form.description"
          id="description"
          rows="4"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Enter book description..."
          required
        ></textarea>
      </div>

      <div class="mb-4">
        <label
          for="publisher"
          class="block text-gray-700 text-sm font-bold mb-2"
          >Publisher:</label
        >
        <input
          v-model="form.publisher"
          type="text"
          id="publisher"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>

      <div class="mb-4">
        <label for="isbn" class="block text-gray-700 text-sm font-bold mb-2"
          >ISBN:</label
        >
        <input
          v-model="form.isbn"
          type="text"
          id="isbn"
          name="isbn"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>

      <div class="mb-4">
        <label for="pages" class="block text-gray-700 text-sm font-bold mb-2"
          >Pages:</label
        >
        <input
          v-model="form.pages"
          type="number"
          id="pages"
          name="pages"
          min="1"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>

      <div class="mb-4">
        <label for="category" class="block text-gray-700 text-sm font-bold mb-2"
          >Category:</label
        >
        <input
          v-model="form.category"
          type="text"
          id="category"
          name="category"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>

      <div class="mb-4">
        <label
          for="sub_category"
          class="block text-gray-700 text-sm font-bold mb-2"
          >Sub-Category:</label
        >
        <input
          v-model="form.sub_category"
          type="text"
          id="sub_category"
          name="sub_category"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          required
        />
      </div>

      <div class="mb-4">
        <label for="file" class="block text-gray-700 text-sm font-bold mb-2"
          >File:</label
        >
        <input
          @change="handleFileChange"
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          aria-describedby="user_avatar_help"
          id="user_avatar"
          type="file"
          required
        />
        <p class="text-sm text-gray-600">
          Maximum file size: 20MB. Allowed types: jpeg, jpg, png, webp.
        </p>
      </div>

      <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">
        Submit
      </button>
    </form>
  </div>
</template>

<script>
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
        description: '',
        publisher: '',
        isbn: '',
        pages: '',
        category: '',
        sub_category: '',
        file: null,
      },
      error: null,
      success: null,
    }
  },
  methods: {
    handleFileChange(event) {
      this.form.file = event.target.files[0]
    },
    async submitForm() {
      try {
        const formData = new FormData()
        formData.append('name', this.form.name)
        formData.append('description', this.form.description)
        formData.append('publisher', this.form.publisher)
        formData.append('isbn', this.form.isbn)
        formData.append('pages', this.form.pages)
        formData.append('category', this.form.category)
        formData.append('sub_category', this.form.sub_category)
        formData.append('file', this.form.file)
        const response = await axios({
          method: 'post',
          url: 'books',
          data: formData,
          headers: {
            ...axios.defaults.headers,
            'Content-Type': 'multipart/form-data',
          },
        })
        this.success = response.data.message
        console.log(this.success, response.data.message)
        this.form = {
          name: '',
          description: '',
          publisher: '',
          isbn: '',
          pages: '',
          category: '',
          sub_category: '',
          file: null,
        }
      } catch (error) {
        this.error = error.response.data.error
        console.error('Error submitting form:', error)
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
