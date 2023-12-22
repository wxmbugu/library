import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Cart from '../views/Cart.vue'
import Course from '../views/Course.vue'
import Instructor from '../views/Instructor.vue'
import MyLearning from '../views/MyLearning.vue'
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
    path: '/mylearning',
    name: 'MyLearning',
    component: MyLearning
  },
  {
    path: '/user/:username',
    name: 'User',
    component: User
  },
  {
    path: '/instructor-dashboard',
    name: 'Instructor',
    component: Instructor
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
