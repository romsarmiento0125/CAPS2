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
          >
            <v-row>
              <v-col>
                <div
                  class="d-flex"
                >
                  <p>My Adress</p>
                  <v-spacer></v-spacer>
                  <v-btn>
                    <p>Add New Address</p>
                  </v-btn>
                </div>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col>
                <div>
                  <p>Default Address</p>
                </div>
                <div
                  class="d-flex"
                >
                  <div>
                    <p>{{Name}}&nbsp;{{Surname}}</p>
                    <div
                      class="d-flex"
                    >
                      <p>{{Municipality}}&nbsp;</p>
                      <p>{{Barangay}}&nbsp;</p>
                      <p>{{UBarangay}}&nbsp;</p>
                      <p>{{HomeAddress}}</p>
                    </div>
                  </div>
                  <v-spacer></v-spacer>
                  <div>
                    <v-btn>
                      <p>Edit</p>
                    </v-btn>
                    <v-btn>
                      <p>Delete</p>
                    </v-btn>
                  </div>
                </div>
                <v-divider></v-divider>
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
      Name: "",
      Surname: "",
      Email: "",
      Municipality: "",
      Barangay: "",
      UBarangay: "",
      HomeAddress: "",
    }),

      computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      }
    },

    beforeMount() {
      //this.getCustomerInfo();
      console.log(this.customerInfos);
      this.Name = this.customerInfos.First_Name;
      this.Surname = this.customerInfos.Last_Name;
      this.Email = this.customerInfos.Email;
      this.Municipality = this.customerInfos.Municipality;
      this.Barangay = this.customerInfos.Barangay;
      this.UBarangay = this.customerInfos.UnderBarangay;
      this.HomeAddress = this.customerInfos.HomeAddress;
    }
  }
</script>