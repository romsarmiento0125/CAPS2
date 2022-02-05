<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          cols="12"
          class="d-none d-md-block"
        >
          <v-sheet
            class="pl-5"
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
                cols="8"
              >
              <div
                  class="d-flex mt-5 ml-5"
                >
                  <h4
                    class="mr-2 my-0 mt-1 fontTitle"
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
                  <!-- <v-btn
                    plain
                    x-small
                    color="primary"
                    @click="editUserEmail"
                  >
                    <p
                      class="my-0"
                    >change</p>
                  </v-btn> -->
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
                  class="d-flex mt-5 ml-5 mb-5"
                >
                  <h4
                    class="mr-2 my-0 fontTitle"
                  >Account:</h4>
                  
                  <h5
                    class="my-0 py-1  px-15  fontTitle font-weight-regular"
                  >{{Account}}</h5>
                </div>
                <!-- <div
                  class="mt-6"
                >
                  <v-dialog
                    v-model="dialog"
                    persistent
                    max-width="600px"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="primary"
                        dark
                        v-bind="attrs"
                        v-on="on"
                      >
                        Edit
                      </v-btn>
                    </template>
                    <v-card>
                      <v-card-title>
                        <span class="text-h5">User Profile</span>
                      </v-card-title>
                      <v-card-text>
                        <v-container>
                          <v-row>
                            <v-col
                              cols="6"
                            >
                              <v-text-field
                                label="First Name"
                                required
                                v-model="Name"
                              ></v-text-field>
                            </v-col>
                            <v-col
                              cols="6"
                            >
                              <v-text-field
                                label="Last Name"
                                required
                                v-model="Username"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field
                                label="Phone Number"
                                required
                                v-model="Mobilenumber"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
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
                                    outlined
                                  ></v-text-field>
                                </template>
                                <v-date-picker
                                  v-model="Birthday"
                                  :active-picker.sync="activePicker"
                                  :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                  min="1950-01-01"
                                  @change="save"
                                ></v-date-picker>
                              </v-menu>
                            </v-col>
                            <v-col
                              cols="12"
                              sm="6"
                            >
                              <v-autocomplete
                                :items="['Male', 'Female', 'Other']"
                                label="Gender"
                                v-model="Gender"
                              ></v-autocomplete>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="dialog = false"
                        >
                          Close
                        </v-btn>
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="editUserProfiles"
                        >
                          Save
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </div> -->
              </v-col>
              <v-col
                cols="4"
              >
                <!-- <div>
                  <v-img
                    src="../../assets/ERICH.svg"
                    aspect-ratio="2"
                    contain
                  ></v-img>
                </div> -->
                <!-- <div>
                  <v-file-input
                    :rules="rules"
                    accept="image/png, image/jpeg, image/bmp"
                    placeholder="Pick an avatar"
                    prepend-icon="mdi-camera"
                    label="Avatar"
                  ></v-file-input>
                </div> -->
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
        <v-col
          cols="12"
          class="d-md-none pa-0"
          
        >
          <v-sheet
            max-height="500px"
          >
            <v-row>
              <v-col cols="12" class="px-8 py-2 px-sm-8 py-sm-4">
                <div class="">
                  <h3
                    class="fontTitle ftSize"
                  >My Profile</h3>
                  <h5 class="fontDesc font-weight-regular fontSize"
                  >Manage and protect your account.</h5>
                </div>
              </v-col>
            </v-row>
            <v-divider class="mt-3"></v-divider>
            <v-row>
              <v-col
                
                cols="12"
                class=""

              >
              <div
                  class="d-flex mt-5 ml-5"
                >
                  <h4
                    class=" fontTitle fontSize"
                  >Username:</h4>
                  <h5
                    class="px-sm-10 px-10 fontTitle font-weight-regular fontSize"
                  >{{Username}}</h5>
                </div>

                <div
                  class="d-flex mt-5 ml-5"
                >
                  <h4
                    class=" fontTitle fontSize"
                  >Name:</h4>
                  <h5
                    class="px-sm-16 px-16 fontTitle font-weight-regular fontSize"
                  >{{Name}}</h5>
                </div>

                <div
                  class="d-flex mt-5 ml-5"
                >
                  <h4
                    class="fontTitle fontSize"
                  >Surname:</h4>
                  <h5
                    class="px-sm-12 px-12 fontTitle font-weight-regular fontSize"
                  >{{Surname}}</h5>
                </div>

                <div
                  class="d-flex align-center mt-5 ml-5"
                >
                  <h4
                    class="mr-sm-1 fontTitle fontSize"
                  >Email:</h4>
                  <h5
                    class="px-sm-16 px-16 fontTitle font-weight-regular fontSize"
                  >{{Email}}</h5>
                  <!-- <v-btn
                    plain
                    x-small
                    color="primary"
                    @click="editUserEmail"
                  >
                    <p
                      class="my-0"
                    >change</p>
                  </v-btn> -->
                </div>
                <div
                  class="d-flex mt-5 ml-5"
                >
                  <h4
                    class="fontTitle fontSize"
                  >Phone number:</h4>
                  <h5
                    class="px-sm-3 px-3 fontTitle font-weight-regular fontSize"
                  >{{Mobilenumber}}</h5>
                </div>

                <div
                  class="d-flex mt-5 ml-5"
                >
                  <h4
                    class="fontSize"
                  >Date of birth:</h4>
                  <h5
                    class="px-sm-6 px-6 fontTitle font-weight-regular fontSize"
                  >{{Birthday}}</h5>
                </div>
                <div
                  class="d-flex mt-5 ml-5"
                >
                  <h4
                    class="fontTitle fontSize"
                  >Gender:</h4>
                  <h5
                    class="px-sm-12 px-12 fontTitle font-weight-regular fontSize"
                  >{{Gender}}</h5>
                </div>

                 <div
                  class="d-flex mt-5 ml-5 mb-5"
                >
                  <h4
                    class="mr-2 my-0 fontTitle fontSize"
                  >Account:</h4>
                  
                  <h5
                    class="my-0 py-1  px-15  fontTitle font-weight-regular fontSize"
                  >{{Account}}</h5>
                </div>
                <!-- <div
                  class="mt-6"
                >
                  <v-dialog
                    v-model="dialog"
                    persistent
                    max-width="600px"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="primary"
                        dark
                        v-bind="attrs"
                        v-on="on"
                      >
                        Edit
                      </v-btn>
                    </template>
                    <v-card>
                      <v-card-title>
                        <span class="text-h5">User Profile</span>
                      </v-card-title>
                      <v-card-text>
                        <v-container>
                          <v-row>
                            <v-col
                              cols="6"
                            >
                              <v-text-field
                                label="First Name"
                                required
                                v-model="Name"
                              ></v-text-field>
                            </v-col>
                            <v-col
                              cols="6"
                            >
                              <v-text-field
                                label="Last Name"
                                required
                                v-model="Username"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field
                                label="Phone Number"
                                required
                                v-model="Mobilenumber"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
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
                                    outlined
                                  ></v-text-field>
                                </template>
                                <v-date-picker
                                  v-model="Birthday"
                                  :active-picker.sync="activePicker"
                                  :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                                  min="1950-01-01"
                                  @change="save"
                                ></v-date-picker>
                              </v-menu>
                            </v-col>
                            <v-col
                              cols="12"
                              sm="6"
                            >
                              <v-autocomplete
                                :items="['Male', 'Female', 'Other']"
                                label="Gender"
                                v-model="Gender"
                              ></v-autocomplete>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="dialog = false"
                        >
                          Close
                        </v-btn>
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="editUserProfiles"
                        >
                          Save
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </div> -->
              </v-col>
              <v-col
                cols="4"
              >
                <!-- <div>
                  <v-img
                    src="../../assets/ERICH.svg"
                    aspect-ratio="2"
                    contain
                  ></v-img>
                </div> -->
                <!-- <div>
                  <v-file-input
                    :rules="rules"
                    accept="image/png, image/jpeg, image/bmp"
                    placeholder="Pick an avatar"
                    prepend-icon="mdi-camera"
                    label="Avatar"
                  ></v-file-input>
                </div> -->
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
      Account: "",
      rules: [
        value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
      ],
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
      usersTag(){
        return localStorage.getItem('tag');
      },
    },

    watch: {
      menu(val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },

    methods: {
      save(date) {
        this.$refs.menu.save(date)
      },
      editUserProfiles() {
        this.dialog = false;
        alert("Button Not Yet Working");
      },
      editUserEmail(){
        alert("Button Not Yet Working");
      },
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
.ftSize{
  font-size: 2vh;
}
.fontSize{
  font-size: 1.5vh;
}
/* .nBorder{
    border: 1px solid #787885;
    border-radius: 5px;
    border-right-width: 50px;
    border-right: 1px solid #;
    border-spacing: 50px 5px;
    
  } */
</style>