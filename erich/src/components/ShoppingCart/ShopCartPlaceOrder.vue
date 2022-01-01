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
          <div>
            
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
                class="my-0 py-0 px-2"
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
          <div>
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
                    class="ma-5 pa-5"
                  >
                    <v-col
                      cols="6"
                    >
                      <div
                        class="d-flex"
                      >
                        <v-btn
                          plain
                          color="blue"
                          :to="{name: 'Cart' , params: { id: 'items', title: 'Items'}}"
                          @click="returnToCartItems"
                          small
                        >
                          <v-icon>mdi-chevron-left</v-icon>
                          <p
                            class="pa-0 ma-0"
                          >return to cart</p>
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                          class=""
                          color="primary"
                          :to="{name: 'Cart' , params: { id: 'delivery', title: 'Delivery'}}"
                          @click="placeOrderDeliver()"
                        >
                          deliver
                        </v-btn>
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
      shipBtn: "blue",
      shipText: "color: white",
      pickIcon: "blue",
      pickBtn: "white",
      pickText: "color: blue",
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
        this.shipBtn = "blue";
        this.shipText = "color: white";
        this.pickIcon = "blue";
        this.pickBtn = "white";
        this.pickText = "color: blue";
      },
      pickupMethodCond() {
        this.deliveryCond = false;
        this.$store.commit('thisPickup');
        this.shipIcon = "blue";
        this.shipBtn = "white";
        this.shipText = "color: blue";
        this.pickIcon = "white";
        this.pickBtn = "blue";
        this.pickText = "color: white";
      }
    }
  }
</script>