<template>
  <div v-if="usersTag == 'Ocashier' || usersTag == 'Admin'">
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
      getAllOrder(){
        axios.get(this.getDomain()+'api/customerorder',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
        .then(res => {
          this.$store.commit('storeUserAllOrders', res.data);
        })
        .catch(err => console.error(err));
      },
      getAllDeliver(){
        axios.get(this.getDomain()+'api/customerdeliveritems',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
        .then(res => {
          this.$store.commit('storeUserAllDeliver', res.data);
        })
        .catch(err => console.error(err));
      },
      getAllComplete(){
        axios.get(this.getDomain()+'api/customercompleteitems',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
        .then(res => {
          this.$store.commit('storeUserAllComplete', res.data);
        })
        .catch(err => console.error(err));
      },
      getPickupOrder(){
        axios.get(this.getDomain()+'api/customerpickup',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.$store.commit('storeUserPickupOrders', res.data);
          })
          .catch(err => console.error(err));
      },
      getPickupPickup(){
        axios.get(this.getDomain()+'api/customerpickuppickup',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserAllPickup', res.data);
          })
          .catch(err => console.error(err));
      },
      getPickupComplete(){
        axios.get(this.getDomain()+'api/customerpickupcomplete',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserPickupComplete', res.data);
          })
          .catch(err => console.error(err));
      },
    },

    watch: {

    },

    beforeMount(){
      this.getAllOrder();
      this.getAllDeliver();
      this.getAllComplete();
      this.getPickupOrder();
      this.getPickupPickup();
      this.getPickupComplete();
    }
  }
</script>
