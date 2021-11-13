<template>
  <div>
    <h1>ShopCart Place Order</h1>
    <v-btn
      color="primary"
      :to="{name: 'Cart' , params: { id: 'delivery', title: 'Delivery'}}"
      @click="placeOrderDeliver()"
    >
      deliver
    </v-btn>
    <v-btn
      color="primary"
      :to="{name: 'Cart' , params: { id: 'pickup', title: 'Pick Up'}}"
      @click="placeOrderPickup()"
    >
      Pickup
    </v-btn>
  </div>
</template>

<script>
  export default {
    
    methods: {
      placeOrderDeliver() {
        this.$emit('scPlaceOrderDeliver');
      },
      placeOrderPickup() {
        this.$emit('scPlaceOrderPickup');
      }
    }
  }
</script>