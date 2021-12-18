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
                  class="font-weight-black 
                  pt-0
                  pl-0 
                  text-h5"
                  
                >
                  Create an Account
                </v-card-title>
                <v-card-subtitle
                  class="pl-0"
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
                    v-on:change="handleInputOnChange"
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
                    type="number"
                  ></v-text-field>
                </v-card-text>

                <!-- Password -->
                <v-card-text
                  class="pa-0"
                >
                  <v-text-field
                    v-model="customerInfo.Password"
                    type="Password"
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
                  class="py-2 px-0 pt-0"
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
                        block
                        outlined
                        color="grey"
                      >
                        <h4 
                          class="grey--text 
                          text--darken-3 
                          font-weight-regular"
                          >{{customerInfo.Municipality}}
                        </h4>
                          <v-spacer></v-spacer>
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
                  class="px-0 "
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
                        block
                        outlined
                        color="grey"
                      >
                        <h4 
                          class="grey--text
                          text--darken-3 
                          font-weight-regular"
                        >{{customerInfo.Barangay}}</h4>
                          <v-spacer></v-spacer>
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
                  class="py-0 px-0 pt-2 pb-5  "
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
                        block
                        outlined
                        color="grey"
                      >
                        <h5 
                          class="grey--text 
                          text--darken-3 
                          font-weight-regular"
                        >{{customerInfo.UnderBarangay}}</h5>
                        <v-spacer></v-spacer>
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
                              @click="underBarangayInput(UnderBarangay.ubrgy, UnderBarangay.SFee)"
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
                  class="py-2 px-0 pb-0"
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
<!-- Start of Gender -->
<!--  -->
<!--  -->

                <div>
                  <p>Gender</p>
                  <v-radio-group
                    v-model="customerInfo.Gender"
                    row
                  >
                    <v-radio
                      label="Male"
                      value="Male"
                    ></v-radio>
                    <v-radio
                      label="Female"
                      value="Female"
                    ></v-radio>
                    <v-radio
                      label="Other"
                      value="Other"
                    ></v-radio>
                  </v-radio-group>
                </div>

<!--  -->
<!--  -->
<!-- End of Gender -->
<!--  -->
<!--  -->

<!--  -->
<!--  -->
<!-- Start of Register Button -->
<!--  -->
<!--  -->
                
                <!-- Terms and Confitions -->
                <div>
                  <p
                    class="text-center caption"
                  >By clicking Sign Up, you agree to our <router-link to="/">Terms</router-link>, Learn how we collect, 
                  use and share your data in our <router-link to="/">Data Policy</router-link>
                    and how we use cookies and similar technology in our <router-link to="/">Cookie Policy</router-link>, 
                    you may receive Email message from us to verify 
                    your account.
                  </p>
                </div>

                <!-- Register Button -->
                <v-card-text
                  class="d-flex justify-center pb-0"
                >
                  <v-btn
                    color="blue darken-4"
                    dark
                    class="rounded-lg px-10"
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
      </v-container>
    </div>
  </div>
</template>

<script>
  import SignupHeader from '../components/Signup/SignupHeader.vue'
  import smbBarangays from '../components/Signup/StaMariaBarangay.js'
  import nbBarangays from '../components/Signup/NorzagarayBarangay.js'
  import abBarangays from '../components/Signup/AngatBarangay.js'
  import subBGBGN from '../components/Signup/brgyOfSMB/sbrgyBagbaguin.js'
  import subBLSNG from '../components/Signup/brgyOfSMB/sbrgyBalasing.js'
  import subBNAVST from '../components/Signup/brgyOfSMB/sbrgyBuenavista.js'
  import subBLC from '../components/Signup/brgyOfSMB/sbrgyBulac.js'
  import subCMNGYN from '../components/Signup/brgyOfSMB/sbrgyCamangyanan.js'
  import subCTMN from '../components/Signup/brgyOfSMB/sbrgyCatmon.js'
  import subCYPMB from '../components/Signup/brgyOfSMB/sbrgyCayPombo.js'
  import subCYSIO from '../components/Signup/brgyOfSMB/sbrgyCaysio.js'
  import subGYNG from '../components/Signup/brgyOfSMB/sbrgyGuyong.js'
  import subLLKHN from '../components/Signup/brgyOfSMB/sbrgyLalakhan.js'
  import subMGASWNGSP from '../components/Signup/brgyOfSMB/sbrgyMagAsawangSapa.js'
  import subMHBNGPRNG from '../components/Signup/brgyOfSMB/sbrgyMahabangParang.js'
  import subMNGHN from '../components/Signup/brgyOfSMB/sbrgyMangahan.js'
  import subPRDA from '../components/Signup/brgyOfSMB/sbrgyParada.js'
  import subPBLCN from '../components/Signup/brgyOfSMB/sbrgyPoblacion.js'
  import subPBHNG from '../components/Signup/brgyOfSMB/sbrgyPulongbuhangin.js'
  import subSNGBRL from '../components/Signup/brgyOfSMB/sbrgySanGabriel.js'
  import subSNJSEPTG from '../components/Signup/brgyOfSMB/sbrgySanJosePatag.js'
  import subSNTCLRA from '../components/Signup/brgyOfSMB/sbrgySantaClara.js'
  import subSNTCRZ from '../components/Signup/brgyOfSMB/sbrgySantaCruz.js'
  import subSNVCNTE from '../components/Signup/brgyOfSMB/sbrgySanVicente.js'
  import subSLNGN from '../components/Signup/brgyOfSMB/sbrgySilangan.js'
  import subTBNGBKD from '../components/Signup/brgyOfSMB/sbrgyTabingBakod.js'
  import subTMNA from '../components/Signup/brgyOfSMB/sbrgyTumana.js'
  import nubPRTDA from '../components/Signup/brgyOfNGaray/nbrgyPartida'
  import nubPBLCN from '../components/Signup/brgyOfNGaray/nbrgyPoblacion.js'
  import nubTGBE from '../components/Signup/brgyOfNGaray/nbrgyTigbe'
  import aubPY from '../components/Signup/brgyOfAngat/abrgyPulogYantok.js'

  export default {
    name: 'Signup',

    components: {
      'signup-header': SignupHeader,
    },

    data: () => ({
      snackbar: false,
      prompt: '',
      timeout: 4000,

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

      // Default Value in condition
      barangays: smbBarangays,
      UnderBarangays: subPBHNG,

      // customerInfo data varaiables
      customerInfo: {
        First_Name: "Rom Paulo",
        Last_Name: "Sarmiento",
        Mobile_Number: "09755254700",
        Email: "rom@gmail.com",
        Gender: "Other",
        Municipality: "Sta.Maria",
        Barangay: "Pulong Buhangin",
        UnderBarangay: "Gulod",
        HomeAddress: "Block 4 Lot 0",
        Birthday: "2000-01-25",
        Tag: "Customer",
        Password: "@Admin123",
        id: "",
        ShipFee: "Free",
        Default: "True",
      },

      usersData: {
        usersEmail: "",
        usersPassword: ""
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
        v => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid',
      ],
      mobileNumRules: [
        v => (v.length == 11) || 'Mobile number is invalid',
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
        console.log("Phone Number: " + this.customerInfo.Mobile_Number);
        console.log("Password: " + this.customerInfo.Password);
        console.log("Municipality: " + this.customerInfo.Municipality);
        console.log("Barangay: " + this.customerInfo.Barangay);
        console.log("Under Barangay: " + this.customerInfo.UnderBarangay);
        console.log("Home Adress: " + this.customerInfo.HomeAddress);
        console.log("Birthday: " + this.customerInfo.Birthday);
        console.log("Gender: " + this.customerInfo.Gender);
        console.log("Ship Fee: " + this.customerInfo.ShipFee);
        // axios.post('http://127.0.0.1:8000/api/customers/store', {
        //   register: this.customerInfo
        // })
        // .then(res => this.accCreateSuccess(res.data))
        // .catch(err => console.error(err));
        if(this.customerInfo.First_Name != "" && this.customerInfo.Last_Name != "" && this.customerInfo.Email != "" && 
        this.customerInfo.Mobile_Number != "" && this.customerInfo.Password != "" && this.customerInfo.HomeAddress != "" && 
        this.customerInfo.Birthday != ""){
          if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.customerInfo.Email)){
            if(this.customerInfo.Mobile_Number.length == 11){
              if((/[A-Z]/.test(this.customerInfo.Password)) && (/[A-Z]/.test(this.customerInfo.Password)) &&
              (/[a-z]/.test(this.customerInfo.Password)) && (/[0-9]/.test(this.customerInfo.Password)) &&
              (/[#?!@$%^&*-]/.test(this.customerInfo.Password) && (this.customerInfo.Password.length >= 8))
              ){
                axios.post('http://127.0.0.1:8000/api/customers/store', {
                  register: this.customerInfo
                })
                .then(res => this.accCreateSuccess(res.data))
                //.then(res => console.log(res.data))
                .catch(err => console.error(err));
              }
              else{
                this.snackbar = true;
                this.prompt = "yung pass"; 
              }
            }
            else{
              this.snackbar = true;
              this.prompt = "Number po"; 
            }
          }
          else{
            this.snackbar = true;
            this.prompt = "Yung email";
          }
        }
        else{
          this.snackbar = true;
          this.prompt = "Paki kumpleto mga input field";
        }

      },
      saveAddress(cinfo){
        axios.post('http://127.0.0.1:8000/api/customeraddress/store', {
          register: this.customerInfo
        })
        .then(res => this.addressCreateSuccess(res.data, cinfo))
        .catch(err => console.error(err));
      },
      accCreateSuccess(data) {
        console.log("This is customer data: " + data);
        if(data == "emailInvalid"){
          alert("Your email is already taken. Try another email.")
        }
        else{
          this.saveAddress(data);
        }
      },
      addressCreateSuccess(creds, cinfo) {
        //alert("Account Created Succesfully");
        console.log("Account Created Succesfully");
        console.log(creds);
        if(creds != null){
          this.usersData.usersEmail = creds.Email;

          axios.post('http://127.0.0.1:8000/api/loginaddress/store',{
            clientCred: this.usersData
          })
          .then(res => this.$store.commit('storeCustomerAddress', res.data))
          //.then(res => console.log(res.data))
          .catch(err => console.error(err));
        }
        // this.$store.commit('storeCustomerAddress', data);
        this.$store.commit('storeCustomerInfo', cinfo);
        this.$router.push('/');
      },
      municipalityInput(data){
        this.customerInfo.Municipality = data;
        if(data == "Sta.Maria"){
          this.barangays = smbBarangays;
          this.UnderBarangays = subPBHNG;
          this.customerInfo.Barangay = 'Pulong Buhangin';
          this.customerInfo.UnderBarangay = "A.DelRosarioStreet"
          this.customerInfo.ShipFee = "Free"
        }
        else if(data == "Norzagaray"){
          this.barangays = nbBarangays;
          this.UnderBarangays = nubPBLCN;
          this.customerInfo.Barangay = 'Poblacion';
          this.customerInfo.UnderBarangay = "Antonia Heights Subd"
          this.customerInfo.ShipFee = "120"
        }
        else if(data == 'Angat'){
          this.barangays = abBarangays;
          this.UnderBarangays = aubPY;
          this.customerInfo.Barangay = 'Pulong Yantok';
          this.customerInfo.UnderBarangay = "Pinaglagarian"
          this.customerInfo.ShipFee = "85"
        }
      },
      barangayInput(data, bName){
        //console.log("brgy input");
        this.customerInfo.Barangay = bName;
        if(data == "smbBagBaguin"){
          //console.log("Bgbgn");
          this.UnderBarangays = subBGBGN;
          this.customerInfo.Barangay = 'BagBaguin';
          this.customerInfo.UnderBarangay = "GovFortunatoHaliliAve"
          this.customerInfo.ShipFee = "120"
        }
        else if(data == "smbBalasing"){
          this.UnderBarangays = subBLSNG;
          this.customerInfo.Barangay = 'Balasing';
          this.customerInfo.UnderBarangay = "834-830 Balasing SanJose Road"
          this.customerInfo.ShipFee = "45"
        }
        // else if(data == "smbBuenavista"){
        //   this.UnderBarangays = subBNAVST;
        //   this.customerInfo.Barangay = 'Buenavista';
        //   this.customerInfo.UnderBarangay = "Altamonte"
        // }
        else if(data == "smbBulac"){
          this.UnderBarangays = subBLC;
          this.customerInfo.Barangay = 'Bulac';
          this.customerInfo.UnderBarangay = "Bulac"
          this.customerInfo.ShipFee = "65"
        }
        else if(data == "smbCamangyan"){
          this.UnderBarangays = subCMNGYN;
          this.customerInfo.Barangay = 'Camangyan';
          this.customerInfo.UnderBarangay = "Kalabasa Street"
          this.customerInfo.ShipFee = "120"
        }
        else if(data == "smbCatmon"){
          this.UnderBarangays = subCTMN;
          this.customerInfo.Barangay = 'Catmon';
          this.customerInfo.UnderBarangay = "Kalsadang Munti"
          this.customerInfo.ShipFee = "85"
        }
        else if(data == "smbCaypombo"){
          this.UnderBarangays = subCYPMB;
          this.customerInfo.Barangay = 'Caypombo';
          this.customerInfo.UnderBarangay = "Bright Homes Phase 1"
          this.customerInfo.ShipFee = "45"
        }
        else if(data == "smbCaysio"){
          this.UnderBarangays = subCYSIO;
          this.customerInfo.Barangay = 'Caysio';
          this.customerInfo.UnderBarangay = "Caysio Road"
          this.customerInfo.ShipFee = "65"
        }
        else if(data == "smbGuyong"){
          this.UnderBarangays = subGYNG;
          this.customerInfo.Barangay = 'Guyong';
          this.customerInfo.UnderBarangay = "Bulod Street"
          this.customerInfo.ShipFee = "85"
        }
        else if(data == "smblalakhan"){
          this.UnderBarangays = subLLKHN;
          this.customerInfo.Barangay = 'Lalakhan';
          this.customerInfo.UnderBarangay = "Narra Street"
          this.customerInfo.ShipFee = "120"
        }
        else if(data == "smbMagAsawangSapa"){
          this.UnderBarangays = subMGASWNGSP;
          this.customerInfo.Barangay = 'Mag Asawang Sapa';
          this.customerInfo.UnderBarangay = "Bangka Bangka Road"
          this.customerInfo.ShipFee = "35"
        }
        // else if(data == "smbMahabangParang"){
        //   this.UnderBarangays = subMHBNGPRNG;
        //   this.customerInfo.Barangay = 'Mahabang Parang';
        //   this.customerInfo.UnderBarangay = "MahabangParangRoad"
        // }
        else if(data == "smbManggahan"){
          this.UnderBarangays = subMNGHN;
          this.customerInfo.Barangay = 'Manggahan';
          this.customerInfo.UnderBarangay = "Sta Maria Pandi Road"
          this.customerInfo.ShipFee = "85"
        }
        else if(data == "smbParada"){
          this.UnderBarangays = subPRDA;
          this.customerInfo.Barangay = 'Parada';
          this.customerInfo.UnderBarangay = "C.DeJesus Street"
          this.customerInfo.ShipFee = "100"
        }
        else if(data == "smbPoblacion"){
          this.UnderBarangays = subPBLCN;
          this.customerInfo.Barangay = 'Poblacion';
          this.customerInfo.UnderBarangay = "A.Moreles Street"
          this.customerInfo.ShipFee = "120"
        }
        else if(data == "smbPulongBuhangin"){
          this.UnderBarangays = subPBHNG;
          this.customerInfo.Barangay = 'Pulong Buhangin';
          this.customerInfo.UnderBarangay = "A.Del Rosario Street"
          this.customerInfo.ShipFee = "Free"
        }
        // else if(data == "smbSanGabriel"){
        //   this.UnderBarangays = subSNGBRL;
        //   this.customerInfo.Barangay = 'San Gabriel';
        //   this.customerInfo.UnderBarangay = "A.AguinaldoStreet"
        // }
        else if(data == "smbSanJosePatag"){
          this.UnderBarangays = subSNJSEPTG;
          this.customerInfo.Barangay = 'San Jose Patag';
          this.customerInfo.UnderBarangay = "Burgundy Homes"
          this.customerInfo.ShipFee = "85"
        }
        else if(data == "smbSantaClara"){
          this.UnderBarangays = subSNTCLRA;
          this.customerInfo.Barangay = 'Santa Clara';
          this.customerInfo.UnderBarangay = "AlMasiga"
          this.customerInfo.ShipFee = "120"
        }
        // else if(data == "smbSanVicente"){
        //   this.UnderBarangays = subSNVCNTE;
        //   this.customerInfo.Barangay = 'San Vicente';
        //   this.customerInfo.UnderBarangay = "AlgeraHeights"
        // }
        else if(data == "smbStaCruz"){
          this.UnderBarangays = subSNTCRZ;
          this.customerInfo.Barangay = 'Santa Cruz';
          this.customerInfo.UnderBarangay = "Dr.TSantiago Street"
          this.customerInfo.ShipFee = "120"
        }
        // else if(data == "smbSilangan"){
        //   this.UnderBarangays = subSLNGN;
        //   this.customerInfo.Barangay = 'Silangan';
        //   this.customerInfo.UnderBarangay = "AlMsigaStreet"
        // }
        // else if(data == "smbTabingBakod"){
        //   this.UnderBarangays = subTBNGBKD;
        //   this.customerInfo.Barangay = 'Tabing Bakod';
        //   this.customerInfo.UnderBarangay = "A.B.nateo"
        // }
        // else if(data == "smbTumana"){
        //   this.UnderBarangays = subTMNA;
        //   this.customerInfo.Barangay = 'Tumana';
        //   this.customerInfo.UnderBarangay = "KalabasaStreet"
        // }
        else if(data == "nbPartida"){
          this.UnderBarangays = nubPRTDA;
          this.customerInfo.Barangay = 'Partida';
          this.customerInfo.UnderBarangay = "Eden Ville Subdivision"
          this.customerInfo.ShipFee = "120"
        }
        else if(data == "nbPoblacion"){
          this.UnderBarangays = nubPBLCN;
          this.customerInfo.Barangay = 'Poblacion';
          this.customerInfo.UnderBarangay = "Antonia Heights Subd"
          this.customerInfo.ShipFee = "120"
        }
        else if(data == "nbTigbe"){
          this.UnderBarangays = nubTGBE;
          this.customerInfo.Barangay = 'Tigbe';
          this.customerInfo.UnderBarangay = "Barrio Road"
          this.customerInfo.ShipFee = "100"
        }
        else if(data == "abPulongYantok"){
          this.UnderBarangays = aubPY;
          this.customerInfo.Barangay = 'Pulong Yantok';
          this.customerInfo.UnderBarangay = "Pinaglagarian"
          this.customerInfo.ShipFee = "85"
        }
        else{
          alert("Something wrong");
        }
      },
      underBarangayInput(data, fee){
        this.customerInfo.UnderBarangay = data;
        this.customerInfo.ShipFee = fee;
      },
      save (date) {
        this.$refs.menu.save(date)
      },
      handleInputOnChange() {
        this.customerInfo.Email = this.customerInfo.Email.toLowerCase()
      }
    },

    watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },
    
    
  }

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

      // console.log("register button");
      // console.log("Name: " + this.customerInfo.First_Name + " " + this.customerInfo.Last_Name);
      // console.log("Email: " + this.customerInfo.Email);
      // console.log("Password: " + this.customerInfo.Password);
      // console.log("Municipality: " + this.customerInfo.Municipality);
      // console.log("Barangay: " + this.customerInfo.Barangay);
      // console.log("Under Barangay: " + this.customerInfo.UnderBarangay);
      // console.log("Home Adress: " + this.customerInfo.HomeAddress);
      // console.log("Birthday: " + this.customerInfo.Birthday);
</script>

