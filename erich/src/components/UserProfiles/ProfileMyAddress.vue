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
              <v-col
                class="mx-10"
              >
                <div
                  class="d-flex"
                >
                  <p
                    class="title"
                  >My Address</p>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="orange"
                    @click="addNewAddress"
                  >
                    <p
                      class="my-0 white--text"
                    >Add New Address</p>
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
                      v-for="(item, i) in items"
                      :key="i"
                    >
                      <div
                        class="ml-5 my-2"
                      >
                        <v-subheader
                          v-if="item.Default == 'Default'"
                          class="blue--text"
                        >Default Address</v-subheader>
                        <p
                          class="my-0"
                        >{{item.Name}}&nbsp;{{item.Surname}}</p>
                        <div
                          class="d-flex"
                        >
                          <p>{{item.Municipality}}</p>
                          <p>{{item.Barangay}}&nbsp;</p>
                          <p>{{item.UBarangay}}&nbsp;</p>
                          <p>{{item.HomeAddress}}&nbsp;</p>
                        </div>
                      </div>
                      <v-spacer></v-spacer>
                      <div>
                        <v-btn
                          plain
                          @click="editAddress"
                        >
                          <p
                            class="my-0"
                          >Edit</p>
                        </v-btn>
                        <v-btn
                          plain
                          v-if="item.Default != 'Default'"
                          @click="deleteAddress"
                        >
                          <p
                            class="my-0"
                          >Delete</p>
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
      }
    },

    methods: {
      insertAddress() {

        
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
          this.items.push(item)
        }
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
      this.insertAddress();
    }
  }
</script>