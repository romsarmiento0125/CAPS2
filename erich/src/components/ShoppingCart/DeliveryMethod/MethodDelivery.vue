<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          class="ma-5 pa-0"
        >
          <div
            class="pl-5 pt-5"
          > 
            <p
              class="title ma-0 pa-0"
            >
              Contact Information
            </p>
            <p
              class="ma-0 pa-0"
            >
              {{Name}}&nbsp;{{Surname}}
            </p>
            <p
              class="ma-0 pa-0"
            >
              {{Mobilenumber}}
            </p>
          </div>
          <div
            class="pl-5 pt-5"
          >
            <p
              class="title ma-0 pa-0 "
            >
              Delivery Address
            </p>
            <div
              class="d-flex"
            >
              <p>{{Municipality}}&nbsp;</p>
              <p>{{Barangay}}&nbsp;</p>
              <p>{{UBarangay}}&nbsp;</p>
              <p>{{HomeAddress}}&nbsp;</p>
            </div>
            <div
              class="d-flex justify-end"
            >
              <v-btn
                class="justify-end"
                plain
                color="blue"
                small
                right
                @click="changeAddress"
              >
                Change Adress
              </v-btn>
            </div>
          </div>
          <div
            class="pl-5 pt-5"
          >
            <p
              class="title ma-0 pa-0 "
            >Delivery Fee</p>
            <div class="pa-5">
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