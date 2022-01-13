<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col>
          <!-- <div
            class="my-2 mx-4"
            v-for="order in userPickupOrders"
            :key="order.id"
          >
            <v-divider></v-divider>
            <v-row>
              <v-col>
                <p
                  class="mb-0 mt-6 title"
                >Status: &nbsp;{{order.status}}</p>
                <p
                  class="my-0 Caption"
                >Pickup</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p
                  class="my-0 subtitle-1"
                >Invoice &nbsp; #: &nbsp; {{order.invoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <orderdeliveritems :orders="order.orders"></orderdeliveritems>
              </v-col>
            </v-row>
            <v-row>
              <v-col
                class="d-flex"
              >
                <v-spacer></v-spacer>
                <p
                  class="title mx-5"
                >
                  Total: &nbsp;{{priceRound(order.total)}}
                </p>
                
              </v-col>
            </v-row>
            <v-divider></v-divider>
          </div> -->

          <div
            class="my-2 mx-4"
            v-for="order in userPickupToPickup"
            :key="order.id"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{order.status}}</h4>
              </v-col>
              <v-col cols="9" class="d-flex justify-end ">
                <h4
                  class="fontBlue"
                >Pickup</h4>
              </v-col>
            </v-row>

            <v-row class="mx-2 mt-n5">
              <v-col>
                <h5
                  class="my-0 fontDesc font-weight-regular"
                >Invoice &nbsp; #: &nbsp; {{order.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="order.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                cols="2"
                offset="8"
              >
                
                <h4
                  class="mb-10 pl-16"
                >
                  Order total: 
                </h4>
                
              </v-col>
              <v-col cols="1" class="mr-5">
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(order.total)}}
                  </h4>
                </div>
                
              </v-col>
            </v-row>
            <v-divider></v-divider>
          </div>

        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import ODI from './OrderDeliverItem.vue'

  export default {
    components: {
      "orderdeliveritems": ODI,
    },

    data: () => ({
       orders: [],
       items: [],
    }),

    computed: {
      // userPickupOrders() {
      //   return this.$store.state.userPickupOrders;
      // },
      userPickupToPickup() {
        return this.$store.state.userPickupToPickup;
      },
      
    },

   

    methods: {
      
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
    },

    beforeMount(){
    }
    
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