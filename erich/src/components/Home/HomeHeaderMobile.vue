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
            cols="4"
          >
            <router-link
              to="/"
            >
              <v-img
                contain
                src="../../assets/ERICHNEW.svg"
                max-height="100px"
                max-width="100px"
                class="pb-1"
              >
                <a href="/"></a>
              </v-img>
            </router-link>
          </v-col>
          <v-col
            cols="8 d-flex justify-end"
          >
            <div
              class="qfont d-flex align-center"
            >
              <div
                class=""
              >
                <v-btn
                  small
                  outlined             
                  color="#1106A0"
                  white
                  to="/signup"             
                >
                  Sign Up
                </v-btn>
                <v-btn
                  class="ml-1 indigo--text text--darken-4"
                  small
                  white
                  color="white"                
                  to="/login"
                >
                  Login
                </v-btn>
              </div>
              
            </div>
          </v-col>

          <v-col
            cols="12"
            class="py-0"
          >
            <v-text-field
              rounded
              outlined
              class="pb-1"
              color="#1106A0"
              hide-details="auto"
              prepend-inner-icon="mdi-magnify"
              dense
              background-color="EDEDF0"
              placeholder="Search for entire store here.."
              v-model="searchKey"
              v-on:keyup="toSearch(searchKey)"
            >
            </v-text-field>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>
  </div>
</template>

<script>
  export default {
     data: () => ({
      searchKey: "",
    }),
    computed: {
      imageLink() {
        return this.$store.state.imageLink;
      },
    },

    methods: {
      toHome() {
        alert("gg");
      },
      toSearch(data){
        this.$store.commit('searchItem', data);
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