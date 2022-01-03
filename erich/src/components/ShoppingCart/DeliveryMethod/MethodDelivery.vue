<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          class="pa-15"
        >
          <div> 
            <h3
              class="fontTitle font-weight-bold"
            >
              Contact Information</h3>
              <v-row class="nContact mx-0 ma-3">
                <v-col cols="6">
                  <p
                    class="ma-0 pa-0 fontDesc"
                  >
                    {{Name}}&nbsp;{{Surname}}
                  </p>
                </v-col>
                
                <v-col cols="6 " class="d-flex justify-end">
                  <p
                  class="ma-0 pa-0 fontDesc"
                  >
                  {{Mobilenumber}}
                  </p>
                </v-col>  
            </v-row> 
          </div>
          <div
            class="pt-4"
          >
            <h3
              class="fontTitle font-weight-bold"
            >
              Delivery Address
            </h3>
            <div
              class="d-flex nDelivery mx-0 ma-3 pa-3 fontDesc"
            >
                <p>{{Municipality}}&nbsp;{{Barangay}}&nbsp;{{UBarangay}}&nbsp;{{HomeAddress}}&nbsp;</p>              
            </div>
            <div
              class="d-flex justify-end"
            >
              <v-btn
                class="justify-end"
                plain
                color="#1106A0"
                small
                right
                @click="changeAddress"
              >
                Change Adress
              </v-btn>
            </div>
          </div>
          <div
            class="pt-4"
          >
            <h3
              class="ma-0 pa-0 fontTitle font-weight-bold"
            >Delivery Fee</h3>
            <div class="py-2">
              <p>{{Shipping}}</p>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      Name: "",
      Surname: "",
      Mobilenumber: "",
      Municipality: "",
      Barangay: "",
      UBarangay: "",
      HomeAddress: "",
      Shipping: "",
    }),

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      customerAddress() {
        return this.$store.state.customerAddress;
      }
    },

    methods: {
      changeAddress() {
        this.$store.commit('goToAddress');
        this.$router.push({path: '/profile'});
      },
      insertAddress() {
        // console.log(this.customerAddress);
        // console.log(this.customerAddress[0].Default);
        // console.log(this.customerAddress.length);
        for(var i = 0; i < this.customerAddress.length; i++){
          if(this.customerAddress[i].Default == "True"){
            this.Municipality = this.customerAddress[i].Municipality;
            this.Barangay = this.customerAddress[i].Barangay;
            this.UBarangay = this.customerAddress[i].UnderBarangay;
            this.HomeAddress = this.customerAddress[i].HomeAddress;
            this.Shipping = this.customerAddress[i].ShipFee;
          }
        }
      }
    },

    beforeMount() {
      //this.getCustomerInfo();
      console.log(this.customerInfos);
      console.log(this.customerAddress);
      this.insertAddress()
      this.Name = this.customerInfos.First_Name;
      this.Surname = this.customerInfos.Last_Name;
      this.Mobilenumber = this.customerInfos.Mobile_Number;
      // this.Municipality = this.customerAddress.Municipality;
      // this.Barangay = this.customerAddress.Barangay;
      // this.UBarangay = this.customerAddress.UnderBarangay;
      // this.HomeAddress = this.customerAddress.HomeAddress;
      
    }
  }
</script>

<style scoped>
  .fontTitle{
    color:#464646;
  }
  .fontDesc{
    color: #787885;
  }

  .nContact{
    border: 1px solid #787885;
    border-radius: 5px;
    border-right: 1px solid;
    line-height: 10px;
  }
  .nDelivery{
    border: 1px solid #787885;
    border-radius: 5px;
  }

</style>