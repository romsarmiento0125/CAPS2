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
            class="pl-5"
          >
            <v-row>
              <v-col>
                <div>
                  <p
                    class="subtitle-1 my-0"
                  >Welcome</p>
                  <p
                    class="headline my-0"
                  >{{Username}}</p>
                </div>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col
                cols="8"
              >
                <div
                  class="d-flex"
                >
                  <p
                    class="subtitle-1 mr-2 my-0"
                  >Name:</p>
                  <p
                    class="subtitle-1 my-0"
                  >{{Name}}</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="subtitle-1 mr-2 my-0"
                  >Surname:</p>
                  <p
                    class="subtitle-1 my-0"
                  >{{Surname}}</p>
                </div>
                <div
                  class="d-flex align-center"
                >
                  <p
                    class="subtitle-1 mr-2 my-0"
                  >Email:</p>
                  <p
                    class="subtitle-1 my-0"
                  >{{Email}}</p>
                  <v-btn
                    plain
                    x-small
                    color="primary"
                    @click="editUserEmail"
                  >
                    <p
                      class="my-0"
                    >change</p>
                  </v-btn>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="subtitle-1 mr-2 my-0"
                  >Phone number:</p>
                  <p
                    class="subtitle-1 my-0"
                  >{{Mobilenumber}}</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="subtitle-1 mr-2 my-0"
                  >Date of birth:</p>
                  <p
                    class="subtitle-1 my-0"
                  >{{Birthday}}</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="subtitle-1 mr-2 my-0"
                  >Gender:</p>
                  <p
                    class="subtitle-1 my-0"
                  >{{Gender}}</p>
                </div>
                 <div
                  class="d-flex"
                >
                  <p
                    class="subtitle-1 mr-2 my-0"
                  >Account:</p>
                  <p
                    class="subtitle-1 my-0"
                  >{{Account}}</p>
                </div>
                <div
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
                </div>
              </v-col>
              <v-divider
                vertical
              ></v-divider>
              <v-col
                cols="4"
              >
                <div>
                  <v-img
                    src="../../assets/ERICH.svg"
                    aspect-ratio="2"
                    contain
                  ></v-img>
                </div>
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