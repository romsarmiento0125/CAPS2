<template>
  <div v-if="usersTag == 'Ocashier' || usersTag == 'Admin'"
  style="background-color: #FFFFFF"  
  >
    <oc-header></oc-header>
    <oc-deliver v-if="oCashierDeliver"></oc-deliver>
    <oc-pickup v-else-if="oCashierPickup"></oc-pickup>
  </div>
</template>

<script>
  import OCHeader from '../components/OnlineCashier/OCHeader.vue'
  import OCDeliver from '../components/OnlineCashier/OCDelivery.vue'
  import OCPickup from '../components/OnlineCashier/OCPickup.vue'
  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: "OnlineCashier",

    components: {
      "oc-header": OCHeader,
      "oc-deliver": OCDeliver,
      "oc-pickup": OCPickup,
    },

    data: () => ({
      deliverOrPickup: true,
       usersData: {
        usersEmail: "",
        usersPassword: "",
      }
    }),

    computed: {
      oCashierDeliver() {
        return this.$store.state.oCashierDeliver;
      },
      oCashierPickup() {
        return this.$store.state.oCashierPickup;
      },
      usersTag(){
        return localStorage.getItem('tag');
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {

    },

    watch: {

    },

    beforeMount(){

    }
  }
</script>
