import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    customerInfos: {},
    categoryItems: {},
    cartItems: {},
    cartQuantity: 0,
    totalPrice: 0,
    userAddress: false,
  },
  mutations: {
    storeCustomerInfo: (state, payload) => {
      state.customerInfos = payload
    },
    storeCategoryItem: (state, payload) => {
      state.categoryItems = payload
    },
    storeCartItems: (state, payload) => {
      state.cartItems = {};
      state.cartItems = payload
    },
    storeCartQuantity: (state, payload) => {
      state.cartQuantity = payload
    },
    goToAddress: (state) => {
      state.userAddress = true;
    }
  },
  actions: {
  },
  modules: {
  }
})
