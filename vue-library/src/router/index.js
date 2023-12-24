import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Book from '../views/Book.vue'
import Status from '../views/BookLoanStatus.vue'
import CreateBook from '../views/RegisterBook.vue'
import RegisterUser from  '../views/RegisterUser.vue'
import UpdateBookLoan from  '../views/StatusBookLoan.vue'
import ExtensionBookLoan from  '../views/ExtendedBookLoan.vue'
import Borrowed from '../views/BorrowedBooks.vue'
import Dashboard from '../views/AdminDashboard.vue'
import User from '../views/User.vue'
import Login from '../components/Login.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
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
    path: '/book',
    name: 'CreateBook',
    component: CreateBook
  },
 {
    path: '/user',
    name: 'RegisterUser',
    component: RegisterUser
  },
 {
    path: '/extension',
    name: 'ExtensionBookLoan',
    component: ExtensionBookLoan
  },
 {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard
  },
 {
    path: '/status',
    name: 'UpdateBookLoan',
    component: UpdateBookLoan
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
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
