<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col>

          <!-- Deliver To Pack -->
          <div
            class="my-2 mx-4"
            v-for="orderto in userProfileOrders"
            :key="orderto.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{orderto.status}}</h4>
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
                >Invoice &nbsp; #: &nbsp; {{orderto.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="orderto.orders"></orderdeliveritems>
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
                    &nbsp;{{priceRound(orderto.total)}}
                  </h4>
                </div>
                
              </v-col>
            </v-row>

            <v-divider></v-divider>
          </div>
        </v-col>
      </v-row>

      <!-- Delivery To Deliver -->
      <v-row>
        <v-col>
          <div
            class="my-2 mx-4"
            v-for="ordertd in userProfileToDeliver"
            :key="ordertd.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{ordertd.status}}</h4>
                
              </v-col>
              <v-col cols="9" class="d-flex justify-end ">
                <h4
                  class="fontBlue"
                >Deliver</h4>
              </v-col>
            </v-row>

            <v-row class="mx-2 mt-n5">
              <v-col>
                <h5
                  class="my-0 fontDesc font-weight-regular"
                >Invoice &nbsp; #: &nbsp; {{ordertd.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="ordertd.orders"></orderdeliveritems>
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
                    &nbsp;{{priceRound(ordertd.total)}}
                  </h4>
                </div>
                
              </v-col>
            </v-row>
            <v-divider></v-divider>
          </div>
        </v-col>
      </v-row>

      <!-- Delivery Complete -->
      <v-row>
        <v-col>
          <div
            class="my-2 mx-4"
            v-for="ordertc in userProfileToComplete"
            :key="ordertc.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{ordertc.status}}</h4>
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
                >Invoice &nbsp; #: &nbsp; {{ordertc.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="ordertc.orders"></orderdeliveritems>
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
                    &nbsp;{{priceRound(ordertc.total)}}
                  </h4>
                </div>
                
              </v-col>

            </v-row>
            <v-divider></v-divider>
          </div>

          <!-- Pickup To Pack -->
          <div
            class="my-2 mx-4"
            v-for="orderpo in userPickupOrders"
            :key="orderpo.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="mb-0 fontTitle"
                >Status: &nbsp;{{orderpo.status}}</h4>
                
              </v-col>
              <v-col cols="9" class="d-flex justify-end">
                  <h4
                  class="my-0 fontBlue"
                  >Pickup</h4>
              </v-col>
            </v-row>

            <v-row class="mx-2 mt-n5">
              <v-col>
                <h5
                  class="my-0 fontDesc font-weight-regular"
                >Invoice &nbsp; #: &nbsp; {{orderpo.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="orderpo.orders"></orderdeliveritems>
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
                    &nbsp;{{priceRound(orderpo.total)}}
                  </h4>
                </div>
                
              </v-col>
              
            </v-row>
            <v-divider></v-divider>
          </div>

          <!-- Pickup To Pickup -->
          <div
            class="my-2 mx-4"
            v-for="orderpp in userPickupToPickup"
            :key="orderpp.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{orderpp.status}}</h4>
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
                >Invoice &nbsp; #: &nbsp; {{orderpp.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="orderpp.orders"></orderdeliveritems>
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
                    &nbsp;{{priceRound(orderpp.total)}}
                  </h4>
                </div>
                
              </v-col>
            </v-row>
            <v-divider></v-divider>
          </div>

          <!-- Pickup Complete -->
          <div
            class="my-2 mx-4"
            v-for="orderpc in userPickupToComplete"
            :key="orderpc.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{orderpc.status}}</h4>
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
                >Invoice &nbsp; #: &nbsp; {{orderpc.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="orderpc.orders"></orderdeliveritems>
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
                    &nbsp;{{priceRound(orderpc.total)}}
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
      userProfileOrders() {
        return this.$store.state.userProfileOrders;
      },
      userProfileToDeliver() {
        return this.$store.state.userProfileToDeliver;
      },
      userProfileToComplete() {
        return this.$store.state.userProfileToComplete;
      },
      userProfileToCancel() {
        return this.$store.state.userProfileToCancel;
      },
      userPickupOrders() {
        return this.$store.state.userPickupOrders;
      },
      userPickupToPickup() {
        return this.$store.state.userPickupToPickup;
      },
      userPickupToComplete() {
        return this.$store.state.userPickupToComplete;
      },
      userPickupToCancel() {
        return this.$store.state.userPickupToCancel;
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