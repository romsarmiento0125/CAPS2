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
  }
</script>
