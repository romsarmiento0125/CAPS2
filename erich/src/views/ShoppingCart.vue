<template>
  <div>
    <!-- <shopcart-header></shopcart-header>
    <shopcart-items @scItemsEmit="scComponents('ph')"  v-if="scItems"></shopcart-items>
    <shopcart-placeorder @scPlaceOrderDeliver="scComponents('dl')" @scPlaceOrderPickup="scComponents('pu')" v-else-if="scPlaceOrder"></shopcart-placeorder>
    <shopcart-deliver v-else-if="scDelivery"></shopcart-deliver>
    <shopcart-pickup v-else-if="scPickup"></shopcart-pickup>
    <shopcart-footer></shopcart-footer> -->
    <shopcart-header></shopcart-header>
    <shopcart-items @scItemsEmit="scComponents('ph')"  v-if="scItems"></shopcart-items>
    <shopcart-placeorder @scPlaceOrderDeliver="scComponents('dl')" @scPlaceOrderPickup="scComponents('pu')" @scPickupDeliverFalse="scComponents('gg')" v-else-if="scPlaceOrder"></shopcart-placeorder>
    <shopcart-deliver v-else-if="scDelivery"></shopcart-deliver>
    <shopcart-pickup v-else-if="scPickup"></shopcart-pickup>
    <shopcart-footer></shopcart-footer>
  </div>
</template>

<script>
  import ShopCartHeader from '../components/ShoppingCart/ShopCartHeader.vue'
  import ShopCartFooter from '../components/ShoppingCart/ShopCartFooter.vue'
  import ShopCartItems from '../components/ShoppingCart/ShopCartItems.vue'
  import ShopCartPlaceOrder from '../components/ShoppingCart/ShopCartPlaceOrder.vue'
  import ShopCartDelivery from '../components/ShoppingCart/ShopCartDelivery.vue'
  import ShopCartPickup from '../components/ShoppingCart/ShopCartPickup.vue'

  export default {
    name: 'ShoppingCart',

    data: () => ({
      scItems: true,
      scPlaceOrder: false,
      scDelivery: false,
      scPickup: false,
    }),

    components: {
      'shopcart-header': ShopCartHeader,
      'shopcart-footer': ShopCartFooter,
      'shopcart-items': ShopCartItems,
      'shopcart-placeorder': ShopCartPlaceOrder,
      'shopcart-deliver': ShopCartDelivery,
      'shopcart-pickup': ShopCartPickup,
    },

    methods: {
      scComponents(cond) {
        if(cond == "ph") {
          this.scItems = false;
          this.scPlaceOrder = true;
          this.scDelivery = false;
          this.scPickup = false;
        }
        else if(cond == "dl") {
          this.scItems = false;
          this.scPlaceOrder = false;
          this.scDelivery = true;
          this.scPickup = false;
        }
        else if(cond == "pu") {
          this.scItems = false;
          this.scPlaceOrder = false;
          this.scDelivery = false;
          this.scPickup = true;
        }
        else{
          this.scItems = true;
          this.scPlaceOrder = false;
          this.scDelivery = false;
          this.scPickup = false;
        }
      }
    }
  }
</script>