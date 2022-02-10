<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          cols="12"
        >
          <v-sheet
            class="pl-sm-5"
          >
            <v-row>
              <v-col>
                <div class="pa-5">
                  <h3
                    class="fontTitle"
                  >My Profile</h3>
                  <h5 class="fontDesc font-weight-regular"
                  >Manage and protect your account.</h5>
                </div>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col
                cols="12"
              >
                <div
                  class="d-none d-sm-block"
                >
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h4
                      class="mr-sm-2 my-0 mt-1 fontTitle"
                    >Username:</h4>
                    <h5
                      class="my-0 py-1 px-14  fontTitle font-weight-regular"
                    >{{Username}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h4
                      class="mr-8 my-0 mt-1 fontTitle"
                    >Name:</h4>
                    <h5
                      class="my-0 py-1 px-16  fontTitle font-weight-regular"
                    >{{Name}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h4
                      class="mr-4 my-0 mt-1 fontTitle"
                    >Surname:</h4>
                    <h5
                      class="my-0 py-1 px-14 fontTitle font-weight-regular"
                    >{{Surname}}</h5>
                  </div>
                  <div
                    class="d-flex align-center mt-5 ml-5"
                  >
                    <h4
                      class="mr-2 my-0 fontTitle"
                    >Email:</h4>
                    <h5
                      class="my-0 py-1 px-16 ml-6  fontTitle font-weight-regular"
                    >{{Email}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h4
                      class="mr-2 my-0 fontTitle"
                    >Phone number:</h4>
                    <h5
                      class="my-0 py-1 px-5 fontTitle font-weight-regular"
                    >{{Mobilenumber}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h4
                      class="mr-2 my-0"
                    >Date of birth:</h4>
                    <h5
                      class="my-0 py-1  px-9  fontTitle font-weight-regular"
                    >{{Birthday}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h4
                      class="mr-2 my-0 fontTitle"
                    >Gender:</h4>
                    <h5
                      class="my-0 py-1 ml-1 px-16  fontTitle font-weight-regular"
                    >{{Gender}}</h5>
                  </div>
                </div>

                <div
                  class="d-sm-none"
                >
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h5
                      class="mr-1 my-0 mt-1 fontTitle"
                    >Username:</h5>
                    <h5
                      class="my-0 py-1 px-1  fontTitle font-weight-regular"
                    >{{Username}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h5
                      class="mr-1 my-0 mt-1 fontTitle"
                    >Name:</h5>
                    <h5
                      class="my-0 py-1 px-1  fontTitle font-weight-regular"
                    >{{Name}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h5
                      class="mr-1 my-0 mt-1 fontTitle"
                    >Surname:</h5>
                    <h5
                      class="my-0 py-1 px-1 fontTitle font-weight-regular"
                    >{{Surname}}</h5>
                  </div>
                  <div
                    class="d-flex align-center mt-5 ml-5"
                  >
                    <h5
                      class="mr-1 my-0 fontTitle"
                    >Email:</h5>
                    <h5
                      class="my-0 py-1 px-1 fontTitle font-weight-regular"
                    >{{Email}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h5
                      class="mr-1 my-0 fontTitle"
                    >Phone number:</h5>
                    <h5
                      class="my-0 px-1 fontTitle font-weight-regular"
                    >{{Mobilenumber}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h5
                      class="mr-1 my-0"
                    >Date of birth:</h5>
                    <h5
                      class="my-0 px-1  fontTitle font-weight-regular"
                    >{{Birthday}}</h5>
                  </div>
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <h5
                      class="mr-1 my-0 fontTitle"
                    >Gender:</h5>
                    <h5
                      class="my-0 ml-1 px-1  fontTitle font-weight-regular"
                    >{{Gender}}</h5>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      Username: "",
      Name: "",
      Surname: "",
      Email: "",
      Mobilenumber: "",
      Birthday: "",
      Gender: "",
      dialog: false,
      activePicker: null,
      date: null,
      menu: false,
    }),

    computed: {
      usersEmail(){
        return localStorage.getItem('email');
      },
      usersFName(){
        return localStorage.getItem('firstName');
      },
      usersLName(){
        return localStorage.getItem('lastName');
      },
      usersMobileNumber(){
        return localStorage.getItem('mobileNumber');
      },
      usersBirthday(){
        return localStorage.getItem('birthday');
      },
      usersGender(){
        return localStorage.getItem('gender');
      },
    },

    watch: {
      menu(val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },

    methods: {
      saveCredentials(){
        this.Username = this.usersFName + " " + this.usersLName;
        this.Name = this.usersFName;
        this.Surname = this.usersLName;
        this.Email = this.usersEmail;
        this.Mobilenumber = this.usersMobileNumber;
        this.Birthday = this.usersBirthday;
        this.Gender = this.usersGender;
        this.Account = this.usersTag;
      }
    },
    
    beforeMount() {
      this.saveCredentials();
      //this.getCustomerInfo();
      //console.log(this.customerInfos);
    }
  }
</script>

<style scoped>
.fontBlue{
  color: #1106a0;
}
.fontDesc{
  color: #858585;
}
.fontTitle{
  color: #464646;
}
/* .nBorder{
    border: 1px solid #787885;
    border-radius: 5px;
    border-right-width: 50px;
    border-right: 1px solid #;
    border-spacing: 50px 5px;
    
  } */
</style>