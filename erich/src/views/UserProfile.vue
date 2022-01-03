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
                @click="profileCond('log')"
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
      usersData: {
        usersEmail: "",
        usersPassword: "",
      }
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
          this.callOrders();
        }
        else{
            sessionStorage.removeItem("Email");
            sessionStorage.removeItem("Pass");
            window.location.href = "http://localhost:8080/";
            //window.location.href = "http://erichgrocery.store/";
        }

      },
      getUserOrder() {
        axios.post(this.getDomain()+'api/userorder/store', {
            register: this.usersData.usersEmail
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserProfileOrders', res.data);
          })
          .catch(err => console.error(err));
      },
      getUserOrderDeliver() {
        axios.post(this.getDomain()+'api/userorderdelivery/store', {
            register: this.usersData.usersEmail
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserToDeliver', res.data);
          })
          .catch(err => console.error(err));
      },
      getUserOrderComplete() {
        axios.post(this.getDomain()+'api/userordercomplete/store', {
            register: this.usersData.usersEmail
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserToComplete', res.data);
          })  
          .catch(err => console.error(err));
      },
      getUserPickup() {
        axios.post(this.getDomain()+'api/userorderpickup/store', {
            register: this.usersData.usersEmail
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserPickupOrders', res.data);
          })  
          .catch(err => console.error(err));
      },
      getUserPickupPickup() {
        axios.post(this.getDomain()+'api/userpickuppickup/store', {
            register: this.usersData.usersEmail
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserPickupToPickup', res.data);
          })  
          .catch(err => console.error(err));
      },
      getUserPickupComplete() {
        axios.post(this.getDomain()+'api/userpickupcomplete/store', {
            register: this.usersData.usersEmail
          })
          .then(res => {
            console.log(res.data);
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
      loginChecker(){
        this.usersData.usersEmail = sessionStorage.getItem('Email');
        this.usersData.usersPassword = sessionStorage.getItem('Pass');
        if(this.customerInfos == null){
          this.loginAgain(this.usersData);
        }
        else{
        }
        
      }
    },
    watch: {
      goToOrder(){
        this.callOrders();
      }
    },

    beforeMount() {
      this.loginChecker();
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