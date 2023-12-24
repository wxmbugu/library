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
    component: Status,
    meta: { requiresAuth: true },
  },
  {
    path: '/borrowed',
    name: 'Borrowed',
    component: Borrowed,
    meta: { requiresAuth: true },

  },
 {
    path: '/book',
    name: 'CreateBook',
    component: CreateBook,
    meta: { requiresAuth: true },

  },
 {
    path: '/user',
    name: 'RegisterUser',
    component: RegisterUser,
    meta: { requiresAuth: true },
  },
 {
    path: '/extension',
    name: 'ExtensionBookLoan',
    component: ExtensionBookLoan,
     meta: { requiresAuth: true },

  },
 {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    meta: { requiresAuth: true },
  },
 {
    path: '/status',
    name: 'UpdateBookLoan',
    component: UpdateBookLoan,
    meta: { requiresAuth: true },
  },
  {
    path: '/books/:id',
    name: 'Book',
    component: Book, 
    meta: { requiresAuth: true },
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
