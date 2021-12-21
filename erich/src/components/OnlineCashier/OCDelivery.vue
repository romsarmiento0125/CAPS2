<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div>
            <v-btn
              @click="deliverPickupPicker('deliver')"
            >
              <p>Delivery</p>
            </v-btn>
            <v-btn
              @click="deliverPickupPicker('pickup')"
            >
              <p>Pickup</p>
            </v-btn>
          </div>
        </v-col>
        <v-col>
          <div>
            <v-btn
              @click="deliverToPicker('pack')"
            >
              <p>To Pack</p>
            </v-btn>
            <v-btn
              @click="deliverToPicker('deliver')"
            >
              <p>On Delivery</p>
            </v-btn>
            <v-btn
              @click="deliverToPicker('complete')"
            >
              <p>Complete</p>
            </v-btn>
            <v-btn
              @click="deliverToPicker('return')"
            >
              <p>Return/Replace</p>
            </v-btn>
            <v-btn
              @click="deliverToPicker('cancel')"
            >
              <p>Cancelled</p>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      
      <v-divider></v-divider>

      <div>
        <oc-deliverytopack v-if="ocDeliverToPack"></oc-deliverytopack>
        <oc-deliverytodelivery v-if="ocDeliverToDeliver"></oc-deliverytodelivery>
        <oc-deliverytocomplete v-if="ocDeliverToComplete"></oc-deliverytocomplete>
        <oc-deliverytoreturn v-if="ocDeliverToReturn"></oc-deliverytoreturn>
        <oc-deliverytocancel v-if="ocDeliverToCancel"></oc-deliverytocancel>
      </div>
     
    </v-container>
  </div>
</template>

<script>
  import OCDeliveryToPack from './Delivery/OCDeliveryToPack.vue'
  import OCDeliveryToDelivery from './Delivery/OCDeliveryToDeliver.vue'
  import OCDeliveryToComplete from './Delivery/OCDeliveryToComplete.vue'
  import OCDeliveryToReturn from './Delivery/OCDeliveryToReturn.vue'
  import OCDeliveryToCancel from './Delivery/OCDeliveryToCancel.vue'

  export default {
    components: {
      "oc-deliverytopack": OCDeliveryToPack,
      "oc-deliverytodelivery": OCDeliveryToDelivery,
      "oc-deliverytocomplete": OCDeliveryToComplete,
      "oc-deliverytoreturn": OCDeliveryToReturn,
      "oc-deliverytocancel": OCDeliveryToCancel,
    },

    data: () => ({
      
    }),

    computed: {
      userAllOrders() {
        return this.$store.state.userAllOrders;
      },
      ocDeliverToPack() {
        return this.$store.state.ocDeliverToPack;
      },
      ocDeliverToDeliver() {
        return this.$store.state.ocDeliverToDelivery;
      },
      ocDeliverToComplete() {
        return this.$store.state.ocDeliverToComplete;
      },
      ocDeliverToReturn() {
        return this.$store.state.ocDeliverToReturn;
      },
      ocDeliverToCancel() {
        return this.$store.state.ocDeliverToCancel;
      },
    },

    methods: {
      deliverPickupPicker(data){
        if(data == "deliver"){
          this.$store.commit('oCashierDeliver');
        }
        else if(data == 'pickup'){
          this.$store.commit('oCashierPickup');
        }
      },
      deliverToPicker(data){
        if(data == "pack"){
          this.$store.commit('ocDeliverToPack');
        }
        else if(data == "deliver"){
          this.$store.commit('ocDeliverToDeliver');
        }
        else if(data == "complete"){
          this.$store.commit('ocDeliverToComplete');
        }
        else if(data == "return"){
          this.$store.commit('ocDeliverToReturn');
        }
        else if(data == "cancel"){
          this.$store.commit('ocDeliverToCancel');
        }
      },
    },

    beforeMount(){
    }
  }
</script>