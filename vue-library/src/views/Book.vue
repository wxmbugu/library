<template>
  <div>
    <ErrorToast :error="error" @close-error="closeError" />
    <SuccessToast :success="success" @close-success="closeSuccess" />

    <div class="mx-20 pt-20">
      <div class="grid grid-cols-3 gap-4 place-content-stretch">
        <div class="">
          <div class="aspect-w-16 aspect-h-9">
            <img
              class="object-contain shadow-md hover:shadow-xl rounded-lg h-60 h-full"
              v-bind:src="book.image"
              alt=""
            />
          </div>
        </div>
        <div class="col-span-2">
          <div class="py-10">
            <div class="font-bold text-xl mb-2">Title: {{ book.name }}</div>
            <div class="font-bold font-light text-xl mb-2">
              Publisher: {{ book.publisher }}
            </div>
            <div class="font-bold font-light text-xl mb-2">
              isbn: {{ book.isbn }}
            </div>
            <div class="font-bold font-light text-xl mb-2">
              pages: {{ book.pages }}
            </div>
          </div>
          <button
            class="bg-transparent px-2 text-blue-700 font-semibold border border-gray-500 rounded"
          >
            {{ book.category }}
          </button>
          <button
            class="bg-transparent px-2 mb-2 mx-2 text-[#f43f5e] font-semibold border border-gray-500 rounded"
          >
            {{ book.sub_category }}
          </button>
          <div class="w-1/2 rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2">Description</div>
              <p class="text-gray-700 text-base">
                {{ book.description }}
              </p>
            </div>
          </div>
          <button
            class="bg-transparent hover:bg-blue-500 mt-20 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
            @click="borrowBook(book.id)"
          >
            Borrow
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { getBook, borrowBook } from '../client'
import ErrorToast from '@/components/ErrorToast.vue'
import SuccessToast from '@/components/SuccessToast.vue'

export default {
  components: {
    ErrorToast,
    SuccessToast,
  },
  data() {
    return {
      bookid: this.$route.params.id,
      book: '',
      error: null,
      success: null,
    }
  },
  mounted() {
    this.getbook()
  },
  methods: {
    getbook(id) {
      id = this.bookid
      getBook(id)
        .then((response) => {
          this.book = response
          console.log(this.book)
        })
        .catch((err) => {
          console.log(err)
        })
    },
    borrowBook(id) {
      borrowBook(id)
        .then((response) => {
          this.success = response.message
          console.log('log', this.book, response.message, response)
        })
        .catch((err) => {
          this.error = err.response.data.error
        })
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
