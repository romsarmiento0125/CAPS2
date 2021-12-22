<template>
  <div>
    <v-app-bar
      fixed
      color="#FFFFFF"
      height="auto"
    >
      <v-container fluid>
        <v-row class="">
          <!-- Store Logo -->
          <v-col
            class="d-flex align-center"
            offset="1"
            cols="2"
          >
            <router-link
              to="/"
            >
              <v-img
                contain
                src="../../assets/ERICH.svg"
                max-height="120px"
                max-width="120px"
                class="pb-1"
              >
              </v-img>
            </router-link>
          </v-col>

          <!-- Header Search Bar -->
          <v-col
            class="d-flex align-center"
            cols="5"
          >
            <v-text-field
              color="#1106A0"
              append-icon="mdi-magnify"
              hide-details="auto"
              outlined
              dense
              height="small"
              background-color="white"
              placeholder="Search for entire store here.."
            >
            </v-text-field>
            <v-badge
              overlap
              color="#FFA600"
              :content="cartQuantity"
            >
              <v-btn
                height="auto"
                dark
                text
                :to="{name: 'Cart' , params: { id: 'items', title: 'Items'}}"
              >
                <v-icon
                  large
                  color="#1106A0"
                >
                  mdi-cart
                </v-icon>
              </v-btn>
            </v-badge>
          </v-col>

          <!-- Header Buttons -->
          <v-col
            class="d-flex align-center"
            cols="3"
          >
              <v-btn
                white
                text
                medium
                color="#1106A0"
                elevation="0"
              >
                <v-icon>mdi-bell</v-icon>
              </v-btn>
            <div
              class="d-flex"
            >
              <div class="text-center">
                <p
                  class="my-0 py-0 
                  d-flex 
                  "
                >{{customerInfos.First_Name}} {{customerInfos.Last_Name}}</p>
                <v-menu
                  offset-y
                  transition="slide-y-transition"
                  bottom
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      white
                      text
                      v-bind="attrs"
                      v-on="on"
                      class="qfont elevation-5 px-2"
                      color="#1106A0"           
                    >
                      <h4 class="font-weight-black">My Account</h4>
                      <v-spacer></v-spacer>
                      <v-icon>mdi-chevron-down</v-icon>
                    </v-btn>
                  </template>

                  <v-list dense>
                    <v-list-item-group
                      v-model="selectedItem"
                      color="#1106A0"
                      
                    >
                      <v-list-item
                        v-for="(item, n) in items"
                        :key="n"
                      >
                        <v-list-item-icon>
                          <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                          <v-list-item-title v-text="item.text" @click="accountButton(item.to)"></v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>
                    </v-list-item-group>
                  </v-list>
                </v-menu>
               <v-avatar
               class="ml-2"
               >
                 
                <img 
                  src="https://cdn.vuetifyjs.com/images/john.jpg"
                  alt="John"
                >
              </v-avatar>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>
  </div>
</template>

<script>
  export default {
    data: () => ({
      selectedItem: 0,
      items: [
        { title: "Account", text: 'My Account', icon: 'mdi-account', to: "account"  },
        { title: "Address", text: 'My Address', icon: 'mdi-map-marker', to: "address"  },
        { title: "Purchase", text: 'My Purchase', icon: 'mdi-cart', to: "orders"  },
      ],
      customerEmail: "",
      cartCounter: 0,
    }),

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      cartQuantity() {
        return this.$store.state.cartQuantity;
      }
    },

    // watch: {
    //   cartItems: function(data){
    //     console.log("watch",data);
    //   }
    // },  

    methods: {
      accountButton(cond) {
        if(cond == "account"){
          this.$router.push({path: '/profile'});
        }
        else if(cond == "address"){
          //console.log("Admin");
          this.$store.commit('goToAddress');
          this.$router.push({path: '/profile'});
        }
        else if(cond == "orders"){
          //console.log("Admin");
          this.$store.commit('goToOrder');
          this.$router.push({path: '/profile'});
        }
        else if(cond == "admin"){
          //console.log("Admin");
          this.$router.push({path: '/admin/dashboard'});
        }
        else if(cond == "onlinecashier"){
          //console.log("Admin");
          this.$router.push({path: '/onlinecashier'});
        }
        else if(cond == "logout"){
          window.location.href = "http://localhost:8080/";
        }
      },
      getItemsQuantity() {
        //console.log("This is Header Cart quantity");
        //console.log(this.customerInfos.Email);
        this.customerEmail = this.customerInfos.Email;
        axios.post('http://127.0.0.1:8000/api/headercart/store', {
          register: this.customerEmail
        })
        .then(res => this.showQuantity(res.data))
        //.then(res => console.log(res.data))
        .catch(err => console.error(err));
      },
      showQuantity(data){
        //console.log(data[0].Quantity);
        //console.log(data.length);
        for(var i = 0; i < data.length; i++){
          this.cartCounter = this.cartCounter + data[i].Quantity;
        }
        this.$store.commit('storeCartQuantity', this.cartCounter);
      }
    },

    

    // mounted(){
    //   setTimeout(() => {
    //     this.$store.state.cartItems = {cart: 0};
    //   }, 3000);
    // },

    beforeMount(){
      var ob1 = { title: "Admin", text: 'Admin', icon: 'mdi-cog-outline', to: "admin" };
      var ob2 = { title: "Cashier", text: 'Cashier', icon: 'mdi-cash-register', to: "onlinecashier" };
      var ob3 = { title: "Encoder", text: 'Encoder', icon: 'mdi-barcode-scan', to: "admin" };
      var ob4 = { title: "Logout", text: 'Logout', icon: 'mdi-logout', to: "logout"  };
      if(this.customerInfos.Tag == "Admin"){
        this.items.push(ob1);
        this.items.push(ob2);
        this.items.push(ob4);
      }
      else if(this.customerInfos.Tag == "Encoder"){
        this.items.push(ob3);
        this.items.push(ob4);
      }
      else{
        this.items.push(ob4);
      }
      this.getItemsQuantity();
    },
  }
</script>

<style scoped>
@font-face {
  font-family: "Quicksand";
  src: local("Quicksand"),
   url(../../assets/Fonts/Quicksand-Bold.ttf) format("truetype");
}
.qfont{
     font-family: "Quicksand", Helvetica, Arial;
  }


</style>





<!-- <v-btn
  dark
  text
  class="rounded-0"
  style="border-left: 2px solid rgba(255, 255, 255, 0.5);"
  :to="{name: 'Admin' , params: { id: 'dashboard', title: 'DashBoard'}}"
>
  Admin
</v-btn> -->