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
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <v-btn
                      @click="dialog = true"
                      color="#1106A0"
                      dark
                      outlined
                      small
                    >
                      <p
                        class="my-0"
                      >Edit</p>
                    </v-btn>
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
                  <div
                    class="d-flex mt-5 ml-5"
                  >
                    <v-btn
                      @click="dialog = true"
                      color="#1106A0"
                      dark
                      outlined
                      small
                    >
                      <p
                        class="my-0"
                      >Edit</p>
                    </v-btn>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          User Profiles
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <!-- First Row -->
              <v-col
                cols="12"
                md="4"
              >
                <v-text-field
                  v-model="Name"
                  label="Name"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="4"
              >
                <v-text-field
                  v-model="Surname"
                  label="Surname"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="4"
              >
                <v-text-field
                  :rules="mobileNumRules"
                  type="number"
                  v-model="Mobilenumber"
                  label="Phone number"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <!-- Second Row -->
              <v-col
                cols="12"
                md="4"
              >
                <div class="py-0 px-0 pb-0">
                  <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="Birthday"
                        label="Date Of Birth"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="Birthday"
                      :active-picker.sync="activePicker"
                      :max="maxDate"
                      min="1950-01-01"
                      @change="save"
                    ></v-date-picker>
                  </v-menu>
                </div>
              </v-col>
              
              <v-col
                cols="12"
                md="8"
              >
                <div>                
                  <p>Gender</p>
                  <v-radio-group
                    v-model="Gender"
                    row
                  >
                    <v-radio
                      color="#1106A0"
                      label="Male"
                      value="Male"
                    ></v-radio>
                    <v-radio
                    color="#1106A0"
                      label="Female"
                      value="Female"
                    ></v-radio>
                    <v-radio
                    color="#1106A0"
                      label="Prefer not to say"
                      value="Other"
                    ></v-radio>
                  </v-radio-group>
                </div>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            text
            @click="dialog = false"
          >
            Cancel
          </v-btn>
          <v-btn
            color="primary"
            text
            @click="saveCredentials"
          >
            Update
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    data: () => ({
      id: "",
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
      mobileNumRules: [
        v => (v.length == 11) || 'Mobile number is invalid',
        v => (v.length == 11) || 'Mobile number is invalid',
      ],
      maxDate: null,
    }),

    computed: {
      usersId(){
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
      usersMobileNumber(){
        return localStorage.getItem('mobileNumber');
      },
      usersBirthday(){
        return localStorage.getItem('birthday');
      },
      usersGender(){
        return localStorage.getItem('gender');
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    watch: {
      menu(val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },

    methods: {
      saveCredentials(){
        this.dialog = false;
        // console.log(this.Name);
        // console.log(this.Surname);
        // console.log(this.Mobilenumber);
        // console.log(this.Birthday);
        // console.log(this.Gender);
        // console.log(this.id);

        axios.put(this.getDomain()+'api/updateCreds/'+this.id, {
          name: this.Name,
          surname: this.Surname,
          number: this.Mobilenumber,
          birthday: this.Birthday,
          gender: this.Gender
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
          }
        })
        .then(res => {
          // console.log(res.data.data);
          localStorage.setItem("id", res.data.data.id);
          localStorage.setItem("firstName", res.data.data.first_Name);
          localStorage.setItem("lastName", res.data.data.last_Name);
          localStorage.setItem("mobileNumber", res.data.data.mobile_Number);
          localStorage.setItem("birthday", res.data.data.birthday);
          localStorage.setItem("gender", res.data.data.gender);
          this.Username = res.data.data.first_Name + " " + res.data.data.last_Name;
          this.Name = res.data.data.first_Name;
          this.Surname = res.data.data.last_Name;
          this.Mobilenumber = res.data.data.mobile_Number;
          this.Birthday = res.data.data.birthday;
          this.Gender = res.data.data.gender;
        })
        .catch(err => console.error(err));
      },
      showCred() {
        this.id = this.usersId;
        this.Username = this.usersFName + " " + this.usersLName;
        this.Name = this.usersFName;
        this.Surname = this.usersLName;
        this.Email = this.usersEmail;
        this.Mobilenumber = this.usersMobileNumber;
        this.Birthday = this.usersBirthday;
        this.Gender = this.usersGender;
      },  
      save (date) {
        this.$refs.menu.save(date)
      },
    },
    
    beforeMount() {
      this.showCred();

      var today = new Date();
      var day = String(today.getDate()).padStart(2, '0');
      var month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var year = today.getFullYear();
      this.maxDate = (year - 13) + "-" + month + "-" + day;
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