<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          offset="1"
        >
          <h3 class="mt-4">Delivery Method</h3>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          offset="1"
          cols="1"
        >
          <div class="mx-0">
            
            <v-btn
              @click="deliveryMethodCond()"
              :color="shipBtn"
            >
              <v-icon
                :color="shipIcon"
              >
                mdi-truck-delivery-outline
              </v-icon>
              <p
                class="my-0 py-0 px-3"
                :style="shipText"
              >
                Ship
              </p>
            </v-btn>
          </div>
          
        </v-col>
        <v-col
          cols="1"
        >
          <div class="ml-1">
            <v-btn
              @click="pickupMethodCond()"
              :color="pickBtn"
            >
              <v-icon
                :color="pickIcon"
              >
                mdi-store
              </v-icon>
              <p
                class="my-0 py-0"
                :style="pickText"
              >
                Pick Up
              </p>
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
          offset="1"
          cols="4"
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
                    class="ma-5 pa-0 pb-7"
                  >
                    <v-col
                      cols="12"
                      class="pa-0 ma-0"
                    >
                      <div
                        class=""
                      >
                        <v-row>
                          <v-col cols="6" class="mt-2">
                            <v-btn
                              plain
                              color="#1106A0"
                              :to="{name: 'Cart' , params: { id: 'items', title: 'Items'}}"
                              @click="returnToCartItems"
                              small
                            >
                              <v-icon>mdi-chevron-left</v-icon>
                              <p
                                class="ma-0 "
                              >return to cart</p>
                            </v-btn>
                          </v-col>

                          <v-col cols="6" class="d-flex justify-end ">
                            <v-btn
                              dark
                              class="px-6"
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
              <v-col>
                <v-sheet
                  color="white"
                  height="100%"
                  width="100%"
                >
                  <method-pickup></method-pickup>
                  <v-btn
                    color="primary"
                    :to="{name: 'Cart' , params: { id: 'pickup', title: 'Pick Up'}}"
                    @click="placeOrderPickup()"
                  >
                    Pickup
                  </v-btn>
                </v-sheet>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
        <v-col
          offset="1"
          cols="5"
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