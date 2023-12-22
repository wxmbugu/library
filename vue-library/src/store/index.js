import { createStore } from 'vuex'
import axios from 'axios'

export default createStore({
  state: {
    user:null,
  },
  mutations: {
    SET_USER_DATA (state,userData){
      state.user = userData
      localStorage.setItem('user',JSON.stringify(userData))
      axios.defaults.headers.common['Authorization'] = `Bearer ${userData.access_token}`
    },
    CLEAR_USER_DATA(){
      localStorage.removeItem('user')
      location.reload()
    }
  },
  actions: {
    login({commit},credentials){
      return axios
              .post('//127.0.0.1:8000/api/auth/login/',credentials)
              .then(({data})=>{
                commit('SET_USER_DATA',data)
                console.log(data)
              })
    },
    logout({commit}){
      commit('CLEAR_USER_DATA')
    }
  },
  modules: {
  }
})
