<template>
  <div class="home">
    <div class="bg-white">
      <div class="px-4 flex-grow w-full py-4 sm:py-16 mx-auto">
        <h1 class="text-center text-3xl mb-4 uppercase bg-white text-gray-700 mx-auto px-2">
          Book Catalogue
        </h1>
        <div class="mx-auto w-full md:w-4/5 px-4">
          <div class="container">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-3xl font-medium">
                <a href="#" class=""><span class="text-salmon font-medium text-lg ml-2 hover:underline">See all
                  </span></a>
              </h2>
              <div>
                <button class="cursor-pointer text-xl mx-1 text-indigo-600 font-bold"></button>
                <button class="cursor-pointer text-xl mx-1 text-indigo-600 font-bold"></button>
              </div>
            </div>
            <div id="scrollContainer"
              class="flex flex-no-wrap overflow-x-scroll overflow-x-hidden scrolling-touch no-scrollbar items-stretch mb-4">
              <div v-for="book in books" :key="book.id"
                class="flex-none w-24 md:w-1/3 mr-4 h-360 items-stretch md:pb-4 border rounded-lg">
                <div>
                  <a href="#" class="space-y-4">
                    <div class="aspect-w-16 aspect-h-9">
                      <img class="object-contain shadow-md hover:shadow-xl rounded-lg h-60 w-full" v-bind:src="book.image"
                        alt="" />
                    </div>
                    <div class="px-4 py-2">
                      <div class="text-lg leading-6 font-medium space-y-1">
                        <button
                          class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded float-right"
                          @click="Enroll(course.name)">
                          Borrow
                        </button>

                        <h3 class="font-bold text-gray-800 text-1xl mb-2">
                          {{ book.name }}
                        </h3>
                        <h2 class="py-2 uppercase tracking-widest text-xs">
                          {{ book.category }}
                        </h2>
                      </div>
                      <div class="text-md">
                        <p class="">
                          {{ book.description }}
                        </p>
                      </div>
                    </div>
                  </a>
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
// @ is an alias to /src
import { getAllBooks, enroll } from '../client'
export default {
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
          console.log('Success', response)

          this.books = response.message
          setTimeout(() => (this.successmessage = ''), 5000)
          this.getcourse(this.id)
        })
        .catch((err) => {
          this.error = err.response.data.error
          setTimeout(() => (this.error = ''), 5000)
        })
    },
    Enroll(coursetitle) {
      username
      const user = localStorage.getItem('user')
      var entry = JSON.parse(user)
      var username = entry.user.Username
      console.log('mzee', entry.user.Username)
      console.log('wee', username)
      enroll(coursetitle, username)
        .then((response) => {
          console.log('success', response)
        })
        .catch((err) => {
          console.log(err)
        })
    },
  },
}
</script>
