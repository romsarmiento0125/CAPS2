<template>
  <div>
    <v-container fluid> 
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
              @click="pickupToPicker('pack')"
            >
              <p>To Pack</p>
            </v-btn>
            <v-btn
              @click="pickupToPicker('deliver')"
            >
              <p>On Delivery</p>
            </v-btn>
            <v-btn
              @click="pickupToPicker('complete')"
            >
              <p>Complete</p>
            </v-btn>
            <v-btn
              @click="pickupToPicker('cancel')"
            >
              <p>Cancelled</p>
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