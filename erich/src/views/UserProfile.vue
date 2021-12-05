<template>
  <div>
    <profile-header></profile-header>
    <v-container
      fluid
      class="mt-10"
    >
      <v-row>
        <v-col
          offset="1"
          cols="1"
        >
          <v-sheet
            color="white"
            elevation="1"
            height="100%"
            width="100%"
          >
            <div>
              <v-btn
                @click="profileCond('mp')"
                plain
              >
                My Profile
              </v-btn>
              <v-btn
                @click="profileCond('mad')"
                plain
              >
                My Adress
              </v-btn>
              <v-btn
                plain
              >
                My Orders
              </v-btn>
              <v-btn
                plain
              >
                Logout
              </v-btn>
            </div>
          </v-sheet>
        </v-col>
        <v-col>
          <profile-myprofile v-if="mProfile"></profile-myprofile>
          <profile-myaddress v-else-if="mAddress"></profile-myaddress>
          <profile-myorders v-else-if="mOrders"></profile-myorders>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import ProfileHeader from '../components/UserProfiles/ProfileHeader.vue'
  import ProfileMyProfile from '../components/UserProfiles/ProfileMyProfile.vue'
  import ProfileMyAdress from '../components/UserProfiles/ProfileMyAddress.vue'
  import profileMyOrders from '../components/UserProfiles/ProfileMyOrders.vue'

  export default {
    components: {
      'profile-header': ProfileHeader,
      'profile-myprofile': ProfileMyProfile,
      'profile-myaddress': ProfileMyAdress,
      'profile-myorders': profileMyOrders
    },

    data: () => ({
      mProfile: true,
      mAddress: false,
      mOrders: false,
    }),

    methods: {
      profileCond(cond){
        if(cond == "mad"){
          this.mProfile = false;
          this.mAddress = true;
          this.mOrders = false;
        }
        else{
          this.mProfile = true;
          this.mAddress = false;
          this.mOrders = false;
        }
      }
    }
  }
</script>