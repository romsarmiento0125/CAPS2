<template>
  <div>
    <login-header></login-header>
      <v-container
        fluid
        class="pa-16"
      >
        <v-row>
          <v-col
          >
            <v-card
              class="rounded-xl pa-12"
            >
              <v-card-title
                class="font-weight-black pt-0"
              >
                Registered Customer
              </v-card-title>
              <v-card-subtitle
                class=""
              >
                If you have an account, sign in with your email address
              </v-card-subtitle>
              
              <v-divider></v-divider>
              
              <v-card-text
                class="pa-0 mt-5"
              >
                <span>
                  Email
                </span>
                <v-text-field
                  outlined
                  dense
                  class="mt-1"
                  
                ></v-text-field>
              </v-card-text>

              <v-card-text
                class="pa-0"
              >
                <span>
                  Password
                </span>
                <v-text-field
                  type="password"
                  outlined
                  dense
                  class="mt-1"
                  
                ></v-text-field>
              </v-card-text>

              <v-card-text
                class="d-flex justify-end py-0 mt-n3"
              >
                <a
                  href=""
                  class=""
                >
                  Forgot Your Password?
                </a>
              </v-card-text>

              <v-btn
                class="rounded-lg"
                color="primary"
                
              >
                Sign in
              </v-btn>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
  </div>
</template>

<script>
  import LoginHeader from '../components/Login/LoginHeader.vue'

  export default {
    name: 'Login',

    components: {
      'login-header': LoginHeader,
    }
  }
</script>