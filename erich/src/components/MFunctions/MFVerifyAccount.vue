<template>
  <div>
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
              Verify Account
            </v-card-title>
            
            <v-divider></v-divider>
            
            <v-card-text
              class="pa-0 mt-5"
            >
              <v-text-field
                v-model="code"
                outlined
                dense
                class="mt-1"
                label="Verification Code"
              ></v-text-field>
            </v-card-text>

            <v-card-text
                class="d-flex justify-end py-0 mt-n3"
              >
                <v-btn
                  plain
                  class="pb-1 indigo--text text--darken-4"
                  @click="sendCode"
                  :disabled="timerCount > 0"
                >
                  
                  <p
                    class="my-0 text-decoration-underline"
                  >Send Code Again</p>
                  <p
                    class="my-0 text-decoration-underline"
                    v-if="timerCount != 0"
                  >
                    &nbsp;In:&nbsp;{{timerCount}}
                  </p>
                </v-btn>
              </v-card-text>

            <v-btn
              dark
              class="rounded-lg px-10"
              color="#1106A0"
              @click="verifyEmail"
            >
              Verify
            </v-btn>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <div class="text-center">
      <v-dialog
        v-model="dialog"
        width="30%"
      >
        <v-card
          class="pt-5"
        >
          <v-card-text class="pb-0">
            <p class="text-h5 text--primary d-inline-block text-truncate d-flex justify-center">
              Hi {{usersFName}} &nbsp; {{usersLName}}
            </p>
            <p class="d-flex justify-center">Verification code sent</p>
            <div class="text--primary d-flex justify-center">
              Kindly check your email <br>
              for the verification code.
            </div>
             <p class="text-h6 text--primary mt-2 mb-0 py-0 d-flex justify-center">
              Thankyou.
            </p>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              text
              color="blue accent-4"
              @click="dialog = false"
            >
              Ok
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </div>
</template>

<script>
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    data: () => ({
      verify: {
        email: "",
        name: "",
        code: "",

      },
      code: "",
      dialog: true,
      timerCount: 0,
      myInterval: null,
    }),

    components: {
    },

    computed: {
      userId(){
        return localStorage.getItem('id');
      },
      usersEmail(){
        return localStorage.getItem('email');
      },
      usersFName(){
        return localStorage.getItem('firstName');
      },
      usersLName(){
        return localStorage.getItem('lastName');
      },
      usersToken(){
        return localStorage.getItem('token');
      },
      userNotif(){
        return this.$store.state.userNotif;
      }
    },

    methods: {
      sendCode(){
        var r1 = Math.floor(Math.random() * 9) + 1;
        var r2 = Math.floor(Math.random() * 9) + 1;
        var r3 = Math.floor(Math.random() * 9) + 1;
        var r4 = Math.floor(Math.random() * 9) + 1;

        this.verify.email = this.usersEmail;
        this.verify.name = this.usersFName + " " +this.usersLName;
        this.verify.code = ""+r1+r2+r3+r4;

        if(this.usersEmail != null){
          axios.post(this.getDomain()+'api/emailverification', {
            email: this.verify
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
          })
          .catch(err => console.error(err));
        }
        else{
          console.log("email not available");
        }
        
        this.Timer();
      },
      verifyEmail(){
        if(this.verify.code == this.code){
          axios.put(this.getDomain()+'api/verifyemail/' + this.userId, {
            usertag: "Customer"
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data)
            if(res.data == "Success"){
              localStorage.setItem("tag", "Customer");
              for(var i = 0; i < this.userNotif.length; i++){
                if(this.userNotif[i].title == "Verify"){
                  axios.put(this.getDomain()+'api/customernotifstatus/' + this.userNotif[i].id, {
                    userstatus: "done"
                  },
                  {
                    headers:{
                      "Authorization": `Bearer ${this.usersToken}`,
                  }
                  })
                  .then(res => {
                    // console.log(res.data);
                  })
                  .catch(err => console.error(err));
                } 
                else{
                }
              }
              this.$router.push("/");
            }
            else{
              // console.log("Unsuccessful")
            }
          })
          .catch(err => console.error(err));
        }
        else{
          alert("Wrong Code");
        }
      },
      Timer(){
        this.timerCount = 30;
        this.myInterval = setInterval(this.myTimer, 1000);
      },
      myTimer() {
        this.timerCount--;
        if(this.timerCount <= 0){
          this.myStopFunction();
        }
      },
      myStopFunction() {
        clearInterval(this.myInterval);
      }
    },
    beforeMount(){
      this.sendCode();
      //this.Timer();
    }
  }
</script>