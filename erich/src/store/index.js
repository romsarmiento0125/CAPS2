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
    userProfileOrders: {},
    userProfileOrderItems: {},
    userAllOrders: {},
    userAllOrdersItems: {},
  },
  mutations: {
    //Views Login.vue
    storeCustomerInfo: (state, payload) => {
      state.customerInfos = payload
    },
    //Views Login.vue
    storeCustomerAddress: (state, payload) => {
      state.customerAddress = payload
    },
    //Components HomeItems CategoriesItem.vue
    //Components HomeItems HomeCategoriesItem.vue
    storeCategoryItem: (state, payload) => {
      state.categoryItems = payload
    },
    //Components HomeItems CategoriesItem.vue
    //Components HomeItems HomeCategoriesItem.vue
    storeCartItems: (state, payload) => {
      state.cartItems = {};
      state.cartItems = payload
    },
    //Components HomeItems CategoriesItem.vue
    //Components HomeItems HomeCategoriesItem.vue
    storeCartQuantity: (state, payload) => {
      state.cartQuantity = payload
    },
    //Components ShoppingCart DeliveryMethod MethodDelivery.vue
    //Components Home HomeHeaderAccount.vue
    goToAddress: (state) => {
      state.userAddress = true;
    },
    //Components Home HomeHeaderAccount.vue
    goToOrder: (state) => {
      state.userOrder = true;
    },
    //Views UserProfile.vue
    toAddToOrderFalse: (state) => {
      state.userAddress = false;
      state.userOrder = false;
    },
    //Components ShoppingCart ShopCartPlaceOrder.vue
    thisPickup: (state) => {
      state.userPickUp = true;
    },
    //Components ShoppingCart ShopCartPlaceOrder.vue
    thisDeliver: (state) => {
      state.userPickUp = false;
    },
    //Components OnlineCashier OCDeliveryToPack.vue
    //Components OnlineCashier OCPickupToPack.vue
    oCashierDeliver: (state) => {
      state.oCashierDeliver = true;
      state.oCashierPickup = false;
    },
    //Components OnlineCashier OCDeliveryToPack.vue
    //Components OnlineCashier OCPickupToPack.vue
    oCashierPickup: (state) => {
      state.oCashierDeliver = false;
      state.oCashierPickup = true;
    },
    //Components ShoppingCart ShopCartPlaceOrderItems.vue
    storeCustomerItems: (state, payload) => {
      state.customerItems = {};
      state.customerItems = payload
    },
    //Components ShoppingCart ShopCartDelivery.vue
    cleanCustomerItems: (state) => {
      state.customerItems = {};
    },
    //Views UserProfile.vue
    //Views Home.vue
    storeUserProfileOrders: (state, payload) => {
      state.userProfileOrders = {};
      state.userProfileOrders = payload;
    },
    //Views UserProfile.vue
    //Views Home.vue
    storeUserProfileOrderItems: (state, payload) => {
      state.userProfileOrderItems = {};
      state.userProfileOrderItems = payload;
    },
    //Views OnlineCashier.vue
    storeUserAllOrders: (state, payload) => {
      state.userAllOrders = {};
      state.userAllOrders = payload;
    },
    //Views OnlineCashier.vue
    storeUserAllOrdersItems: (state, payload) => {
      state.userAllOrdersItems = {};
      state.userAllOrdersItems = payload;
    }
  },
  actions: {
  },
  modules: {
  }
})
