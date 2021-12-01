<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <p>cart>information>shipping>Payment</p>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <h3>Chekout Method</h3>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-btn
            @click="deliveryMethodCond()"
          >
            Ship
          </v-btn>
        </v-col>
        <v-col>
          <v-btn
            @click="pickupMethodCond()"
          >
            Pick Up
          </v-btn>
        </v-col>
      </v-row>
    </v-container>

    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-container
            v-if="deliveryCond"
            fluid
          >
            <v-row>
              <v-col>
                <method-delivery></method-delivery>
                <v-btn
                  color="primary"
                  :to="{name: 'Cart' , params: { id: 'delivery', title: 'Delivery'}}"
                  @click="placeOrderDeliver()"
                >
                  deliver
                </v-btn>
              </v-col>
            </v-row>
          </v-container>

          <v-container
            v-else
            fluid
          >
            <v-row>
              <v-col>
                <method-pickup></method-pickup>
                <v-btn
                  color="primary"
                  :to="{name: 'Cart' , params: { id: 'pickup', title: 'Pick Up'}}"
                  @click="placeOrderPickup()"
                >
                  Pickup
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
        <v-col>
          <v-row>
            <v-col>
              <h1>Items</h1>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <h1>Totals</h1>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
    
    
  </div>
</template>

<script>
  import MethodDelivery from './DeliveryMethod/MethodDelivery.vue'
  import MethodPickup from './DeliveryMethod/MethodPickup.vue'

  export default {
    components: {
      'method-delivery': MethodDelivery,
      'method-pickup': MethodPickup
    },

    data: () => ({
      deliveryCond: true,
    }),

    methods: {
      placeOrderDeliver() {
        this.$emit('scPlaceOrderDeliver');
      },
      placeOrderPickup() {
        this.$emit('scPlaceOrderPickup');
      },
      deliveryMethodCond() {
        this.deliveryCond = true;
      },
      pickupMethodCond() {
        this.deliveryCond = false;
      }
    }
  }
</script>