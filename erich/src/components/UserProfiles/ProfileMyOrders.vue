<template>
  <div>
    <v-container
      fluid
    >
      <v-sheet
        color="White"
        width="100%"
        height="100%"
        class="mb-5"
      >
        <v-row
          class="mx-lg-5 "
        >
          <v-col
            lg="2"
          >
            <v-btn
              plain
              @click="navigateOrders('all')"
            >
              <h3
                class="my-0 black--text fontTitle"
              >All</h3>
            </v-btn>
          </v-col>
          <v-col
            lg="2"
          >
            <v-btn
              plain
              @click="navigateOrders('tp')"
            >
              <h3
                class="my-0 black--text fontTitle"
              >To Pack</h3>
            </v-btn>
          </v-col>
          <v-col
            lg="2"
          >
            <v-btn
              plain
              @click="navigateOrders('dl')"
            >
              <h3
                class="my-0 black--text fontTitle"
              >To Receive</h3>
            </v-btn>
          </v-col>
          <v-col
            lg="2"
          >
            <v-btn
              plain
              @click="navigateOrders('pu')"
            >
              <h3
                class="my-0 black--text fontTitle"
              >To Pickup</h3>
            </v-btn>
          </v-col>
          <v-col
            lg="2"
          >
            <v-btn
              plain
              @click="navigateOrders('com')"
            >
              <h3
                class="my-0 black--text fontTitle"
              >Complete</h3>
            </v-btn>
          </v-col>
          <v-col
            lg="2"
          >
            <v-btn
              plain
              @click="navigateOrders('can')"
            >
              <h3
                class="my-0 black--text fontTitle"
              >Cancelled</h3>
            </v-btn>
          </v-col>
        </v-row>
      </v-sheet>
      <v-sheet>
        <v-row>
          <v-col>
            <div class="mt-5"></div>
            <div>
              <upo-allitems v-if="navall"></upo-allitems>
              <upo-topack v-else-if="navtp"></upo-topack>
              <upo-todeliver v-else-if="navdeli"></upo-todeliver>
              <upo-topickup v-else-if="navpu"></upo-topickup>
              <upo-tocomplete v-else-if="navcom"></upo-tocomplete>
              <upo-todelete v-else-if="navdel"></upo-todelete>
            </div>
            <div class="mb-5"></div>
          </v-col>
        </v-row>
      </v-sheet>
    </v-container>
  </div>
</template>

<script>
  import UPOAllItem from './UserProfileOrders/OrderAllItem.vue'
  import UPOToPack from './UserProfileOrders/OrderToPackItem.vue'
  import UPOToDeliver from './UserProfileOrders/OrderToDeliverItem.vue'
  import UPOToPickUp from './UserProfileOrders/OrderToPickup.vue'
  import UPOToComplete from './UserProfileOrders/OrderToCompleteItems.vue'
  import UPOToDelete from './UserProfileOrders/OrderToDelete.vue'

  export default {
    components: {
      'upo-allitems': UPOAllItem,
      'upo-topack': UPOToPack,
      'upo-todeliver': UPOToDeliver,
      'upo-topickup': UPOToPickUp,
      'upo-tocomplete': UPOToComplete,
      'upo-todelete': UPOToDelete,
    },

    computed: {
      userProfileOrders() {
        return this.$store.state.userProfileOrders;
      },
      userProfileOrderItems() {
        return this.$store.state.userProfileOrderItems;
      }
    },

    data: () => ({
      navall: true,
      navtp: false,
      navdeli: false,
      navpu: false,
      navcom: false,
      nevdel: false,
    }),

    methods: {
      navigateOrders(cond){
        if(cond == "all"){
          this.navall = true;
          this.navtp = false;
          this.navdeli = false;
          this.navpu = false;
          this.navcom = false;
          this.navdel = false;
        }
        else if(cond == "tp"){
          this.navall = false;
          this.navtp = true;
          this.navdeli = false;
          this.navpu = false;
          this.navcom = false;
          this.navdel = false;
        }
        else if(cond == "dl"){
          this.navall = false;
          this.navtp = false;
          this.navdeli = true;
          this.navpu = false;
          this.navcom = false;
          this.navdel = false;
        }
        else if(cond == "pu"){
          this.navall = false;
          this.navtp = false;
          this.navdeli = false;
          this.navpu = true;
          this.navcom = false;
          this.navdel = false;
        }
        else if(cond == "com"){
          this.navall = false;
          this.navtp = false;
          this.navdeli = false;
          this.navpu = false;
          this.navcom = true;
          this.navdel = false;
        }
        else if(cond == "can"){
          this.navall = false;
          this.navtp = false;
          this.navdeli = false;
          this.navpu = false;
          this.navcom = false;
          this.navdel = true;
        }
      }
    },

    beforeMount() {
      // console.log("Profile my orders");
      
      // console.log(this.userProfileOrders);
      // console.log(this.userProfileOrderItems);
    }
  }
</script>

<style scoped>
.fontBlue{
  color: #1106a0;
}
.fontDesc{
  color: #858585;
}
.fontTitle{
  color: #464646;
}
/* .nBorder{
    border: 1px solid #787885;
    border-radius: 5px;
    border-right-width: 50px;
    border-right: 1px solid #;
    border-spacing: 50px 5px;
    
  } */
</style>