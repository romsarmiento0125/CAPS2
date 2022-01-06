<template>
  <div>
    <profile-header></profile-header>
    <v-container
      fluid
      class="mt-10"
    >
      <v-row>
        <v-col
          offset-xl="2"
          xl="1"
          lg="2"
          md="2"
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
                @click="profileCond('log')"
              >
                Logout
              </v-btn>
            </div>
          </v-sheet>
        </v-col>
        <v-col
          xl="7"
          lg="10"
          md="10"
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
  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    components: {
      'profile-header': ProfileHeader,
      'profile-myprofile': ProfileMyProfile,
      'profile-myaddress': ProfileMyAdress,
      'profile-myorders': profileMyOrders
    },
    computed: {
      goToAddress() {
        return this.$store.state.userAddress;
      },
      goToOrder() {
        return this.$store.state.userOrder;
      },
      usersEmail(){
        return localStorage.getItem('email');
      },
      usersToken(){
        return localStorage.getItem('token');
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
            localStorage.removeItem("firstName");
            localStorage.removeItem("lastName");
            localStorage.removeItem("email");
            localStorage.removeItem("mobileNumber");
            localStorage.removeItem("birthday");
            localStorage.removeItem("gender");
            localStorage.removeItem("tag");
            localStorage.removeItem("token");
            window.location.href = "http://localhost:8080/";
            // window.location.href = "http://erichgrocery.store/";
        }

      },
      getUserOrder() {
        axios.post(this.getDomain()+'api/userorder/store', {
            register: this.usersEmail
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeUserProfileOrders', res.data);
          })
          .catch(err => console.error(err));
      },
      getUserOrderDeliver() {
        axios.post(this.getDomain()+'api/userorderdelivery/store', {
            register: this.usersEmail
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeUserToDeliver', res.data);
          })
          .catch(err => console.error(err));
      },
      getUserOrderComplete() {
        axios.post(this.getDomain()+'api/userordercomplete/store', {
            register: this.usersEmail
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeUserToComplete', res.data);
          })  
          .catch(err => console.error(err));
      },
      getUserPickup() {
        axios.post(this.getDomain()+'api/userorderpickup/store', {
            register: this.usersEmail
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeUserPickupOrders', res.data);
          })  
          .catch(err => console.error(err));
      },
      getUserPickupPickup() {
        axios.post(this.getDomain()+'api/userpickuppickup/store', {
            register: this.usersEmail
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeUserPickupToPickup', res.data);
          })  
          .catch(err => console.error(err));
      },
      getUserPickupComplete() {
        axios.post(this.getDomain()+'api/userpickupcomplete/store', {
            register: this.usersEmail
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeUserPickupToComplete', res.data);
          })  
          .catch(err => console.error(err));
      },
      callOrders(){
        this.getUserOrder();
        this.getUserOrderDeliver();
        this.getUserOrderComplete();
        this.getUserPickup();
        this.getUserPickupPickup();
        this.getUserPickupComplete();
      },
    },

    beforeMount() {
      this.callOrders();
      //console.log("user profile");
      //console.log(this.goToAddress);
      
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