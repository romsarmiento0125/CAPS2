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
          cols="12"
        >
          <v-sheet
            color="white"
            elevation="1"
            height="100%"
            width="100%"
          >
            <div class="py-7">
              <v-btn
                
                @click="profileCond('mp')"
                plain
              >
                <h3 class="no-uppercase"> My Profile </h3>
              </v-btn>
              <v-btn
                @click="profileCond('mad')"
                plain
              >
                <h3 class="no-uppercase"> My Address </h3>
              </v-btn>
              <v-btn
                @click="profileCond('mo')"
                plain
              >
                <h3 class="no-uppercase"> My Orders </h3>
              </v-btn>
              <v-btn
                plain
                @click="profileCond('log')"
              >
                <h3 class="no-uppercase"> Logout </h3>
              </v-btn>
            </div>
          </v-sheet>
        </v-col>
        <v-col
          xl="7"
          lg="10"
          md="10"
          cols="12"
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
      usersData: {
        usersEmail: "",
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
        }
        else{
            localStorage.removeItem("firstName");
            localStorage.removeItem("lastName");
            localStorage.removeItem("email");
            localStorage.removeItem("mobileNumber");
            localStorage.removeItem("birthday");
            localStorage.removeItem("gender");
            localStorage.removeItem("token");
            localStorage.removeItem("id");
            window.location.href = this.getLogout();
        }

      },
      callOrders(){
        axios.post(this.getDomain()+'api/userall/store', {
          register: this.usersEmail
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          // console.log(res.data);
          this.$store.commit('storeUserProfileOrders', res.data.dtpack);
          this.$store.commit('storeUserToDeliver', res.data.dtdel);
          this.$store.commit('storeUserToComplete', res.data.dtcomp);
          this.$store.commit('storeUserToCancel', res.data.dtcancel);
          this.$store.commit('storeUserPickupOrders', res.data.ptpack);
          this.$store.commit('storeUserPickupToPickup', res.data.ptpick);
          this.$store.commit('storeUserPickupToComplete', res.data.ptcomp);
          this.$store.commit('storeUserPickupToCancel', res.data.ptcancel);
        })
        .catch(err => console.error(err));
      },
    },

    beforeMount() {
      this.callOrders();
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

<style scoped>
.fontBlue{
  color:#1106A0;
}
.no-uppercase{
 text-transform: none;
}

</style>