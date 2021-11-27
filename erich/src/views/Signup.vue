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
                
<!--  -->
<!--  -->
<!-- Start of Customer info -->
<!--  -->
<!--  -->

                <!-- First name and Last name-->
                <v-card-text
                  class="d-flex pa-0 mt-5"
                >
                  <div>
                    <v-text-field
                      v-model="customerInfo.First_Name"
                      outlined
                      dense
                      class="mt-1"
                      :rules="fnameRules"
                      required
                      label="First name"
                    ></v-text-field>
                  </div>
                  
                  <v-spacer></v-spacer>

                  <div>
                    <v-text-field
                      v-model="customerInfo.Last_Name"
                      outlined
                      dense
                      class="mt-1"
                      :rules="snameRules"
                      required
                      label="Last name"
                    ></v-text-field>
                  </div>
                  
                </v-card-text>

                <!-- Email -->
                <v-card-text
                  class="pa-0"
                >
                  <v-text-field
                    v-model="customerInfo.Email"
                    outlined
                    dense
                    class="mt-1"
                    :rules="emailRules"
                    required
                    label="Email"
                  ></v-text-field>
                </v-card-text>

                <!-- Mobile number -->
                <v-card-text
                  class="pa-0"
                >
                  <v-text-field
                    v-model="customerInfo.Mobile_Number"
                    outlined
                    dense
                    class="mt-1"
                    :rules="mobileNumRules"
                    required
                    label="Mobile number"
                  ></v-text-field>
                </v-card-text>

                <!-- Password -->
                <v-card-text
                  class="pa-0"
                >
                  <v-text-field
                    v-model="customerInfo.Password"
                    type="password"
                    outlined
                    dense
                    class="mt-1"
                    :rules="passRules"
                    required
                    label="New password"
                  ></v-text-field>
                </v-card-text>

<!--  -->
<!--  -->
<!-- End of Customer info -->
<!--  -->
<!--  -->

<!--  -->
<!--  -->
<!-- Start of Address-->
<!--  -->
<!--  -->
                <!-- Municipality -->
                <v-card-text
                  class="py-2 px-0"
                >
                  <v-menu
                    offset-y
                    transition="slide-y-transition"
                    bottom
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        white
                        v-bind="attrs"
                        v-on="on"
                        class=""
                      >
                        <h4>{{customerInfo.Municipality}}</h4>
                        <v-icon>mdi-chevron-down</v-icon>
                      </v-btn>
                    </template>

                    <v-list dense>
                      <v-list-item-group
                        color="primary"
                        
                      >
                        <v-list-item
                          v-for="municipalitie in municipalities"
                          :key="municipalitie.id"
                        >
                          <v-list-item-content>
                            <v-btn
                              text
                              @click="municipalityInput(municipalitie.mName)"
                            >
                              {{municipalitie.mName}}
                            </v-btn>
                            <!-- <v-list-item-title v-text="municipalitie.mName"></v-list-item-title> -->
                          </v-list-item-content>
                        </v-list-item>
                      </v-list-item-group>
                    </v-list>
                  </v-menu>
                </v-card-text>

                <!-- Barangay -->
                <v-card-text
                  class="py-2 px-0"
                >
                  <v-menu
                    offset-y
                    transition="slide-y-transition"
                    bottom
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        white
                        v-bind="attrs"
                        v-on="on"
                        class=""
                      >
                        <h4>{{customerInfo.Barangay}}</h4>
                        <v-icon>mdi-chevron-down</v-icon>
                      </v-btn>
                    </template>

                    <v-list dense>
                      <v-list-item-group
                        color="primary"
                        
                      >
                        <v-list-item
                          v-for="barangay in barangays"
                          :key="barangay.id"
                        >
                          <v-list-item-content>
                            <v-btn
                              text
                              @click="barangayInput(barangay.brgyCond, barangay.brgy)"
                            >
                              {{barangay.brgy}}
                            </v-btn>
                            <!-- <v-list-item-title v-text="barangay.brgy"></v-list-item-title> -->
                          </v-list-item-content>
                        </v-list-item>
                      </v-list-item-group>
                    </v-list>
                  </v-menu>
                </v-card-text>

                <!-- Under Barangay -->
                <v-card-text
                  class="py-2 px-0"
                >
                  <v-menu
                    offset-y
                    transition="slide-y-transition"
                    bottom
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        white
                        v-bind="attrs"
                        v-on="on"
                        class=""
                      >
                        <h4>{{customerInfo.UnderBarangay}}</h4>
                        <v-icon>mdi-chevron-down</v-icon>
                      </v-btn>
                    </template>

                    <v-list dense>
                      <v-list-item-group
                        color="primary"
                        
                      >
                        <v-list-item
                          v-for="UnderBarangay in UnderBarangays"
                          :key="UnderBarangay.id"
                        >
                          <v-list-item-content>
                             <v-btn
                              text
                              @click="underBarangayInput(UnderBarangay.ubrgy)"
                            >
                              {{UnderBarangay.ubrgy}}
                            </v-btn>
                            <!-- <v-list-item-title v-text="underBarangay.ubrgy"></v-list-item-title> -->
                          </v-list-item-content>
                        </v-list-item>
                      </v-list-item-group>
                    </v-list>
                  </v-menu>
                </v-card-text>

                <!-- Home Address -->
                <v-textarea
                  v-model="customerInfo.HomeAddress"
                  label="Home Address"
                  auto-grow
                  outlined
                  rows="1"
                  row-height="15"
                ></v-textarea>

<!--  -->
<!--  -->
<!-- End of Address-->
<!--  -->
<!--  -->

<!--  -->
<!--  -->
<!-- Start of Date of Birth -->
<!--  -->
<!--  -->

                <div>
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
                        v-model="customerInfo.Birthday"
                        label="Date Of Birth"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                        outlined
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="customerInfo.Birthday"
                      :active-picker.sync="activePicker"
                      :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                      min="1950-01-01"
                      @change="save"
                    ></v-date-picker>
                  </v-menu>
                </div>

<!--  -->
<!--  -->
<!-- End of Date of Birth -->
<!--  -->
<!--  -->

<!--  -->
<!--  -->
<!-- Start of Register Button -->
<!--  -->
<!--  -->
                
                <!-- Terms and Confitions -->
                <div>
                  <p>by clicking Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam aperiam et impedit ratione, velit quos facilis voluptatibus. Quae, reiciendis laboriosam voluptate voluptatem expedita ullam, at, debitis consequatur voluptas dolore corrupti.</p>
                </div>

                <!-- Register Button -->
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

<!--  -->
<!--  -->
<!-- End of Register Button -->
<!--  -->
<!--  -->

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
  import smbBarangays from '../components/Signup/StaMariaBarangay.js'
  import nbBarangays from '../components/Signup/NorzagarayBarangay.js'
  import abBarangays from '../components/Signup/AngatBarangay.js'
  import subPBH from '../components/Signup/brgyOfSMB/sbrgyPulongbuhangin.js'
  import subBGBGN from '../components/Signup/brgyOfSMB/sbrgyBagbaguin.js'
  import nubPBC from '../components/Signup/brgyOfNGaray/nbrgyPoblacion.js'
  import aubPBC from '../components/Signup/brgyOfAngat/abrgyPoblacion.js'

  export default {
    name: 'Signup',

    data: () => ({
      menu: false,
      confirmPass: "",

      // Date of birth drop down
      activePicker: null,
      date: null,
      menu: false,

      // Address Drop down Data
      municipalities: [
        { id: 1, mName: "Sta.Maria"},
        { id: 2, mName: "Norzagaray"},
        { id: 3, mName: "Angat"},
      ],

      barangays: smbBarangays,
      UnderBarangays: subPBH,

      // barangays: [
      //   { id: 1, bName: "Pulong Buhangin"}W,
      //   { id: 2, bName: "Poblacion"},
      //   { id: 3, bName: "Bayan"},
      //   { id: 4, bName: "Partida"},
      // ],
      // underBarangays: [
      //   { id: 1, ubName: "Tiera"},
      //   { id: 2, ubName: "Tab-Tab"},
      //   { id: 3, ubName: "Lawasan"},
      //   { id: 4, ubName: "Iras"},
      // ],

      // customerInfo data varaiables
      customerInfo: {
          First_Name: "",
          Last_Name: "",
          Mobile_Number: "",
          Email: "",
          Municipality: "Sta.Maria",
          Barangay: "Pulong Buhangin",
          UnderBarangay: "Gulod",
          HomeAddress: "",
          Birthday: "",
          Tag: "Customer",
          Password: "",
          id: "",
        },

      // input validation
      valid: true,
      fnameRules: [
        v => (v.length <= 254) || 'Your name is too long',
      ],
      snameRules: [
        v => (v.length <= 254) || 'Your surname is too long',
      ],
      emailRules: [
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      mobileNumRules: [
        v => (v.length == 11) || 'Mobile number is invalid',
      ],
      passRules: [
        v => !!v || 'Password is required',
        v => (v && v.length >= 8) || 'Your password is too short',
        v => (v && v.length <= 254) || 'Your password is too long',
      ],
    }),

    methods: {
      register() {
        console.log("register button");
        console.log("Name: " + this.customerInfo.First_Name + " " + this.customerInfo.Last_Name);
        console.log("Email: " + this.customerInfo.Email);
        console.log("Password: " + this.customerInfo.Password);
        console.log("Municipality: " + this.customerInfo.Municipality);
        console.log("Barangay: " + this.customerInfo.Barangay);
        console.log("Under Barangay: " + this.customerInfo.UnderBarangay);
        console.log("Home Adress: " + this.customerInfo.HomeAddress);
        console.log("Birthday: " + this.customerInfo.Birthday);
        axios.post('http://127.0.0.1:8000/api/customers/store', {
          register: this.customerInfo
        })
        .then(res => this.accCreateSuccess(res.data))
        .catch(err => console.error(err));
      },
      accCreateSuccess(data) {
        console.log(data);
        if(data == "emailInvalid"){
          alert("Your email is already taken. Try another email.")
        }
        else{
          alert("Account Created Succesfully");
          this.$store.commit('storeCustomerInfo', data);
          this.$router.push('/');
        }
      },
      municipalityInput(data){
        this.customerInfo.Municipality = data;
        if(data == "Sta.Maria"){
          this.barangays = smbBarangays;
          this.UnderBarangays = subPBH;
          this.customerInfo.Barangay = 'Pulong Buhangin';
          this.customerInfo.UnderBarangay = "Gulod"
        }
        else if(data == "Norzagaray"){
          this.barangays = nbBarangays;
          this.UnderBarangays = nubPBC;
          this.customerInfo.Barangay = 'Poblacion';
          this.customerInfo.UnderBarangay = "Tab-Tab"
        }
        else if(data == 'Angat'){
          this.barangays = abBarangays;
          this.UnderBarangays = aubPBC;
          this.customerInfo.Barangay = 'Poblacion';
          this.customerInfo.UnderBarangay = "underbrgy1"
        }
      },
      barangayInput(data, bName){
        console.log("brgy input");
        this.customerInfo.Barangay = bName;
        if(data == "smbBagBaguin"){
          console.log("Bgbgn");
          this.UnderBarangays = subBGBGN;
          this.customerInfo.Barangay = 'Pulong Buhangin';
          this.customerInfo.UnderBarangay = "BGBGNData1"
        }
        else if(data == "smbPulong Buhangin"){
          this.UnderBarangays = subPBH;
          this.customerInfo.Barangay = 'Pulong Buhangin';
          this.customerInfo.UnderBarangay = "Gulod"
        }
        else if(data == "nbPoblacion"){
          this.UnderBarangays = nubPBC;
          this.customerInfo.Barangay = 'Poblacion';
          this.customerInfo.UnderBarangay = "Tab-Tab"
        }
        else if(data == "abPoblacion"){
          this.UnderBarangays = aubPBC;
          this.customerInfo.Barangay = 'Poblacion';
          this.customerInfo.UnderBarangay = "underbrgy1"
        }
      },
      underBarangayInput(data){
        this.customerInfo.UnderBarangay = data;
      },
      save (date) {
        this.$refs.menu.save(date)
      },
    },

    watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },
    
    components: {
      'signup-header': SignupHeader,
    },
  }
</script>