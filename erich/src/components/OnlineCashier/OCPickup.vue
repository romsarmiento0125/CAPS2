<template>
  <div>
    <v-container fluid> 
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
        <v-col cols="11">
          <div class="d-flex justify-center">
            <v-btn
              plain
              class="mx-1"
              @click="pickupToPicker('pack')"
            >
              <h3 class="my-5">To Pack</h3>
            </v-btn>
            <v-btn
              plain
              class="mx-1"
              @click="pickupToPicker('deliver')"
            >
              <h3 class="my-5">To Pickup</h3>
            </v-btn>
            <v-btn
              plain
              class="mx-1"
              @click="pickupToPicker('complete')"
            >
              <h3 class="my-5">Complete</h3>
            </v-btn>
            <v-btn
              plain
              class="mx-1"
              @click="pickupToPicker('cancel')"
            >
              <h3 class="my-5">Cancelled</h3>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      
      <v-divider></v-divider>

      <div>
        <oc-pickuptopack v-if="ocPickupToPack"></oc-pickuptopack>
        <oc-pickuptopick v-if="ocPickupToDeliver"></oc-pickuptopick>
        <oc-pickuptocomplete v-if="ocPickupToComplete"></oc-pickuptocomplete>
        <oc-pickuptocancel v-if="ocPickupToCancel"></oc-pickuptocancel>
      </div>

    </v-container>
  </div>
</template>

<script>
  import OCPickupToPack from './Pickup/OCPickupToPack.vue'
  import OCPickupToPick from './Pickup/OCPickupToPick.vue'
  import OCPickupToComplete from './Pickup/OCPickupToComplete.vue'
  import OCPickupToCancel from './Pickup/OCPickupToCancel.vue'

  export default {
    components: {
      "oc-pickuptopack": OCPickupToPack,
      "oc-pickuptopick": OCPickupToPick,
      "oc-pickuptocomplete": OCPickupToComplete,
      "oc-pickuptocancel": OCPickupToCancel,
    },

    computed: {
      ocPickupToPack() {
        return this.$store.state.ocPickupToPack;
      },
      ocPickupToDeliver() {
        return this.$store.state.ocPickupToPick;
      },
      ocPickupToComplete() {
        return this.$store.state.ocPickupToComplete;
      },
      ocPickupToCancel() {
        return this.$store.state.ocPickupToCancel;
      },
    },

    methods: {
      deliverPickupPicker(cond) {
        if(cond == "deliver"){
          this.$store.commit('oCashierDeliver');
        }
        else if(cond == "pickup"){
          this.$store.commit('oCashierPickup');
        }
      },
      pickupToPicker(data){
        if(data == "pack"){
          this.$store.commit('ocPickupToPack');
        }
        else if(data == "deliver"){
          this.$store.commit('ocPickupToDeliver');
        }
        else if(data == "complete"){
          this.$store.commit('ocPickupToComplete');
        }
        else if(data == "cancel"){
          this.$store.commit('ocPickupToCancel');
        }
      },
    },
    beforeMount() {
      // axios.get('http://127.0.0.1:8000/api/customerpickup')
      //   .then(res => {
      //     console.log(res.data);
      //     //this.$store.commit('storeUserAllOrders', res.data);
      //   })
      //   .catch(err => console.error(err));
    }
  }
</script>