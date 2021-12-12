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
                <!-- <div>
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
                </div> -->
                <v-list dense>
                  <v-list-item-group
                    
                    color="primary"
                  >
                    <v-list-item
                      v-for="(item, i) in items"
                      :key="i"
                    >
                      <div>
                        <v-subheader>{{item.Default}}</v-subheader>
                        <p>{{item.Name}}&nbsp;{{item.Surname}}</p>
                        <div
                          class="d-flex"
                        >
                          <p>{{item.Municipality}}&nbsp;</p>
                          <p>{{item.Barangay}}&nbsp;</p>
                          <p>{{item.UBarangay}}&nbsp;</p>
                          <p>{{item.HomeAddress}}</p>
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
  </div>
</template>

<script>
  export default {
    data: () => ({
      selectedItem: 1,
      items: [
        //{id: "", Name: "n", Surname: "s", Email: "e", Municipality: "m", Barangay: "", UBarangay: "", HomeAddress: "h"},
      ],
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
      insertAddress() {
        var item;
        for(var i = 0; i < this.customerAddress.length; i++){
          var def = "";
          if(this.customerAddress[i].Default == "True"){
            def = "Default";
          }
          item = {id: this.customerAddress[i].id,
                Name: this.customerInfos.First_Name,
                Surname: this.customerInfos.Last_Name,
                Email: this.customerAddress[i].Email,
                Municipality: this.customerAddress[i].Municipality,
                Barangay: this.customerAddress[i].Barangay,
                UBarangay: this.customerAddress[i].UnderBarangay,
                HomeAddress: this.customerAddress[i].HomeAddress,
                Default: def
                }
          //console.log("loop");
          this.items.push(item)
        }
      }
    },

    beforeMount() {
      //this.getCustomerInfo();
      console.log("infos");
      console.log(this.customerInfos);
      console.log(this.customerAddress);
      console.log(this.customerAddress.length);
      //console.log(this.customerAddress[0].id);
      
      this.insertAddress();
      // this.items.Name = this.customerInfos.First_Name;
      // this.items.Surname = this.customerInfos.Last_Name;
      // this.items.Email = this.customerInfos.Email;
      // this.items.Municipality = this.customerAddress.Municipality;
      // this.items.Barangay = this.customerAddress.Barangay;
      // this.items.UBarangay = this.customerAddress.UnderBarangay;
      // this.items.HomeAddress = this.customerAddress.HomeAddress;
    }
  }
</script>