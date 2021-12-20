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
          class="mx-5"
        >
          <v-col>
            <v-btn>
              <p>All</p>
            </v-btn>
          </v-col>
          <v-col>
            <v-btn>
              <p>To Pack</p>
            </v-btn>
          </v-col>
          <v-col>
            <v-btn>
              <p>To Receive</p>
            </v-btn>
          </v-col>
          <v-col>
            <v-btn>
              <p>To Pickup</p>
            </v-btn>
          </v-col>
          <v-col>
            <v-btn>
              <p>Complete</p>
            </v-btn>
          </v-col>
          <v-col>
            <v-btn>
              <p>Cancelled</p>
            </v-btn>
          </v-col>
        </v-row>
      </v-sheet>
      <v-sheet>
        <v-row>
          <v-col>
            <div class="mt-5"></div>
            <v-divider></v-divider>
            <div>
              <upo-allitems></upo-allitems>
            </div>
            <v-divider></v-divider>
            <div class="mb-5"></div>
          </v-col>
        </v-row>
      </v-sheet>
    </v-container>
  </div>
</template>

<script>
  import UPOAllItem from './UserProfileOrders/OrderAllItem.vue'

  export default {
    components: {
      'upo-allitems': UPOAllItem,
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
      
    }),

    methods: {
       
    },

    beforeMount() {
      console.log("Profile my orders");
      
      console.log(this.userProfileOrders);
      console.log(this.userProfileOrderItems);
    }
  }
</script>