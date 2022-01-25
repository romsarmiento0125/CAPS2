<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-btn
            outlined
            class="px-10 bgWhite"
            color="#787878"
            @click="openDialog"
          >
            <h4 class="fontTitle black--grey">
            Add new 
            </h4>
          </v-btn>
        </v-col>
        <v-col>
          <v-text-field
            append-icon="mdi-magnify"
            hide-details="auto"
            outlined
            dense
            color="#1106A0"
            rounded
            height="small"
            background-color="white"
            placeholder="Search for entire store here.."
            v-model="searchKey"
            v-on:keyup="toSearchItems(searchKey)"
          >
          </v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">
                    #
                  </th>
                  <th class="text-left">
                    Supplier Name
                  </th>
                  <th class="text-left">
                    Contact
                  </th>
                  <th class="text-left">
                    Address
                  </th>
                  <th class="text-left">
                    Supplied Product
                  </th>
                  <th class="text-left">
                    Notes
                  </th>
                  <th class="text-left">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(supplier, i) in showItems"
                  :key="i"
                >
                  <td>{{i+1}}</td>
                  <td>{{supplier.supplierName}}</td>
                  <td>{{supplier.contactNumber}}</td>
                  <td>{{supplier.address}}</td>
                  <td>{{supplier.product}}</td>
                  <td>{{supplier.notes}}</td>
                  <td>
                    <div
                      class="d-flex flex-column"
                    >
                      <v-btn
                        small
                        dark
                        color="#FFA600"
                        class="mt-2 my-1"
                        @click="updateSupplier(supplier)"
                      >
                        <p
                          class="my-0"
                        >Update</p>
                      </v-btn>
                      <v-btn
                        class="mb-2"
                        small
                        dark
                        color="#1106A0"
                        @click="deleteSupplier(supplier.id)"
                      >
                        <p
                          class="my-0"
                        >Delete</p>
                      </v-btn>
                    </div>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-col>
      </v-row>
    </v-container>
    <div>
      <v-dialog
        v-model="dialog"
        persistent
        max-width="600px"
      >
        <v-card>
          <v-card-title>
            <span class="my-2 ml-2 fontTitle">User Profile</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-text-field
                    v-model="supplierDetails.supplierName"
                    label="Supplier Name"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-text-field
                    v-model="supplierDetails.contact"
                    label="Contact"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    v-model="supplierDetails.address"
                    rows="2"
                    outlined
                    label="Address"
                  ></v-textarea>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="supplierDetails.supplierProduct"
                    label="Supplier Product"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    v-model="supplierDetails.notes"
                    outlined
                    label="Notes"
                  ></v-textarea>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="#1106A0"
              outlined
              class="px-10"
              @click="closeDialog"
            >
              Close
            </v-btn>
            <v-btn
              color="#1106A0"
              dark
              class="px-10"
              @click="addSupplier"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </div>
</template>

<script>
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    props:['customer'],

    data: () => ({
      dialog: false,
      supplierDetails: {
        supplierName: "",
        contact: "",
        address: "",
        supplierProduct: "",
        notes: "",
      },
      updateCond: false,
      itemId: "",
      searchKey: "",
      showItems: null,
    }),

    computed: {
      suppliers() {
        return this.$store.state.suppliers;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
      computedShowItems(){
        var sk = this.searchKey;
        var re = new RegExp(sk, 'gi');
        return this.showItems.filter((item) => {
          return item.supplierName.match(re);
        });
      },
    },

    watch: {
      suppliers() {
        this.getSupplierItems();
      },
    },

    methods: {
      updateSupplier(data){
        this.dialog = true;
        this.updateCond = true;
        this.supplierDetails.supplierName = data.supplierName;
        this.supplierDetails.contact = data.contactNumber;
        this.supplierDetails.address = data.address;
        this.supplierDetails.supplierProduct = data.product;
        this.supplierDetails.notes = data.notes;
        this.itemId = data.id;
      },
      deleteSupplier(id){
        axios.put(this.getDomain()+'api/editsupplier/'+id, {
          register: this.supplierDetails
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          this.$store.commit('suppliers', res.data.data);;
        })
        .catch(err => console.error(err));
      },
      openDialog(){
        this.dialog = true;
      },
      closeDialog(){
        this.dialog = false;
        this.updateCond = false;
        this.supplierDetails = {};
      },
      addSupplier(){
        this.dialog = false;
        if(this.updateCond){
          this.updateCond = false;
          axios.put(this.getDomain()+'api/supplier/'+this.itemId, {
            register: this.supplierDetails
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.$store.commit('suppliers', res.data.suppliers);
            this.supplierDetails = {};
          })
          .catch(err => console.error(err));
        }
        else{
          axios.post(this.getDomain()+'api/supplier/store', {
            register: this.supplierDetails
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.$store.commit('suppliers', res.data.suppliers);
            this.supplierDetails = {};
          })
          .catch(err => console.error(err));
        }
      },
      toSearchItems(){
        this.showItems = this.suppliers;
        this.showItems = this.computedShowItems;
      },
      getSupplierItems() {
        if(!(this.suppliers == null)){
          this.showItems = this.suppliers;
        }
      },
    },

    beforeMount(){
      this.getSupplierItems();
    }
  }
</script>
<style scoped>
.fontTitle{
  color: #464646;
}
.fontDesc{
  color: #858585;
}
.bgYellow{
  background-color: #FFA600;
}
.bgWhite{
  background-color: #FFF;
}
.nBorder{
    border: 1px solid #787885;
    border-radius: 5px; 
  }
</style>