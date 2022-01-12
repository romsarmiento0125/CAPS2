import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Signup from '../views/Signup.vue'
import AdminPage from '../views/AdminPage.vue'
import ShoppingCart from '../views/ShoppingCart.vue'
import StoreOrders from '../views/StoreOrders.vue'
import HomeItems from '../views/HomeItems.vue'
import Profiles from '../views/UserProfile.vue'
import OnlineCashier from '../views/OnlineCashier.vue'
import PhysicalCashier from '../views/PhysicalCashier.vue'
import MiscFunctions from '../views/MiscFunction.vue'
import About from '../views/About.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/signup',
    name: 'Signup',
    component: Signup
  },
  {
    path: '/admin/:id',
    name: 'Admin',
    component: AdminPage
  },
  {
    path: '/cart/:id',
    name: 'Cart',
    component: ShoppingCart
  },
  {
    path: '/store',
    name: 'StoreOrders',
    component: StoreOrders
  },
  {
    path: '/item',
    name: 'HomeItems',
    component: HomeItems
  },
  {
    path: '/profile',
    name: 'Profiles',
    component: Profiles
  },
  {
    path: '/onlinecashier',
    name: 'OnlineCashier',
    component: OnlineCashier
  },
  {
    path: '/physicalcashier',
    name: 'PhysicalCashier',
    component: PhysicalCashier
  },
  {
    path: '/erich',
    name: 'Erich',
    component: MiscFunctions
  },
  {
    path: '/about',
    name: 'About',
    component: About
  }
  // {
  //   path: '/about',
  //   name: 'About',
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  // }
]

const router = new VueRouter({
  mode: "history",
  routes
})

router.beforeEach((to, from, next) => {
  //console.log(to)
  let documentTitle = `${ process.env.VUE_APP_TITLE } - ${ to.name }`
  if(to.params.title){
    documentTitle += ` - ${ to.params.title }`
  }
  document.title = documentTitle
  next()
})

export default router
