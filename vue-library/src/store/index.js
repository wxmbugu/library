import { createStore } from 'vuex';
import axios from 'axios';


const TOKEN_REFRESH_INTERVAL = 1; 

const startTokenRefresh = async (commit) => {
  try {
    const refresh_response = await axios.post('https://library-laravel.fly.dev/api/auth/refresh/');
    commit('SET_USER_DATA', refresh_response.data);
  } catch (error) {
    console.error('Error refreshing token:', error);
    commit('CLEAR_USER_DATA');
  }
};

export default createStore({
  state: {
    user: null,
  },
  mutations: {
    SET_USER_DATA(state, userData) {
      state.user = userData;
      localStorage.setItem('user', JSON.stringify(userData));
      axios.defaults.headers.common['Authorization'] = `Bearer ${userData.access_token}`;
    },
    CLEAR_USER_DATA() {
      localStorage.removeItem('user');
      location.reload();
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('https://library-laravel.fly.dev/api/auth/login/', credentials);
        commit('SET_USER_DATA', response.data);
        return response.data;
      } catch (error) {
        throw error;
      }
    },
    logout({ commit }) {
      commit('CLEAR_USER_DATA');
    },
  },
  modules: {},
});

