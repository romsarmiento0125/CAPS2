<template>
  <div>
    <h1>ShopCart Delivery</h1>
    <v-btn
      color="primary"
      @click="checkOut()"
    >
      Check Out
    </v-btn>
  </div>
</template>

<script>
  export default {
    
    methods: {
      checkOut() {
        alert('delivery checout');
      }
    }
  }
</script>