<template>
  <div
    style="background-color: blue"
  >
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div>
            <v-img
              contain
              src="../../assets/ERICH.svg"
              max-height="100px"
              max-width="100px"
            >
            </v-img>
          </div>
        </v-col>
        <v-col>
          <div>
            <v-btn
              @click="logoutUser"
            >
              <p
                class="title"
              >
                Logout
              </p>
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    methods: {
      logoutUser(){
        sessionStorage.removeItem("Email");
        sessionStorage.removeItem("Pass");
        window.location.href = "http://localhost:8080/";
      }
    }
  }
</script>