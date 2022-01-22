<template>
  <div>
    <v-container
      fluid
    >
      <v-row class="mb-1">
        <v-col cols="1">
          <div class="d-flex">
            <v-btn
              dark
              color="#00A6CC"
              class="mx-3 elevation-0"
              @click="deliverPickupPicker('deliver')"
            >
              <h4 class="my-5">Delivery</h4>
            </v-btn>
            <v-btn
              dark
              color="#FFA600"
              class="elevation-0 px-5"
              @click="deliverPickupPicker('pickup')"
            >
              <h4 class="my-5">Pickup</h4>
            </v-btn>
          </div>
        </v-col>
        <v-col cols="11" class="d-flex justify-center">
          <div>
            <v-btn
              plain
              class="mx-1"
              @click="deliverToPicker('pack')"
            >
              <h3 class="my-5">To Pack</h3>
            </v-btn>
            <v-btn
              plain
              class="mx-1"
              @click="deliverToPicker('deliver')"
            >
              <h3 class="my-5">On Delivery</h3>
            </v-btn>
            <v-btn
              plain
              class="mx-1"
              @click="deliverToPicker('complete')"
            >
              <h3 class="my-5">Complete</h3>
            </v-btn>
            <v-btn
              plain
              class="mx-1"
              @click="deliverToPicker('cancel')"
            >
              <h3 class="my-5" >Cancelled</h3>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      
      <v-divider></v-divider>

      <div>
        <oc-deliverytopack v-if="ocDeliverToPack"></oc-deliverytopack>
        <oc-deliverytodelivery v-if="ocDeliverToDeliver"></oc-deliverytodelivery>
        <oc-deliverytocomplete v-if="ocDeliverToComplete"></oc-deliverytocomplete>
        <oc-deliverytocancel v-if="ocDeliverToCancel"></oc-deliverytocancel>
      </div>
     
    </v-container>
  </div>
</template>

<script>
  import OCDeliveryToPack from './Delivery/OCDeliveryToPack.vue'
  import OCDeliveryToDelivery from './Delivery/OCDeliveryToDeliver.vue'
  import OCDeliveryToComplete from './Delivery/OCDeliveryToComplete.vue'
  import OCDeliveryToCancel from './Delivery/OCDeliveryToCancel.vue'

  export default {
    components: {
      "oc-deliverytopack": OCDeliveryToPack,
      "oc-deliverytodelivery": OCDeliveryToDelivery,
      "oc-deliverytocomplete": OCDeliveryToComplete,
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