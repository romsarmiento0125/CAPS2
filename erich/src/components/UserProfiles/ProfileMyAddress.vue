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
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    data: () => ({
      selectedItem: 1,
      items: [
        //{id: "", Name: "n", Surname: "s", Email: "e", Municipality: "m", Barangay: "", UBarangay: "", HomeAddress: "h"},
      ],
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
      }
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
      deleteAddress() {
        alert("Delete button is not functioning");
      },
      editAddress(){
        alert("Edit button is not functioning");
      },
      addNewAddress(){
        alert("Add new address button is not functioning");
      }
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