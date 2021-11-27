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
              <v-btn
                white
                text
                to="/signup"
              >
                Sign Up
              </v-btn>
              <v-btn
                white
                text
                class="rounded-0"
                to="/login"
              >
                Login
              </v-btn>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>
  </div>
</template>

<script>
  export default {
    methods: {
      toHome() {
        alert("gg");
      }
    }
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