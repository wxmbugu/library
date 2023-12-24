import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import './index.css'
import store from './store'
const app = createApp(App)

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!store.state.user) {
      next({ name: 'Login' });
    } else {
      next();
    }
  } else {
    next();
  }
});

app.use(router)
app.use(store)
app.mount('#app')


