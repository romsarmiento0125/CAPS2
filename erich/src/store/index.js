import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    customerInfos: {},
    categoryItems: {},
  },
  mutations: {
    storeCustomerInfo: (state, payload) => {
      state.customerInfos = payload
    },
    storeCategoryItem: (state, payload) => {
      state.categoryItems = payload
    },
  },
  actions: {
  },
  modules: {
  }
})
