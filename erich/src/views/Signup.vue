<template>
  <div>
    <signup-header></signup-header>
    <div>
      <v-container
        class="pa-16"
      >
        <v-row>
          <v-col
            offset-xl="4"
            offset-lg="4"
            offset-md="3"
            offset-sm="2"
            xl="4"
            lg="4"
            md="6"
            sm="8"
          >
            <v-card
              class="rounded-xl pa-12"
            >
              <v-form
                ref="form"
                v-model="valid"
                lazy-validation
              >
                <v-card-title
                  class="font-weight-black pt-0"
                >
                  Create an Account
                </v-card-title>
                <v-card-subtitle
                  class=""
                >
                  It's quick and easy
                </v-card-subtitle>
                
                <v-divider></v-divider>
                
                <v-card-text
                  class="d-flex pa-0 mt-5"
                >
                  <div>
                    <span>
                      First name
                    </span>
                    <v-text-field
                      v-model="clientinfo.First_Name"
                      outlined
                      dense
                      class="mt-1"
                      :rules="fnameRules"
                      required
                    ></v-text-field>
                  </div>
                  
                  <v-spacer></v-spacer>

                  <div>
                    <span>
                      Surname
                    </span>
                    <v-text-field
                      v-model="clientinfo.Last_Name"
                      outlined
                      dense
                      class="mt-1"
                      :rules="snameRules"
                      required
                    ></v-text-field>
                  </div>
                  
                </v-card-text>

                <v-card-text
                  class="pa-0"
                >
                  <span>
                    Email Address
                  </span>
                  <v-text-field
                    v-model="clientinfo.Email"
                    outlined
                    dense
                    class="mt-1"
                    :rules="emailRules"
                    required
                  ></v-text-field>
                </v-card-text>

                <v-card-text
                  class="pa-0"
                >
                  <span>
                    Mobile Number
                  </span>
                  <v-text-field
                    v-model="clientinfo.Mobile_Number"
                    outlined
                    dense
                    class="mt-1"
                    :rules="mobileNumRules"
                    required
                  ></v-text-field>
                </v-card-text>

                <v-card-text
                  class="pa-0"
                >
                  <span>
                    Home Adress
                  </span>
                  <v-text-field
                    v-model="clientinfo.Home_Adress"
                    outlined
                    dense
                    class="mt-1"
                    :rules="homeRules"
                    required
                  ></v-text-field>
                </v-card-text>

                <v-card-text
                  class="pa-0"
                >
                  <span>
                    City
                  </span>
                  <v-text-field
                    v-model="clientinfo.City_Adress"
                    outlined
                    dense
                    class="mt-1"
                    :rules="cityRules"
                    required
                  ></v-text-field>
                </v-card-text>

                <v-card-text
                  class="pa-0"
                >
                  <span>
                    New Password
                  </span>
                  <v-text-field
                    v-model="clientinfo.Password"
                    type="password"
                    outlined
                    dense
                    class="mt-1"
                    :rules="passRules"
                    required
                  ></v-text-field>
                </v-card-text>

                <v-card-text
                  class="pa-0"
                >
                  <span>
                    Confirm Password
                  </span>
                  <v-text-field
                    v-model="confirmPass"
                    type="password"
                    outlined
                    dense
                    class="mt-1"
                    :rules="passRules"
                    required
                  ></v-text-field>
                </v-card-text>

                <div>
                  <span>
                    Birthday
                  </span>
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
                        v-model="clientinfo.Birthday"
                        label="Birthday date"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="clientinfo.Birthday"
                      :active-picker.sync="activePicker"
                      :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                      min="1950-01-01"
                      @change="save"
                    ></v-date-picker>
                  </v-menu>
                </div>

                <v-card-text
                  class="d-flex justify-center pb-0"
                >
                  <v-btn
                    color="blue darken-4"
                    dark
                    class="rounded-lg"
                    @click="register()"
                    
                  >
                    Sign Up
                  </v-btn>
                </v-card-text>
              </v-form>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>

<script>
  import SignupHeader from '../components/Signup/SignupHeader.vue'

  export default {
    name: 'Signup',

    data: () => ({
      activePicker: null,
      menu: false,
      confirmPass: "",

      clientinfo: {
          First_Name: "",
          Last_Name: "",
          Mobile_Number: "",
          Email: "",
          Home_Adress: "",
          City_Adress: "",
          Birthday: "",
          Tag: "Customer",
          Password: "",
          id: "",
        },
      clients: {},
      emailValidation: {},

      valid: true,
      fnameRules: [
        v => !!v || 'First name is required',
        v => (v && v.length <= 100) || 'Your name is too long',
      ],
      snameRules: [
        v => !!v || 'Surname is required',
        v => (v && v.length <= 100) || 'Your surname is too long',
      ],
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      mobileNumRules: [
        v => !!v || 'Mobile umber is required',
        v => (v && v.length == 11) || 'Mobile number is invalid',
      ],
      homeRules: [
        v => !!v || 'Address is required',
        v => (v && v.length <= 80) || 'Your address is too long',
      ],
      cityRules: [
        v => !!v || 'City is required',
        v => (v && v.length <= 20) || 'Your city name is too long',
      ],
      provinceRules: [
        v => !!v || 'Province is required',
        v => (v && v.length <= 20) || 'Your province name is too long',
      ],
      passRules: [
        v => !!v || 'Password is required',
        v => (v && v.length >= 8) || 'Your password is too short',
        v => (v && v.length <= 64) || 'Your password is too long',
      ],
    }),
    
    components: {
      'signup-header': SignupHeader,
    }
  }
</script>