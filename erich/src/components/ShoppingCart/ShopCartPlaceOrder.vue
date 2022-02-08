<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          offset-xl="1"
          xl="11"
          cols="12"
        >
          <h3 class="mt-4">Delivery Method</h3>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          offset-xl="1"
          xl="1"
          lg="2"
          md="2"
          sm="3"
          cols="5"
        >
          <div>
            
            <v-btn
              @click="deliveryMethodCond()"
              :color="shipBtn"
              class=""
            >
              <v-icon
                :color="shipIcon"
                size="20px"
              >
                mdi-truck-delivery-outline
              </v-icon>
              <h5
                class="my-0 py-0 px-4 font-weight-black"
                :style="shipText"
              >
                Ship
              </h5>
            </v-btn>
          </div>
          
        </v-col>
        <v-col
          xl="1"
          lg="2"
          md="2"
          cols="5"
          sm="3"
          class="ma-0 pl-0"
        >
          <div>
            <v-btn
              @click="pickupMethodCond()"
              :color="pickBtn"
              
            >
              <v-icon
                :color="pickIcon"
                size="20px"
              >
                mdi-store
              </v-icon>
              <h5
                class="my-0 py-0 px-3 font-weight-bold"
                :style="pickText"
              >
                Pick Up
              </h5>
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>

    <v-container
      fluid
    >
      <v-row>
        <v-col
          offset-xl="1"
          xl="4"
          lg="6"
          md="6"
          cols="12"
        >
          <v-container
            v-if="deliveryCond"
            fluid
          >
            <v-row>
              <v-col
                class="ma-0 pa-0"
              >
                <v-sheet
                  color="white"
                  height="100%"
                  width="100%"
                >
                  <method-delivery></method-delivery>
                  <v-row
                    class="ma-10 pa-0 pb-7"
                  >
                    <v-col
                      cols="12"
                      class="pa-0 ma-0"
                    >
                      <div
                        class=""
                      >
                        <v-row>
                          <v-col
                            lg="6"
                            md="6"
                            sm="6"
                            cols="6"
                            class="mt-1"
                          >
                            <v-btn
                              plain
                              color="#1106A0"
                              :to="{name: 'Cart' , params: { id: 'items', title: 'Items'}}"
                              @click="returnToCartItems"
                              small
                            >
                              <v-icon>mdi-chevron-left</v-icon>
                              <p
                                class="ma-0 font-weight-black d-none d-sm-block"
                              >return to cart</p>
                            </v-btn>
                          </v-col>

                          <v-col
                            lg="6"
                            md="6"
                            sm="6"
                            cols="6"
                            class="d-flex justify-end"
                          >
                            <v-btn
                              dark
                              class="px-sm-6 mr-sm-6"
                              color="#1106A0"
                              :to="{name: 'Cart' , params: { id: 'delivery', title: 'Delivery'}}"
                              @click="placeOrderDeliver()"
                            >
                              Continue Shipping
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-col>
                  </v-row>
                </v-sheet>
              </v-col>
            </v-row>
          </v-container>

          <v-container
            v-else
            fluid
          >
            <v-row>
              <v-col class="ma-0 pa-0">
                <v-sheet
                  color="white"
                  height="100%"
                  width="100%"
                >
                  <method-pickup></method-pickup>
                  <v-row class="ma-10 pa-0 pb-7">
                    <v-col 
                      cols="12"
                      class="pa-0 ma-0">

                      <div>
                        <v-row>
                          <v-col cols="6" class="mt-1">
                            <v-btn
                              plain
                              color="#1106A0"
                              :to="{name: 'Cart' , params: { id: 'items', title: 'Items'}}"
                              @click="returnToCartItems"
                              small
                            >
                              <v-icon>mdi-chevron-left</v-icon>
                              <p
                                class="ma-0 font-weight-bold d-none d-sm-block"
                              >return to cart</p>
                            </v-btn>
                          </v-col>

                          <v-col cols="6" class="d-flex justify-end">
                            <v-btn
                              dark
                              class="px-sm-6 mr-sm-6"
                              color="#1106A0"
                              :to="{name: 'Cart' , params: { id: 'pickup', title: 'Pick Up'}}"
                              @click="placeOrderPickup()"
                            >
                              Continue Shipping
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-col>
                  </v-row>
                </v-sheet>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
        <v-col
          offset-xl="1"
          xl="5"
          lg="6"
          md="6"
          cols="12"
        >
          <order-items></order-items>
        </v-col>
      </v-row>
    </v-container>
    
    
  </div>
</template>

<script>
  import MethodDelivery from './DeliveryMethod/MethodDelivery.vue'
  import MethodPickup from './DeliveryMethod/MethodPickup.vue'
  import ShopCartPlaceOrderItems from './ShopCartPlaceOrderItems.vue'

  export default {
    components: {
      'method-delivery': MethodDelivery,
      'method-pickup': MethodPickup,
      'order-items': ShopCartPlaceOrderItems
    },

    data: () => ({
      deliveryCond: true,
      shipIcon: "white",
      shipBtn: "#1106A0",
      shipText: "color: white",
      pickIcon: "#1106A0",
      pickBtn: "white",
      pickText: "color: #1106A0",
    }),

    methods: {
      placeOrderDeliver() {
        this.$emit('scPlaceOrderDeliver');
      },
      placeOrderPickup() {
        this.$emit('scPlaceOrderPickup');
      },
      returnToCartItems(){
        //alert("emit something to show cart components");
        this.$emit('scPickupDeliverFalse')
      },
      deliveryMethodCond() {
        this.deliveryCond = true;
        this.$store.commit('thisDeliver');
        this.shipIcon = "white";
        this.shipBtn = "#1106A0";
        this.shipText = "color: white";
        this.pickIcon = "#1106A0";
        this.pickBtn = "white";
        this.pickText = "color: #1106A0";
      },
      pickupMethodCond() {
        this.deliveryCond = false;
        this.$store.commit('thisPickup');
        this.shipIcon = "#1106A0";
        this.shipBtn = "white";
        this.shipText = "color: #1106A0";
        this.pickIcon = "white";
        this.pickBtn = "#1106A0";
        this.pickText = "color: white";
      }
    }
  }
</script>