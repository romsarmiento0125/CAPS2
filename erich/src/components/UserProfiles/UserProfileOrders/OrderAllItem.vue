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
            <v-row>
              <v-col>
                <p
                  class="mb-0 mt-6 title"
                >Status: &nbsp;{{orderto.status}}</p>
                <p
                  class="my-0 Caption"
                >Deliver</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p
                  class="my-0 subtitle-1"
                >Invoice &nbsp; #: &nbsp; {{orderto.invoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <orderdeliveritems :orders="orderto.orders"></orderdeliveritems>
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
                  Total: &nbsp;{{priceRound(orderto.total)}}
                </p>
                
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
            <v-row>
              <v-col>
                <p
                  class="mb-0 mt-6 title"
                >Status: &nbsp;{{ordertd.status}}</p>
                <p
                  class="my-0 Caption"
                >Deliver</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p
                  class="my-0 subtitle-1"
                >Invoice &nbsp; #: &nbsp; {{ordertd.invoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <orderdeliveritems :orders="ordertd.orders"></orderdeliveritems>
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
                  Total: &nbsp;{{priceRound(ordertd.total)}}
                </p>
                
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
            <v-row>
              <v-col>
                <p
                  class="mb-0 mt-6 title"
                >Status: &nbsp;{{ordertc.status}}</p>
                <p
                  class="my-0 Caption"
                >Deliver</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p
                  class="my-0 subtitle-1"
                >Invoice &nbsp; #: &nbsp; {{ordertc.invoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <orderdeliveritems :orders="ordertc.orders"></orderdeliveritems>
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
                  Total: &nbsp;{{priceRound(ordertc.total)}}
                </p>
                
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
            <v-row>
              <v-col>
                <p
                  class="mb-0 mt-6 title"
                >Status: &nbsp;{{orderpo.status}}</p>
                <p
                  class="my-0 Caption"
                >Pickup</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p
                  class="my-0 subtitle-1"
                >Invoice &nbsp; #: &nbsp; {{orderpo.invoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <orderdeliveritems :orders="orderpo.orders"></orderdeliveritems>
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
                  Total: &nbsp;{{priceRound(orderpo.total)}}
                </p>
                
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
            <v-row>
              <v-col>
                <p
                  class="mb-0 mt-6 title"
                >Status: &nbsp;{{orderpp.status}}</p>
                <p
                  class="my-0 Caption"
                >Pickup</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p
                  class="my-0 subtitle-1"
                >Invoice &nbsp; #: &nbsp; {{orderpp.invoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <orderdeliveritems :orders="orderpp.orders"></orderdeliveritems>
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
                  Total: &nbsp;{{priceRound(orderpp.total)}}
                </p>
                
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
            <v-row>
              <v-col>
                <p
                  class="mb-0 mt-6 title"
                >Status: &nbsp;{{orderpc.status}}</p>
                <p
                  class="my-0 Caption"
                >Pickup</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p
                  class="my-0 subtitle-1"
                >Invoice &nbsp; #: &nbsp; {{orderpc.invoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <orderdeliveritems :orders="orderpc.orders"></orderdeliveritems>
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
                  Total: &nbsp;{{priceRound(orderpc.total)}}
                </p>
                
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
      userPickupOrders() {
        return this.$store.state.userPickupOrders;
      },
      userPickupToPickup() {
        return this.$store.state.userPickupToPickup;
      },
      userPickupToComplete() {
        return this.$store.state.userPickupToComplete;
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