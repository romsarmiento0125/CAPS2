<template>
  <div>
    <oc-header></oc-header>
    <oc-deliver v-if="deliverOrPickup"></oc-deliver>
    <oc-pickup v-else></oc-pickup>
  </div>
</template>

<script>
  import OCHeader from '../components/OnlineCashier/OCHeader.vue'
  import OCDeliver from '../components/OnlineCashier/OCDeliveryToPack.vue'
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
  }
</script>
