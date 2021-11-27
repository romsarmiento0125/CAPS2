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
                max-height="100px"
                max-width="100px"
              >
                <a href="/"></a>
              </v-img>
            </router-link>
          </v-col>

          <!-- Header Search Bar -->
          <v-col
            class="d-flex align-center"
            cols="6"
          >
            <v-text-field
              append-icon="mdi-magnify"
              hide-details="auto"
              outlined
              dense
              height="small"
              background-color="white"
              placeholder="Search for entire store here.."
            >
            </v-text-field>
            <v-btn
              height="auto"
              dark
              text
              :to="{name: 'Cart' , params: { id: 'items', title: 'Items'}}"
            >
              <v-icon
                large
                color="blue"
              >
                mdi-cart-outline
              </v-icon>
              <span
                class="white--text"
              >
                00
              </span>
            </v-btn>
          </v-col>

          <!-- Header Buttons -->
          <v-col
            class="d-flex align-center"
            cols="2"
          >
            <div
              class="d-flex"
            >
              <v-btn
                white
                text
              >
                <v-icon>mdi-bell-outline</v-icon>
              </v-btn>
              <div class="text-center">
                <p
                  class="ma-0 pa-0"
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
                      class=""
                    >
                      <h4>My Acoount</h4>
                      <v-icon>mdi-chevron-down</v-icon>
                    </v-btn>
                  </template>

                  <v-list dense>
                    <v-list-item-group
                      v-model="selectedItem"
                      color="primary"
                      
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
               <v-avatar>
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
        { title: "Purchase", text: 'My Purchase', icon: 'mdi-cart', to: "account"  },
      ],
    }),

    methods: {
      accountButton(cond) {
        if(cond == "account"){
          this.$router.push({path: '/profile'});
        }
        else if(cond == "admin"){
          console.log("Admin");
          this.$router.push({path: '/admin/dashboard'});
        }
        else if(cond == "logout"){
          window.location.href = "http://localhost:8080/";
        }
      }
    },

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      }
    },

    beforeMount(){
      var ob1 = { title: "Admin", text: 'Admin', icon: 'mdi-cog-outline', to: "admin" };
      var ob2 = { title: "Cashier", text: 'Cashier', icon: 'mdi-cash-register', to: "admin" };
      var ob3 = { title: "Encoder", text: 'Encoder', icon: 'mdi-barcode-scan', to: "admin" };
      var ob4 = { title: "Logout", text: 'Logout', icon: 'mdi-logout', to: "logout"  };
      if(this.customerInfos.Tag == "Admin"){
        this.items.push(ob1);
        this.items.push(ob4);
      }
      else if(this.customerInfos.Tag == "Cashier"){
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
    },
  }
</script>

<!-- <v-btn
  dark
  text
  class="rounded-0"
  style="border-left: 2px solid rgba(255, 255, 255, 0.5);"
  :to="{name: 'Admin' , params: { id: 'dashboard', title: 'DashBoard'}}"
>
  Admin
</v-btn> -->