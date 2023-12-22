<template>
  <div class="mx-20">
    <div class="grid grid-cols-3 gap-4 content-center">
      <div class="...">01</div>
      <div class="...">02</div>
      <div class="...">03</div>
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
