<template>
  <div>
    <oc-header></oc-header>
    <oc-deliver v-if="oCashierDeliver"></oc-deliver>
    <oc-pickup v-else-if="oCashierPickup"></oc-pickup>
  </div>
</template>

<script>
  import OCHeader from '../components/OnlineCashier/OCHeader.vue'
  import OCDeliver from '../components/OnlineCashier/OCDeliveryToPack.vue'
  import OCPickup from '../components/OnlineCashier/OCPickupToPack.vue'

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
      }
    },

    methods: {
      getAllOrder(){
        axios.get('http://127.0.0.1:8000/api/customerorder')
        .then(res => {
          console.log(res.data);
          this.$store.commit('storeUserAllOrders', res.data);
        })
        //.then(res => console.log(res.data))
        .catch(err => console.error(err));
      },
      getAllOrderItems(){
        axios.get('http://127.0.0.1:8000/api/customerorderitems')
        .then(res => {
          console.log(res.data);
          this.$store.commit('storeUserAllOrdersItems', res.data);
        })
        //.then(res => console.log(res.data))
        .catch(err => console.error(err));
      }
    },

    beforeMount(){
      this.getAllOrder();
      this.getAllOrderItems();
    }
  }
</script>
