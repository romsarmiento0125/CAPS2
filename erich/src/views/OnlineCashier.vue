<template>
  <div>
    <oc-header></oc-header>
    <oc-deliver v-if="oCashierDeliver"></oc-deliver>
    <oc-pickup v-else-if="oCashierPickup"></oc-pickup>
  </div>
</template>

<script>
  import OCHeader from '../components/OnlineCashier/OCHeader.vue'
  import OCDeliver from '../components/OnlineCashier/OCDelivery.vue'
  import OCPickup from '../components/OnlineCashier/OCPickup.vue'


  export default {
    name: "OnlineCashier",

    components: {
      "oc-header": OCHeader,
      "oc-deliver": OCDeliver,
      "oc-pickup": OCPickup,
    },

    data: () => ({
      deliverOrPickup: true,
    }),

    computed: {
      oCashierDeliver() {
        return this.$store.state.oCashierDeliver;
      },
      oCashierPickup() {
        return this.$store.state.oCashierPickup;
      },
    },

    methods: {
      getAllOrder(){
        axios.get('http://127.0.0.1:8000/api/customerorder')
        .then(res => {
          this.$store.commit('storeUserAllOrders', res.data);
        })
        .catch(err => console.error(err));
      },
      getAllDeliver(){
        axios.get('http://127.0.0.1:8000/api/customerdeliveritems')
        .then(res => {
          this.$store.commit('storeUserAllDeliver', res.data);
        })
        .catch(err => console.error(err));
      },
      getAllComplete(){
        axios.get('http://127.0.0.1:8000/api/customercompleteitems')
        .then(res => {
          this.$store.commit('storeUserAllComplete', res.data);
        })
        .catch(err => console.error(err));
      },
      getPickupOrder(){
        axios.get('http://127.0.0.1:8000/api/customerpickup')
          .then(res => {
            this.$store.commit('storeUserPickupOrders', res.data);
          })
          .catch(err => console.error(err));
      },
    },

    beforeMount(){
      this.getAllOrder();
      this.getAllDeliver();
      this.getAllComplete();
      this.getPickupOrder();
    }
  }
</script>
