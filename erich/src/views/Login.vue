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
                class="font-weight-black pt-0 pl-0 text-h5 fontTitle"
              >
                Registered Customer
              </v-card-title>
              <v-card-subtitle
                class="pl-0"
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
                  class="pb-1 indigo--text text--darken-4"
                  
                >
                  Forgot Your Password?
                </a>
              </v-card-text>

              <v-btn
                dark
                class="rounded-lg px-10"
                color="#1106A0"
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
  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: 'Login',

    data: () => ({
      usersData: {
        // usersEmail: "",
        // usersPassword: ""
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

        axios.post(this.getDomain()+'api/customerlogin/store',{
          clientCred: this.usersData
        })
        .then(res => this.loginSuccess(res.data))
        .catch(err => console.error(err));
        
      },
      loginSuccess(cinfo) {
        //console.log(cinfo);
        if(cinfo == "InvalidCredentials"){
          alert("Invalid Credentials");
        }
        else{
          axios.post(this.getDomain()+'api/loginaddress/store',{
            clientCred: this.usersData
          })
          .then(res => this.saveInfos(res.data, cinfo))
          //.then(res => console.log(res.data))
          .catch(err => console.error(err));

          sessionStorage.setItem("Email", this.usersData.usersEmail);
          sessionStorage.setItem("Pass", this.usersData.usersPassword);
        }
      },
      saveInfos(data, cinfo) {
        //console.log(data);
        this.$store.commit('storeCustomerAddress', data);
        this.$store.commit('storeCustomerInfo', cinfo);
        this.$router.push('/');
      }
    }
  }
</script>
<style scoped>
.fontTitle{
  color: #464646;
}
</style>