<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-sheet
            width="100%"
            height="100%"
            class="pa-sm-5"
          >
            <v-row>
              <v-col
              >
                <div
                  class="d-flex pa-5"
                >
                  <h3
                    class="fontTitle"
                  >My Address</h3>
                  <v-spacer></v-spacer>
                  <v-btn
                    @click="openAddressDialog"
                    color="#1106A0"
                    dark
                    small
                  >
                    <p
                      class="my-0"
                    >Add New</p>
                  </v-btn>
                </div>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col>
                <v-list dense>
                  <v-list-item-group
                    
                    color="primary"
                  >
                    <v-list-item
                      v-for="(item, i) in showAddress"
                      :key="i"
                    >
                      <div
                        class="my-2"
                      >
                        <v-subheader
                          v-if="item.Default == 'Default'"
                          class="fontBlue"
                        ><h3 class="ma-n2"> Default Address </h3></v-subheader>
                        <p
                          class="my-0"
                        >{{item.Name}}&nbsp;{{item.Surname}}</p>
                        <div
                          class="d-none d-sm-block"
                        >
                          <div
                            class="d-flex"
                          >
                            <p>{{item.Municipality}}</p>
                            <p>{{item.Barangay}}&nbsp;</p>
                            <p>{{item.UBarangay}}&nbsp;</p>
                            <p>{{item.HomeAddress}}&nbsp;</p>
                          </div>
                        </div>
                        <div
                          class="d-sm-none"
                        >
                          <div>
                            <p>{{item.Municipality}}&nbsp; {{item.Barangay}}&nbsp; {{item.UBarangay}}&nbsp; {{item.HomeAddress}}</p>
                          </div>
                        </div>
                      </div>
                      <v-spacer></v-spacer>
                      <div
                        class=""
                        v-if="!(item.Default == 'Default')"
                      > 
                        <v-btn
                          x-small
                          color="#1106A0"
                          dark
                          outlined
                          @click="defaultAddress(item.id)"
                        >
                          <p
                            class="my-0"
                          >
                            Set Default
                          </p>
                        </v-btn>
                      </div>
                    </v-list-item>
                  </v-list-item-group>
                </v-list>
                <v-divider></v-divider>
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>

    <v-dialog
      v-model="addDialog"
      width="500"
    >
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Add Address
        </v-card-title>

        <v-card-text>
          <v-container>
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
                    <v-simple-table height="300px">
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
                    </v-simple-table>
                  </v-list-item-group>
                </v-list>
              </v-menu>
            </v-card-text>

            <!-- Under Barangay -->
            <v-card-text
              class="px-0 py-2 pb-5"
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
                    >{{customerInfo.UnderBarangay}}</h4>
                    <v-spacer></v-spacer>
                    <v-icon>mdi-chevron-down</v-icon>
                  </v-btn>
                </template>

                <v-list dense>
                  <v-list-item-group
                    color="primary"
                    
                  >
                    <v-simple-table height="300px">
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
                    </v-simple-table>
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
          </v-container>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            text
            @click="addDialog = false"
          >
            Cancel
          </v-btn>
          <v-btn
            color="primary"
            text
            @click="addNewAddress"
          >
            Add New Address
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  // import smbBarangays from '../../components/Signup/StaMariaBarangay.js'
  import smbBarangays from '../../components/Signup/StaMariaBarangay'
  import nbBarangays from '../../components/Signup/NorzagarayBarangay.js'
  import abBarangays from '../../components/Signup/AngatBarangay.js'
  import subBGBGN from '../../components/Signup/brgyOfSMB/sbrgyBagbaguin.js'
  import subBLSNG from '../../components/Signup/brgyOfSMB/sbrgyBalasing.js'
  import subBNAVST from '../../components/Signup/brgyOfSMB/sbrgyBuenavista.js'
  import subBLC from '../../components/Signup/brgyOfSMB/sbrgyBulac.js'
  import subCMNGYN from '../../components/Signup/brgyOfSMB/sbrgyCamangyanan.js'
  import subCTMN from '../../components/Signup/brgyOfSMB/sbrgyCatmon.js'
  import subCYPMB from '../../components/Signup/brgyOfSMB/sbrgyCayPombo.js'
  import subCYSIO from '../../components/Signup/brgyOfSMB/sbrgyCaysio.js'
  import subGYNG from '../../components/Signup/brgyOfSMB/sbrgyGuyong.js'
  import subLLKHN from '../../components/Signup/brgyOfSMB/sbrgyLalakhan.js'
  import subMGASWNGSP from '../../components/Signup/brgyOfSMB/sbrgyMagAsawangSapa.js'
  import subMHBNGPRNG from '../../components/Signup/brgyOfSMB/sbrgyMahabangParang.js'
  import subMNGHN from '../../components/Signup/brgyOfSMB/sbrgyMangahan.js'
  import subPRDA from '../../components/Signup/brgyOfSMB/sbrgyParada.js'
  import subPBLCN from '../../components/Signup/brgyOfSMB/sbrgyPoblacion.js'
  import subPBHNG from '../../components/Signup/brgyOfSMB/sbrgyPulongbuhangin.js'
  import subSNGBRL from '../../components/Signup/brgyOfSMB/sbrgySanGabriel.js'
  import subSNJSEPTG from '../../components/Signup/brgyOfSMB/sbrgySanJosePatag.js'
  import subSNTCLRA from '../../components/Signup/brgyOfSMB/sbrgySantaClara.js'
  import subSNTCRZ from '../../components/Signup/brgyOfSMB/sbrgySantaCruz.js'
  import subSNVCNTE from '../../components/Signup/brgyOfSMB/sbrgySanVicente.js'
  import subSLNGN from '../../components/Signup/brgyOfSMB/sbrgySilangan.js'
  import subTBNGBKD from '../../components/Signup/brgyOfSMB/sbrgyTabingBakod.js'
  import subTMNA from '../../components/Signup/brgyOfSMB/sbrgyTumana.js'
  import nubPRTDA from '../../components/Signup/brgyOfNGaray/nbrgyPartida'
  import nubPBLCN from '../../components/Signup/brgyOfNGaray/nbrgyPoblacion.js'
  import nubTGBE from '../../components/Signup/brgyOfNGaray/nbrgyTigbe'
  import aubPY from '../../components/Signup/brgyOfAngat/abrgyPulogYantok.js'
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    data: () => ({
      customerInfo: {
        Email: "",
        Municipality: "Sta.Maria",
        Barangay: "Pulong Buhangin",
        UnderBarangay: "Gulod",
        HomeAddress: "",
        ShipFee: "Free",
        Default: "False",
      },
      addDialog: false,
      selectedItem: 1,
      items: [
        //{id: "", Name: "n", Surname: "s", Email: "e", Municipality: "m", Barangay: "", UBarangay: "", HomeAddress: "h"},
      ],

      // Address Drop down Data
      municipalities: [
        { id: 1, mName: "Sta.Maria"},
        { id: 2, mName: "Norzagaray"},
        { id: 3, mName: "Angat"},
      ],

      // Default Value in condition
      barangays: smbBarangays,
      UnderBarangays: subPBHNG,
    }),

      computed: {
      usersFName(){
        return localStorage.getItem('firstName');
      },
      usersLName(){
        return localStorage.getItem('lastName');
      },
      usersEmail(){
        return localStorage.getItem('email');
      },
      customerAddress() {
        return this.$store.state.customerAddress;
      },
      showAddress() {
        return this.insertAddress();
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    watch: {
      customerAddress(){
        this.insertAddress();
      }
    },

    methods: {
      insertAddress() {
        this.items = [];
        var item;
        for(var i = 0; i < this.customerAddress.length; i++){
          var def = "";
          if(this.customerAddress[i].default == "True"){
            def = "Default";
          }
          item = {id: this.customerAddress[i].id,
                Name: this.usersFName,
                Surname: this.usersLName,
                Email: this.customerAddress[i].email,
                Municipality: this.customerAddress[i].municipality,
                Barangay: this.customerAddress[i].barangay,
                UBarangay: this.customerAddress[i].underBarangay,
                HomeAddress: this.customerAddress[i].homeAddress,
                Default: def
                }
          //console.log("loop");
          this.items.push(item);
        }
        return this.items;
      },
      defaultAddress(id){
        // console.log(id);
        axios.put(this.getDomain()+'api/defaddress/' + id, {
          email: this.usersEmail,
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          console.log(res.data);
          this.$store.commit('storeCustomerAddress', res.data.data);
        })
        .catch(err => console.error(err));
      },
      addNewAddress(){
        this.customerInfo.Email = this.usersEmail;
        console.log(this.customerInfo);
        axios.post(this.getDomain()+'api/addaddress/store',{
          register: this.customerInfo
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          console.log(res.data.data);
          this.$store.commit('storeCustomerAddress', res.data.data);
          this.addDialog = false;
        })
        .catch(err => console.error(err));
      },
      openAddressDialog(){
        this.addDialog = true;
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
        this.customerInfo.Barangay = bName;
        if(data == "smbBagBaguin"){
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
        else if(data == "smbStaCruz"){
          this.UnderBarangays = subSNTCRZ;
          this.customerInfo.Barangay = 'Santa Cruz';
          this.customerInfo.UnderBarangay = "Dr.TSantiago Street"
          this.customerInfo.ShipFee = "120"
        }
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
    },

    beforeMount() {
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