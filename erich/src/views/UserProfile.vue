<template>
  <div>
    <profile-header></profile-header>
    <v-container
      fluid
      class="mt-10"
    >
      <v-row>
        <v-col
          offset="2"
          cols="1"
        >
          <v-sheet
            color="white"
            elevation="1"
            height="200px"
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
                My Address
              </v-btn>
              <v-btn
                @click="profileCond('mo')"
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
        <v-col
          cols="7"
        >
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
    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      goToAddress() {
        return this.$store.state.userAddress;
      },
      goToOrder() {
        return this.$store.state.userOrder;
      },
    },

    data: () => ({
      mProfile: true,
      mAddress: false,
      mOrders: false,
    }),

    methods: {
      profileCond(cond){
        if(cond == "mp") {
          this.mProfile = true;
          this.mAddress = false;
          this.mOrders = false;
        }
        else if(cond == "mad"){
          this.mProfile = false;
          this.mAddress = true;
          this.mOrders = false;
        }
        else if(cond == "mo"){
          this.mProfile = false;
          this.mAddress = false;
          this.mOrders = true;
        }
        else{
          this.mProfile = true;
          this.mAddress = false;
          this.mOrders = false;
        }
      },
      getUserOrder() {
        axios.post('http://127.0.0.1:8000/api/userorder/store', {
            register: this.customerInfos.Email
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserProfileOrders', res.data);
          })
          .catch(err => console.error(err));
      },
      getUserOrderDeliver() {
        axios.post('http://127.0.0.1:8000/api/userorderdelivery/store', {
            register: this.customerInfos.Email
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserToDeliver', res.data);
          })
          .catch(err => console.error(err));
      },
      getUserOrderComplete() {
        axios.post('http://127.0.0.1:8000/api/userordercomplete/store', {
            register: this.customerInfos.Email
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserToComplete', res.data);
          })  
          .catch(err => console.error(err));
      },
      getUserPickup() {
        axios.post('http://127.0.0.1:8000/api/userorderpickup/store', {
            register: this.customerInfos.Email
          })
          .then(res => {
            console.log(res.data);
            //this.$store.commit('storeUserToComplete', res.data);
          })  
          .catch(err => console.error(err));
      },
    },

    beforeMount() {
      //console.log("user profile");
      //console.log(this.goToAddress);
      this.getUserOrder();
      this.getUserOrderDeliver();
      this.getUserOrderComplete();
      this.getUserPickup();
      if(this.goToAddress){
        this.mProfile = false;
        this.mAddress = true;
        this.mOrders = false;
      }
      if(this.goToOrder){
        this.mProfile = false;
        this.mAddress = false;
        this.mOrders = true;
      }
      this.$store.commit('toAddToOrderFalse');
    }
  }
</script>