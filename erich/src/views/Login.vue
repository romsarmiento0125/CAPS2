<template>
  <div>
    <login-header></login-header>
      <v-container
        fluid
        class="pa-16"
      >
        <v-row>
          <v-col
            offset="4"
            cols="4"
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
                If you have an account, sign in with your number or email address
              </v-card-subtitle>
              
              <v-divider></v-divider>
              
              <v-card-text
                class="pa-0 mt-5"
              >
                <v-text-field
                  v-model="usersData.usersEmail"
                  outlined
                  dense
                  class="mt-1"
                  label="Email"
                ></v-text-field>
              </v-card-text>

              <v-card-text
                class="pa-0"
              >
                <v-text-field
                  v-model="usersData.usersPassword"
                  type="password"
                  outlined
                  dense
                  class="mt-1"
                  label="Password"
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
                @click="userLogin"
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

    data: () => ({
      usersData: {
        usersEmail: "paul@gmail.com",
        usersPassword: "@Admin123"
      }
    }),

    components: {
      'login-header': LoginHeader,
    },

    methods: {
      userLogin() {
        console.log("login");
        // axios.post('', {
        //   userLogin: this.usersData
        // })
        // .then(res => this.accCreateSuccess(res.data))
        // .catch(err => console.error(err));

        axios.post('http://127.0.0.1:8000/api/customerlogin/store',{
          clientCred: this.usersData
        })
        .then(res => this.loginSuccess(res.data))
        .catch(err => console.error(err));
        
      },
      loginSuccess(cinfo) {
        console.log(cinfo);
        if(cinfo == "InvalidCredentials"){
          alert("Invalid Credentials");
        }
        else{
          axios.post('http://127.0.0.1:8000/api/loginaddress/store',{
            clientCred: this.usersData
          })
          .then(res => this.saveInfos(res.data, cinfo))
          //.then(res => console.log(res.data))
          .catch(err => console.error(err));
        }
      },
      saveInfos(data, cinfo) {
        console.log(data);
        this.$store.commit('storeCustomerAddress', data);
        this.$store.commit('storeCustomerInfo', cinfo);
        this.$router.push('/');
      }
    }
  }
</script>