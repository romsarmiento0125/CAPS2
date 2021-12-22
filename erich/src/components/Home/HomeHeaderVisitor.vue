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
              class="py-2"
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
            <v-btn
              height="auto"
              dark
              text
              to="/login"
            >
              <v-icon
                large
                color="#1106A0"
              >
                mdi-cart
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
              class="d-flex 
              ml-10 
              qfont 
              "
            >
                <!-- <v-btn
                white
                text
              >
                <v-icon
                
                medium
                color="#1106A0"
                class="ev"
                >mdi-bell</v-icon>
              </v-btn> -->
              <v-btn
                medium
                outlined             
                color="#1106A0"
                white
                to="/signup"             
              >
                Sign Up
              </v-btn>
              <v-btn
                class="ml-3 indigo--text text--darken-4"
                medium
                white
                color="white"                
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