<template>
  <div>
    <v-container
      fluid
      class="pa-sm-16"
    >
      <v-row>
        <v-col
          offset-xl="4"
          offset-lg="3"
          offset-md="2"
          xl="4"
          lg="6"
          md="8"
          cols="12"
        >
          
          <v-stepper v-model="e1">
            <v-stepper-header>
              <v-stepper-step
                :complete="e1 > 1"
                step="1"
                class="fontTitle"
              >
                Send Email
              </v-stepper-step>

              <v-divider></v-divider>

              <v-stepper-step
                :complete="e1 > 2"
                step="2"
              >
                Code Verification
              </v-stepper-step>

              <v-divider></v-divider>

              <v-stepper-step step="3">
                Type New Password
              </v-stepper-step>
            </v-stepper-header>

            <v-stepper-items>
              <v-stepper-content step="1">
                <v-card
                  class="px-sm-12 py-5"
                  elevation="0"
                >
                  <v-card-title
                    class="font-weight-black pt-0 pl-0 text-h5 fontTitle"
                  >
                    Send Email
                  </v-card-title>
                  
                  <v-divider></v-divider>
                  
                  <v-card-text
                    class="pa-0 mt-5 "
                  >
                    <v-text-field
                      v-model="verify.email"
                      :rules="emailRules"
                      outlined
                      dense
                      class="mt-1"
                      label="Email"
                    ></v-text-field>
                  </v-card-text>

                  <div
                    class="d-none d-sm-block"
                  >
                    <div
                      class="d-flex justify-end"
                    >
                      <v-btn
                        dark
                        class="rounded-lg px-8 mr-2"
                        color="#1106A0"
                        @click="sendCode"
                      >
                        Send Code
                      </v-btn>
                      <v-btn
                        class="rounded-lg px-10"
                        @click="toLogin"  
                      >
                        Cancell
                      </v-btn>
                    </div>
                  </div>

                  <div
                    class="d-sm-none"
                  >
                    <div class="d-flex justify-end">
                      <v-btn
                        dark
                        class="rounded-lg mr-2"
                        color="#1106A0"
                        @click="sendCode"
                        small
                      >
                        Send Codee
                      </v-btn>
                      <v-btn
                        class="rounded-lg"
                        @click="toLogin"  
                        small
                      >
                        Cancel
                      </v-btn>
                    </div>
                    
                  </div>
                </v-card>

                
              </v-stepper-content>

              <v-stepper-content step="2">
                <v-card
                  class="px-sm-12 py-5"
                  elevation="0"
                >
                  <v-card-title
                    class="font-weight-black pt-0 pl-0 text-h5 fontTitle"
                  >
                    Code Verification
                  </v-card-title>
                  
                  <v-divider></v-divider>
                  
                  <v-card-text
                    class="pa-0 mt-5 "
                  >
                    <v-text-field
                      v-model="code"
                      outlined
                      dense
                      class="mt-1"
                      label="Code"
                    ></v-text-field>
                  </v-card-text>

                  <div
                    class="d-none d-sm-block"
                  >
                    <div class="d-flex justify-end">
                      <v-btn
                        dark
                        class="rounded-lg px-10 mr-2"
                        color="#1106A0"
                        @click="verifyCode"
                      >
                        Verify Code
                      </v-btn>
                      <v-btn
                        class="rounded-lg px-10"
                        @click="toLogin"  
                      >
                        Cancel
                      </v-btn>
                    </div>
                  </div>

                  <div class="d-sm-none">
                    <div class="d-flex justify-end">
                      <v-btn
                        dark
                        class="rounded-lg"
                        color="#1106A0"
                        @click="verifyCode"
                        small
                      >
                        Verify Code
                      </v-btn>
                      <v-btn
                        class="rounded-lg"
                        @click="toLogin"
                        small
                      >
                        Cancel
                      </v-btn>
                    </div>
                  </div>
                </v-card>
              </v-stepper-content>

              <v-stepper-content step="3">
                <v-card
                  class="px-sm-12 py-sm-5"
                  elevation="0"
                >
                  <v-card-title
                    class="font-weight-black pt-0 pl-0 text-h5 fontTitle"
                  >
                    New Password
                  </v-card-title>
                  
                  <v-divider></v-divider>
                  
                  <v-card-text
                    class="pa-0 mt-5 "
                  >
                    <div
                      class="d-flex"
                    >
                      <v-text-field
                        v-model="newPass"
                        :type="passType"
                        outlined
                        dense
                        class="mt-1"
                        label="New Password"
                        hint="Use 8 or more letters with a mix of letters, numbers & symbols"
                        :append-icon="passIcon"
                        @click:append="passShow"
                        v-on:keyup="checkPassword()"
                      ></v-text-field>
                      <v-subheader
                        class=""
                      >
                        <span
                          :class="pStrengthClass"
                        >{{pStrength}}</span>
                      </v-subheader>
                    </div>
                    
                  </v-card-text>

                  <div
                    class="d-none d-sm-block"
                  >
                    <div
                      class="d-flex justify-end"
                    >
                      <v-btn
                        dark
                        class="rounded-lg px-8 mr-2"
                        color="#1106A0"
                        @click="changePass"
                      >
                        Change Password
                      </v-btn>
                      <v-btn
                        class="rounded-lg px-10"
                        @click="toLogin"  
                      >
                        Cancel
                      </v-btn>
                    </div>
                  </div>
                  
                  <div
                    class="d-sm-none"
                  >
                    <div
                      class="d-flex justify-end"
                    >
                      <v-btn
                        dark
                        class="rounded-lg"
                        color="#1106A0"
                        @click="changePass"
                        small
                      >
                        Change Password
                      </v-btn>
                      <v-btn
                        class="rounded-lg"
                        @click="toLogin" 
                        small
                      >
                        Cancel
                      </v-btn>
                    </div>
                  </div>
                </v-card>
              </v-stepper-content>
            </v-stepper-items>
          </v-stepper>
        </v-col>
      </v-row>
    </v-container>
    <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
    >
      {{ prompt }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="blue"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>

<script>
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    data: () => ({
      passIcon: "mdi-eye-off",
      passType: "Password",
      pStrengthClass: "green white--text pa-1 rounded",
      pStrength: "",
      snackbar: false,
      timeout: 4000,
      prompt: '',
      verify: {
        email: "",
        code: "",
      },
      newPass: "",
      id: "",
      code: "",
      e1: 1,
      emailRules: [
        v => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid',
      ],
    }),

    components: {
    },

    computed: {

    },

    methods: {
      checkPassword(){
        if((/[A-Z]/.test(this.newPass)) && (/[a-z]/.test(this.newPass)) && (/[0-9]/.test(this.newPass)) &&
        (/[#?!@$%^&*-]/.test(this.newPass)) && (this.newPass.length >= 8)){
          this.pStrength = "Very Strong";
          this.pStrengthClass = "green white--text pa-1 rounded";
        }
        else if(this.newPass.length >= 24){
          this.pStrength = "Very Strong";
          this.pStrengthClass = "green white--text pa-1 rounded";
        }
        else if(this.newPass.length <= 7){
          this.pStrength = "Weak";
          this.pStrengthClass = "red white--text pa-1 rounded";
        }
        else{
          this.pStrength = "Strong";
          this.pStrengthClass = "yellow black--text pa-1 rounded";
        }
      },
      passShow(){
        this.passIcon = this.passIcon == "mdi-eye-off" ? 'mdi-eye' : 'mdi-eye-off';
        this.passType = this.passIcon == "mdi-eye-off" ? 'Password' : 'text';
      },
      sendCode(){
        var r1 = Math.floor(Math.random() * 9) + 1;
        var r2 = Math.floor(Math.random() * 9) + 1;
        var r3 = Math.floor(Math.random() * 9) + 1;
        var r4 = Math.floor(Math.random() * 9) + 1;

        if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.verify.email)){
          this.verify.code = ""+r1+r2+r3+r4;
          this.e1 = 2;
          axios.post(this.getDomain()+'api/sendcode', {
            find: this.verify
          })
          .then(res => {
            // console.log(res.data)
            this.id = res.data;
          })
          .catch(err => console.error(err));
        }
        else{
          alert("Email Invalid.");
        }
        
      },
      verifyCode(){
        if(this.code == this.verify.code){
          this.e1 = 3;
        }
        else{
          alert("Invalid Code");
        }
      },
      changePass(){
        if(this.newPass.length >= 8)
        {
          if(this.id != ""){
            axios.put(this.getDomain()+'api/changepass/' + this.id, {
              pass: this.newPass
            })
            .then(res => {  
              if(res.data != null){
                // console.log(res.data)
                this.$router.push("/login");
              }
            })
            .catch(err => console.error(err));
          }
        }
        else{
          this.snackbar = true;
          this.prompt = "Password too short"; 
        }
        
      },
      toLogin(){
        this.$router.push("/login");
      }
    },

    beforeMount(){

    }
  }
</script>

<style scoped>
.rounded-card{
  border-radius: 15px;
}
.fontBlue{
  color: #1106A0;
}
.fontTitle{
  color: #464646;
}
.fontDesc{
  color: #858585;
}
.qfont{
     font-family: "Quicksand", Helvetica, Arial;
  }
.btn{
  color:"#fff"
}

.no-uppercase{
 text-transform: none;
}

</style>