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
              :src="require('../../../assets/itemPhotos/'+item.ItemImage)"
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
            >{{item.ItemName}}</p>
            <p
              class="my-0"
            >{{item.ItemDesc}}</p>
            <p
              class="my-0"
            >x{{item.Quantity}}</p>

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
            >{{priceRound(item.Quantity * item.RetailPrice)}}</p>
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