<template>
  <div
    style="background-color: #1106A0"
  >
    <v-container
      fluid
    >
      <v-row>
        <v-col cols="6" class="my-1 px-10">
          <div>
            <v-img
              contain
              src="../../assets/ERICHWHITE.svg"
              max-height="120px"
              max-width="120px"
            >
            </v-img>
          </div>
        </v-col>

        <v-col cols="6">
          <div class="d-flex justify-end my-1 px-10">
            <v-btn
              plain
              text
              dark
              @click="logoutUser"
            >
              <h3
                
              >
                Logout
              </h3>
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    methods: {
      logoutUser(){
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
    }
  }
</script>