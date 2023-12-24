<template>
  <ErrorToast :error="error" @close-error="closeError" />
  <SuccessToast :success="success" @close-success="closeSuccess" />

  <div class="">
    <div class="m-20 grid grid-cols-4 gap-4">
      <div class="col-span-1 p-4 bg-white shadow-md rounded-md">
        <h2 class="text-lg font-semibold mb-4">Users</h2>
        <p>Total number of users: {{ totalUsers }}</p>
      </div>
      <div class="col-span-1 p-4 bg-white shadow-md rounded-md">
        <h2 class="text-lg font-semibold mb-4">Book Loans</h2>
        <p>Total number of book borrowed: {{ borrowedBooks.length }}</p>
      </div>
      <div class="col-span-1 p-4 bg-white shadow-md rounded-md">
        <h2 class="text-lg font-semibold mb-4">Books</h2>
        <p>Total number of books: {{ totalBooks }}</p>
      </div>
      <div class="col-span-1 p-4 bg-white shadow-md rounded-md">
        <h2 class="text-lg font-semibold mb-4">Requested Books</h2>
        <p>Total number of book borrow requests: {{ requestedLoans.length }}</p>
      </div>
    </div>
  </div>

  <button
    type="submit"
    class="bg-gray-800 text-white px-4 py-2 mr-10 rounded float-right"
  >
    <router-link :to="{ name: 'RegisterUser' }">
      Register New User
    </router-link>
  </button>
  <button
    type="submit"
    class="bg-gray-800 text-white px-4 py-2 mr-10 rounded float-right"
  >
    <router-link :to="{ name: 'CreateBook' }"> Register New Book </router-link>
  </button>

  <div class="my-40">
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
</template>

<script>
import axios from 'axios'
import { getAllBookLoanRequest, getAllBooks } from '../client'
import BookCard from '@/components/BookCard.vue'
import ErrorToast from '@/components/ErrorToast.vue'
import SuccessToast from '@/components/SuccessToast.vue'

export default {
  data() {
    return {
      totalUsers: 0,
      totalBooks: 0,
      books: [],
      loans: [],
    }
  },

  components: {
    BookCard,
    ErrorToast,
    SuccessToast,
  },
  computed: {
    requestedLoans() {
      return this.loans.filter((loan) => loan.status === 'requested')
    },
    borrowedBooks() {
      return this.loans.filter((loan) => loan.status === 'borrowed')
    },
  },
  mounted() {
    this.fetchData()
    this.getBooks()
  },
  methods: {
    async fetchData() {
      try {
        const usersResponse = await axios.get('users')
        const booksResponse = await axios.get('loans')
        getAllBookLoanRequest().then((response) => {
          const loansArray = Object.values(response.message)
          if (Array.isArray(loansArray)) {
            this.loans = loansArray
          } else {
            console.error('Unexpected response format:', response)
          }
        })
        this.totalUsers = usersResponse.data.message.length
        this.totalBooks = booksResponse.data.message.length
      } catch (error) {
        console.error('Error fetching data:', error)
      }
    },
    getBooks() {
      getAllBooks()
        .then((response) => {
          this.books = response.message
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
