<template>
  <div
    style="border: 1px solid red; border-radius: 5px"
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
            <p
              class="my-0"
            >{{item.itemName}}</p>
            <p
              class="my-0"
            >{{item.itemDesc}}</p>
            <p
              class="my-0"
            >x{{item.quantity}}</p>

          </div>
          <v-spacer></v-spacer>
          <div
            class="d-flex align-center"
          >
            <v-icon
              color="blue"
            >
              mdi-currency-php
            </v-icon>
            <p
              class="title my-0 blue--text"
            >{{priceRound(((item.quantity * item.retailPrice) - (item.quantity * item.retailPrice)*(item.discount / 100)))}}</p>
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