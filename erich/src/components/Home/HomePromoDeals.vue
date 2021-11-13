<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col
          offset="1"
          cols=""
        >
          <h3>Promo Deals</h3>
        </v-col>
      </v-row>
      <home-promo-deals-1></home-promo-deals-1>
      <home-promo-deals-2></home-promo-deals-2>
      <home-promo-deals-3></home-promo-deals-3>
    </v-container>
  </div>
</template>

<script>
  import HomePromoDeals1 from './HomePromoDeals1.vue'
  import HomePromoDeals2 from './HomePromoDeals2.vue'
  import HomePromoDeals3 from './HomePromoDeals3.vue'

  export default ({
    components: {
    'home-promo-deals-1': HomePromoDeals1,
    'home-promo-deals-2': HomePromoDeals2,
    'home-promo-deals-3': HomePromoDeals3,
    }
  })
</script>
