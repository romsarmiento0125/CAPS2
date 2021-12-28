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
    userAllOrdersCons: {},
    userAllOrders: {},
    ocDeliverToPack: true,
    ocDeliverToDelivery: false,
    ocDeliverToComplete: false,
    ocDeliverToReturn: false,
    ocDeliverToCancel: false,
    userAllDeliver: {},
    userAllComplete: {},
    pickupDate: "",
    pickupTime: "",
    ocPickupToPack: true,
    ocPickupToPick: false,
    ocPickupToComplete: false,
    ocPickupToCancel: false,
    userPickupOrders: {},
    userPickupOrdersCons: {},
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
      state.userAllOrdersCons = {};
      state.userAllOrdersCons = payload;
      state.userAllOrders = payload;
    },
    //Components OnlineCashier OCDeliveryToPack.vue
    filterAllOrdersItems: (state, payload) => {
      let result = state.userAllOrdersCons.filter(res => res.Status == payload);
      state.userAllOrders = result;
      // console.log(state.userAllOrders);
      // console.log(state.userAllOrdersCons);
    },
    //Components OnlineCashier OCDeliveryToPack.vue
    showAllOrdersItems: (state) => {
      state.userAllOrders = {};
      state.userAllOrders = state.userAllOrdersCons;
    },
    //Components OnlineCashier OCDelivery.vue
    ocDeliverToPack: (state) => {
      state.ocDeliverToPack = true;
      state.ocDeliverToDelivery = false;
      state.ocDeliverToComplete = false;
      state.ocDeliverToReturn = false;
      state.ocDeliverToCancel = false;
    },
    //Components OnlineCashier OCDelivery.vue
    ocDeliverToDeliver: (state) => {
      state.ocDeliverToPack = false;
      state.ocDeliverToDelivery = true;
      state.ocDeliverToComplete = false;
      state.ocDeliverToReturn = false;
      state.ocDeliverToCancel = false;
    },
    //Components OnlineCashier OCDelivery.vue
    ocDeliverToComplete: (state) => {
      state.ocDeliverToPack = false;
      state.ocDeliverToDelivery = false;
      state.ocDeliverToComplete = true;
      state.ocDeliverToReturn = false;
      state.ocDeliverToCancel = false;
    },
    //Components OnlineCashier OCDelivery.vue
    ocDeliverToReturn: (state) => {
      state.ocDeliverToPack = false;
      state.ocDeliverToDelivery = false;
      state.ocDeliverToComplete = false;
      state.ocDeliverToReturn = true;
      state.ocDeliverToCancel = false;
    },
    //Components OnlineCashier OCDelivery.vue
    ocDeliverToCancel: (state) => {
      state.ocDeliverToPack = false;
      state.ocDeliverToDelivery = false;
      state.ocDeliverToComplete = false;
      state.ocDeliverToReturn = false;
      state.ocDeliverToCancel = true;
    },
    //Components OnlineCashier Delivery OCDeliveryToDeliver.vue
    storeUserAllDeliver: (state, payload) => {
      state.userAllDeliver = {},
      state.userAllDeliver = payload;
    },
    //Components OnlineCashier Delivery OCDeliveryToComplete.vue
    storeUserAllComplete: (state, payload) => {
      state.userAllComplete = {},
      state.userAllComplete = payload;
    },
    //Components ShoppingCart DeliveryMethod MethodPickup.vue
    pickupDate: (state, payload) => {
      state.pickupDate = {},
      state.pickupDate = payload;
    },
    //Components ShoppingCart DeliveryMethod MethodPickup.vue
    pickupTime: (state, payload) => {
      state.pickupTime = {},
      state.pickupTime = payload;
    },
    //Components OnlineCashier OCPickup.vue
    ocPickupToPack: (state) => {
      state.ocPickupToPack = true;
      state.ocPickupToPick = false;
      state.ocPickupToComplete = false;
      state.ocPickupToCancel = false;
    },
    //Components OnlineCashier OCPickup.vue
    ocPickupToDeliver: (state) => {
      state.ocPickupToPack = false;
      state.ocPickupToPick = true;
      state.ocPickupToComplete = false;
      state.ocPickupToCancel = false;
    },
    //Components OnlineCashier OCPickup.vue
    ocPickupToComplete: (state) => {
      state.ocPickupToPack = false;
      state.ocPickupToPick = false;
      state.ocPickupToComplete = true;
      state.ocPickupToCancel = false;
    },
    //Components OnlineCashier OCPickup.vue
    ocPickupToCancel: (state) => {
      state.ocPickupToPack = false;
      state.ocPickupToPick = false;
      state.ocPickupToComplete = false;
      state.ocPickupToCancel = true;
    },
    //Views OnlineCashier.vue
    storeUserPickupOrders: (state, payload) => {
      state.userPickupOrders = {};
      state.userPickupOrdersCons = {};
      state.userPickupOrdersCons = payload;
      state.userPickupOrders = payload;
    },
  },
  actions: {
  },
  modules: {
  }
})
