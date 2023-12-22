<template>
  <div class="home">
    <div class="bg-white">
      <div class="px-4 flex-grow w-full py-4 sm:py-16 mx-auto">
        <h1
          class="text-center text-3xl mb-4 uppercase bg-white text-gray-700 mx-auto px-2"
        >
          Book Catalogue
        </h1>
        <div class="mx-auto w-full md:w-4/5 px-4">
          <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div
                v-for="book in books"
                :key="book.id"
                class="flex-none h-360 items-stretch pb-4 border rounded-lg"
              >
                <router-link
                  v-if="this.$store.state.user"
                  :to="{ name: 'Book', params: { id: book.id } }"
                >
                  <BookCard :book="book" />
                </router-link>
                <div v-else>
                  <BookCard :book="book" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { getAllBooks } from '../client'
import BookCard from '@/components/BookCard.vue'
export default {
  components: {
    BookCard,
  },
  name: 'Home',
  data() {
    return {
      books: [],
      error: '',
    }
  },
  mounted() {
    this.getBooks()
  },
  methods: {
    getBooks() {
      getAllBooks()
        .then((response) => {
          this.books = response.message
        })
        .catch((err) => {
          this.error = err.response.data.error
        })
    },
  },
}
</script>
