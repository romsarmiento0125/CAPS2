<template>
  <div
    style="border: 1px solid grey; border-radius: 5px"
  >
    <v-container
      fluid
    >
      <div
        v-for="(item, n) in orders"
        :key="n"
      >
        <div
          class="d-flex"
        >
          <div>
            <v-img
              :src="require('../../../assets/itemPhotos/'+item.itemImage)"
              contain
              max-width="100px"
              max-height="80px"
              min-width="100px"
              min-height="80px"
            ></v-img>
          </div>
          <div>
            <h4
              class="my-0 fontBlue"
            >{{item.itemName}}</h4>
            <h5
              class="my-0 fontTitle"
            >{{item.itemDesc}}</h5>
            <h5
              class="my-0 fontDesc mt-2"
            >x{{item.quantity}}</h5>

          </div>
          <v-spacer></v-spacer>
          <div
            class="d-flex align-center mr-5"
          >
            <v-icon
              color="#1106A0"
              size="15px"
              class="mt-11 mx-1"
            >
              mdi-currency-php
            </v-icon>
            <h5
              class=" mt-11 my-0 fontBlue"
            >{{priceRound(((item.quantity * item.retailPrice) - (item.quantity * item.retailPrice)*(item.discount / 100)))}}</h5>
          </div>
        </div>
        
      </div>
    </v-container>
  </div>
</template>

<script>
  export default {
    props: ['orders'],

    data: () => ({

    }),

    methods: {
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
    },
  
  }
</script>

<style scoped>
.fontBlue{
  color: #1106A0;
}
.fontTitle{
  color: #464646;
}
.fontDesc{
  color: #858585
}
</style>