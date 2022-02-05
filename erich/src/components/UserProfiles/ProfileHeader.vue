<template>
  <div>
    <v-app-bar
      color="#FFFFFF"
      height="auto"
    >
      <v-container fluid>
        <v-row>
          <v-col
            cols="5"
            class="d-none d-md-block"
          >
            <div
              class="d-flex"
            >
              <router-link
                to="/"
              >
                <v-img
                  contain
                  src="../../assets/ERICHNEW.svg"
                  max-height="120px"
                  max-width="120px"
                  class="mr-2"
                ></v-img>
              </router-link>
              <v-divider
                vertical
              ></v-divider>
              <h3
                class="my-0 ml-3 pt-2 grey--text text--darken-1"
              >My Account</h3>
            </div>
          </v-col>

           <v-col
            cols="12"
            class="d-md-none"
          >
            <div
              class="d-flex"
            >
              <router-link
                to="/"
              >
                <v-img
                  contain
                  src="../../assets/ERICHNEW.svg"
                  max-height="120px"
                  max-width="120px"
                  class="mr-2"
                ></v-img>
              </router-link>
              <v-divider
                vertical
              ></v-divider>
              <h3
                class="my-0 ml-3 pt-2 grey--text text--darken-1 fontSize"
              >My Account</h3>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>
  </div>
</template>

<style scoped>
.fontSize{
  font-size: 2vh;
}
</style>
