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
          >
            <div
              class="d-flex"
            >
              <router-link
                to="/"
              >
                <v-img
                  contain
                  src="../../assets/ERICH.svg"
                  max-height="100px"
                  max-width="100px"
                ></v-img>
              </router-link>
              <v-divider
                vertical
              ></v-divider>
              <p
                class="text-h4 ml-4"
              >Shopping cart</p>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>
  </div>
</template>