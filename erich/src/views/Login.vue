<template>
  <div>
    <login-header></login-header>
      <v-container
        fluid
        class="pa-16"
      >
        <v-row>
          <v-col
            offset-xl="4"
            offset-lg="4"
            offset-md="3"
            xl="4"
            lg="4"
            md="6"
            cols="12"
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
                <v-btn
                  plain
                  x-small
                  @click="forgotPassword"
                >
                  <p
                    class="pb-1 indigo--text text--darken-4 my-0"
                    
                  >
                    Forgot Your Password?
                  </p>
                </v-btn>
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
        usersEmail: "sarmientopaulo01@gmail.com",
        usersPassword: "@Admin123"
      }
    }),

    components: {
      'login-header': LoginHeader,
    },

    methods: {
      forgotPassword(){
        this.$store.commit('notifCond', 'forgotPass');
        this.$router.push("/erich");
      },
      userLogin() {
        axios.post(this.getDomain()+'api/customerlogin',{
          clientCred: this.usersData
        })
        .then(res => {
          this.loginSuccess(res.data)
          // console.log(res.data);
        })
        .catch(err => console.error(err));
        
      },
      loginSuccess(cinfo) {
        // console.log("login Success");
        if(cinfo.status){
          alert("Invalid Credentials");
        }
        else{
          // console.log(cinfo);
          localStorage.setItem("id", cinfo.user.id);
          localStorage.setItem("firstName", cinfo.user.first_Name);
          localStorage.setItem("lastName", cinfo.user.last_Name);
          localStorage.setItem("email", cinfo.user.email);
          localStorage.setItem("mobileNumber", cinfo.user.mobile_Number);
          localStorage.setItem("birthday", cinfo.user.birthday);
          localStorage.setItem("gender", cinfo.user.gender);
          localStorage.setItem("tag", cinfo.user.tag);
          localStorage.setItem("token", cinfo.token);

          axios.post(this.getDomain()+'api/loginaddress/store',{
            clientCred: this.usersData
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeCustomerAddress', res.data);
          })
          .catch(err => console.error(err));
          this.$router.push("/");
        }
      },
    }
  }
</script>
<style scoped>
.fontTitle{
  color: #464646;
}
</style>