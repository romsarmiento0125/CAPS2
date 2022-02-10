<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col>
          <div
            class="my-sm-2 mx-sm-4"
            v-for="order in userProfileToDeliver"
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
                >Delivery</h4>
              </v-col>
            </v-row>
            <v-row class="mx-2 mt-n5">
              <v-col>
                <h5
                  class="my-0 fontDesc font-weight-regular"
                >Invoice &nbsp; #: &nbsp; {{order.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-sm-2">
              <v-col>
                <orderdeliveritems :orders="order.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="">
              <v-col
                xl="3"
                lg="4"
                md="5"
                sm="6"
                cols="6"
              >
                <h4
                  class="mb-10 ml-5"
                >
                  Expected receive date: {{order.adjustedDate}}
                </h4> 
              </v-col>
            
              <v-col
                offset-xl="5"
                offset-lg="4"
                offset-md="1"
                offset-sm="0"
                xl="2"
                lg="2"
                md="3"
                sm="3"
                cols="6"
                class="mb-sm-0 mb-5"
              >
                <h4
                  class="mb-sm-10 ml-sm-10 mr-2"
                >
                  Order total: 
                </h4>
                <div class="d-flex d-sm-none">
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

              <v-col
               xl="1"
                lg="1"
                md="2"
                sm="2"
                cols="5"
                class="mr-5 d-none d-sm-block"
              >
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
      userProfileToDeliver() {
        console.log(this.$store.state.userProfileToDeliver);
        return this.$store.state.userProfileToDeliver;
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