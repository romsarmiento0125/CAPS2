import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    customerInfos: {},
    customerAddress: {},
    categoryItems: {},
    cartItems: {},
    cartQuantity: 0,
    totalPrice: 0,
    userAddress: false,
    userOrder: false,
    userPickUp: false,
    oCashierDeliver: true,
    oCashierPickup: false,
    customerItems: {},
  },
  mutations: {
    storeCustomerInfo: (state, payload) => {
      state.customerInfos = payload
    },
    storeCustomerAddress: (state, payload) => {
      state.customerAddress = payload
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
    },
    goToOrder: (state) => {
      state.userOrder = true;
    },
    toAddToOrderFalse: (state) => {
      state.userAddress = false;
      state.userOrder = false;
    },
    thisPickup: (state) => {
      state.userPickUp = true;
    },
    thisDeliver: (state) => {
      state.userPickUp = false;
    },
    oCashierDeliver: (state) => {
      state.oCashierDeliver = true;
      state.oCashierPickup = false;
    },
    oCashierPickup: (state) => {
      state.oCashierDeliver = false;
      state.oCashierPickup = true;
    },
    storeCustomerItems: (state, payload) => {
      state.customerItems = {};
      state.customerItems = payload
    },
    cleanCustomerItems: (state, payload) => {
      state.customerItems = {};
    },
  },
  actions: {
  },
  modules: {
  }
})
