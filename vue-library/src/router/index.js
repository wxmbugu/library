import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Cart from '../views/Cart.vue'
import Course from '../views/Course.vue'
import Book from '../views/Book.vue'
import Status from '../views/BookLoanStatus.vue'
import Borrowed from '../views/BorrowedBooks.vue'
import User from '../views/User.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/cart',
    name: 'Cart',
    component: Cart
  },
  {
    path: '/course',
    name: 'Course',
    component: Course
  },
  {
    path: '/requests',
    name: 'Requests',
    component: Status
  },
  {
    path: '/borrowed',
    name: 'Borrowed',
    component: Borrowed
  },
  {
    path: '/user/:username',
    name: 'User',
    component: User
  },
  {
    path: '/books/:id',
    name: 'Book',
    component: Book
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/sign-up',
    name: 'Register',
    component: Register
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
