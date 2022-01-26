<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col cols="1" class="mx-0">
          <v-btn
            outlined
            color="#787878"
            class="px-10 bgWhite"
            @click="dialog = true"
          >
          <h4 class="fontTitle black--grey"> Add new</h4>
          </v-btn>
        </v-col>

        <v-col cols="1" class="mx-10">
          <div class="">
            <v-menu offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  outlined
                  class="px-6 bgWhite"
                  color="#787878"
                  
                  v-bind="attrs"
                  v-on="on"
                >
                <v-icon size="20px" class="mr-1"> mdi-sort </v-icon>
                  <h4 class="fontTitle black--grey">Sort</h4>
                </v-btn>
              </template>
              <v-list>
                <v-list-item
                  v-for="(item, index) in items"
                  :key="index"
                >
                  <v-list-item-title
                    @click="toSortItems(item.titleCond)"
                  >{{ item.title }}</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </div>
        </v-col>

        <v-col cols="6" class="justify-center">
          <v-text-field
            rounded
            color="#1106A0"
            append-icon="mdi-magnify"
            hide-details="auto"
            outlined
            dense
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
          <v-data-table
            :headers="headers"
            :items="showItems"
            :single-expand="singleExpand"
            :expanded.sync="expanded"
            item-key="itemCode"
            show-expand
            class="elevation-1"
          >
            <template v-slot:expanded-item="{ headers, item }">
              <td :colspan="headers.length">
                Description: {{ item.description }} &nbsp;
                Quantity Limit: {{item.qtyLimit}} &nbsp;
                Item Code: {{item.itemCode}} &nbsp;
                Discount: {{item.discount}} &nbsp;
                Expiration Date: {{item.expirationDate}} &nbsp;
              </td>
            </template>
              <template v-slot:[`item.actions`]="{ item }">
                <v-btn
                  dark
                  color="#ffA600"
                  class="mt-2 my-1"
                  @click="updateItem(item)"
                  block
                >
                  <v-icon
                    small
                    class="mr-2"
                  >
                    mdi-pencil
                  </v-icon>
                  <p
                    class="my-0"
                  >Update Items</p>
                </v-btn>
                <v-btn
                  class="mb-2"
                  dark
                  color="#1106A0"
                  @click="updatePhotoDialog(item.id)"
                  block
                >
                  <v-icon
                    small
                    class="mr-2"
                  >
                    mdi-camera
                  </v-icon>
                  <p
                    class="my-0"
                  >Change Photo</p>
                </v-btn>
              </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
    <!-- Add New Dialog -->
    <div>
      <v-dialog
        v-model="dialog"
        persistent
        max-width="600px"
      >
        <v-card>
          <v-card-title>
            <span class="my-2 ml-2 fontTitle">Add New Item</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <!-- First Row -->
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    v-model="item.name"
                    label="Name"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    v-model="item.desc"
                    label="Description"
                  ></v-text-field>
                </v-col>
                 <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    v-model="item.size"
                    label="Size"
                  ></v-text-field>
                </v-col>

                <!-- Second Row -->
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    v-model="item.supplierPrice"
                    label="Supplier Price"
                    @change="getRetailPrice"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    v-model="item.discount"
                    label="Discount"
                    @change="getRetailPrice"
                  ></v-text-field>
                </v-col>
                 <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    disabled
                    v-model="item.retailPrice"
                    label="Retail Price"
                  ></v-text-field>
                </v-col>
               
                <!-- Third Row -->
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    v-model="item.quantity"
                    label="Quantity"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    v-model="item.qtyLimit"
                    label="Quantity Limit"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    v-model="item.itemCode"
                    label="Item Code"
                  ></v-text-field>
                </v-col>

                <!-- Fourth Row -->
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <div class="text-center">
                    <v-menu offset-y>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          color="#787878"
                          outlined

                          v-bind="attrs"
                          v-on="on"
                        >
                          <h4 class="fontTitle">{{item.category}}</h4>
                        </v-btn>
                      </template>
                      <v-list>
                        <v-list-item
                          v-for="(item, index) in cat"
                          :key="index"
                        >
                          <v-btn
                            plain
                            @click="assignCategory(item.title)"
                          >
                            <p
                              class="my-0"
                            >{{item.title}}</p>
                          </v-btn>
                        </v-list-item>
                      </v-list>
                    </v-menu>
                  </div>
                </v-col>
                 <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <div class="text-center ml-n16">
                    <v-menu offset-y>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          color="#787878"
                          outlined
                          v-bind="attrs"
                          v-on="on"
                        >
                          <h4 class="fontTitle">{{item.underCategory}}</h4>
                        </v-btn>
                      </template>
                      <v-list>
                        <v-list-item
                          v-for="(item, index) in underCat"
                          :key="index"
                        >
                          <v-btn
                            plain
                            @click="assignUnderCat(item.title)"
                          >
                            <p
                              class="my-0"
                            >{{item.title}}</p>
                          </v-btn>
                        </v-list-item>
                      </v-list>
                    </v-menu>
                  </div>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    :return-value.sync="date"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="item.expirationDate"
                        label="Picker in menu"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="item.expirationDate"
                      no-title
                      scrollable
                    >
                      <v-spacer></v-spacer>
                      <v-btn
                        text
                        color="primary"
                        @click="menu = false"
                      >
                        Cancel
                      </v-btn>
                      <v-btn
                        text
                        color="primary"
                        @click="$refs.menu.save(date)"
                      >
                        OK
                      </v-btn>
                    </v-date-picker>
                  </v-menu>
                </v-col>
               
                <!-- Photo -->
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-file-input
                    color="deep-purple accent-4"
                    prepend-icon="mdi-paperclip"
                    accept="image/*"
                    label="Select Photo"
                    outlined
                    type="file"
                    :show-size="1000"
                    @change="onFileChange"
                  >
                  </v-file-input>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-img
                    contain
                    max-height="200"
                    max-width="200"
                    :src="picUrl"
                  ></v-img>
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
              text
              @click="dialog = false"
            >
              Close
            </v-btn>
            <v-btn
              color="#1106A0"
              dark
              class="px-10"
              @click="checkInputs"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <!-- Update Dialog -->
    <div>
      <v-dialog
        v-model="updateDialog"
        persistent
        max-width="600px"
      >
        <v-card>
          <v-card-title>
            <span class="my-2 ml-2">Update Item</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <!-- First Row -->
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    v-model="update.name"
                    label="Name"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    v-model="update.desc"
                    label="Description"
                  ></v-text-field>
                </v-col>
                 <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    v-model="update.size"
                    label="Size"
                  ></v-text-field>
                </v-col>

                <!-- Second Row -->
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    v-model="update.supplierPrice"
                    label="Supplier Price"
                    @change="getRetailPrice"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    v-model="update.discount"
                    label="Discount"
                    @change="getRetailPrice"
                  ></v-text-field>
                </v-col>
                 <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    disabled
                    v-model="update.retailPrice"
                    label="Retail Price"
                  ></v-text-field>
                </v-col>
               
                <!-- Third Row -->
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    v-model="update.quantity"
                    label="Quantity"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    type="number"
                    v-model="update.qtyLimit"
                    label="Quantity Limit"
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-text-field
                    v-model="update.itemCode"
                    label="Item Code"
                  ></v-text-field>
                </v-col>

                <!-- Fourth Row -->
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <div class="text-center">
                    <v-menu offset-y>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          color="#787878"
                          outlined
                          v-bind="attrs"
                          v-on="on"
                        >
                          <h4 class="fontTitle">{{update.category}}</h4>
                        </v-btn>
                      </template>
                      <v-list>
                        <v-list-item
                          v-for="(item, index) in cat"
                          :key="index"
                        >
                          <v-btn
                            plain
                            @click="assignCategory(item.title)"
                          >
                            <p
                              class="my-0"
                            >{{item.title}}</p>
                          </v-btn>
                        </v-list-item>
                      </v-list>
                    </v-menu>
                  </div>
                </v-col>
                 <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <div class="text-center">
                    <v-menu offset-y>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          color="#787878"
                          outlined
                          class="ml-n16"
                          v-bind="attrs"
                          v-on="on"
                        >
                          <h4 class="fontTitle">{{update.underCategory}}</h4>                        
                        </v-btn>
                        </template>
                      <v-list>
                        <v-list-item
                          v-for="(item, index) in underCat"
                          :key="index"
                        >
                          <v-btn
                            plain
                            @click="assignUnderCat(item.title)"
                          >
                            <p
                              class="my-0"
                            >{{item.title}}</p>
                          </v-btn>
                        </v-list-item>
                      </v-list>
                    </v-menu>
                  </div>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="4"
                >
                  <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    :return-value.sync="date"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="update.expirationDate"
                        label="Picker in menu"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="update.expirationDate"
                      no-title
                      scrollable
                    >
                      <v-spacer></v-spacer>
                      <v-btn
                        text
                        color="primary"
                        @click="menu = false"
                      >
                        Cancel
                      </v-btn>
                      <v-btn
                        text
                        color="primary"
                        @click="$refs.menu.save(date)"
                      >
                        OK
                      </v-btn>
                    </v-date-picker>
                  </v-menu>
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
              
              @click="updateDialog = false"
            >
              Close
            </v-btn>
            <v-btn
              color="#1106A0"
              dark
              class="px-10"
              @click="saveUpdate"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <!-- Change Photo -->
    <div>
      <v-dialog
        v-model="changePhotoDialog"
        persistent
        max-width="600px"
      >
        <v-card>
          <v-card-title>
            <span class="my-2 ml-2 fontTitle">Change Photo</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <!-- Photo  -->
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-file-input
                    color="deep-purple accent-4"
                    prepend-icon="mdi-paperclip"
                    accept="image/*"
                    label="Select Photo"
                    outlined
                    type="file"
                    :show-size="1000"
                    @change="onPhotoChange"
                  >
                  </v-file-input>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-img
                    contain
                    max-height="200"
                    max-width="200"
                    :src="changePicUrl"
                  ></v-img>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="#1106a0"
              class="px-10"
              outlined
              @click="changePhotoDialog = false"
            >
              Close
            </v-btn>
            <v-btn
              color="#1106A0"
              dark
              class="px-10"
              @click="changePhoto"
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

    data: () => ({
      changePhotoDialog: false,
      changePicUrl: null,
      changeImage: null,
      updateDialog: false,
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      picUrl: null,
      cat: [
        { title: 'Baking' },
        { title: 'Beverage' },
        { title: 'Bread-Bakery' },
        { title: 'Canned Goods' },
        { title: 'Condiments' },
        { title: 'Dairy' },
        { title: 'Frozen Foods' },
        { title: 'Laundry' },
        { title: 'Noodles' },
        { title: 'Personal Care' },
        { title: 'Snacks' },
        { title: 'Sweets' },
      ],
      underCat: [
        { title: 'Pasta' },
        { title: 'Cereals' },
        { title: 'Sugar' },
        { title: 'Mixes' },
      ],
      item: {
        name: "",
        desc: "",
        size: "",
        supplierPrice: null,
        discount: null,
        retailPrice: 0,
        quantity: null,
        qtyLimit: null,
        itemCode: "",
        category: "Baking Goods",
        underCategory: "Pasta",
        expirationDate: "",
      },
      update: {
        id: 0,
        name: "",
        desc: "",
        size: "",
        supplierPrice: null,
        discount: null,
        retailPrice: 0,
        quantity: null,
        qtyLimit: null,
        itemCode: "",
        category: "Baking Goods",
        underCategory: "Pasta",
        expirationDate: "",
      },
      itemImage: null,
      expanded: [],
      singleExpand: false,
      headers: [
        { text: '#', value: 'id'},
        { text: 'Name', value: 'name'},
        { text: 'Supplier Price', value: 'supplierPrice'},
        { text: 'Retail Price', value: 'retailPrice'},
        { text: 'Size', value: 'size'},
        { text: 'Quantity', value: 'quantity'},
        { text: 'Category', value: 'category'},
        { text: 'Specific Category', value: 'underCategory'},
        { text: 'Action', value: 'actions'},
      ],
      dialog: false,
      profiles: ['gg'],
      items: [
        { title: 'Id', titleCond: 'id' },
        { title: 'Near To Expire', titleCond: 'date' },
        { title: 'A-Z', titleCond: 'az' },
        { title: 'Z-A', titleCond: 'za' },
        { title: 'Lowest Price', titleCond: 'lowprice' },
        { title: 'Highest Price', titleCond: 'hiprice' },
      ],
      searchKey: "",
      showItems: null,
      photoId: 0,
    }),

    computed: {
      categoryItems() {
        return this.$store.state.categoryItems;
      },
      computedShowItems(){
        var sk = this.searchKey;
        var re = new RegExp(sk, 'gi');
        return this.showItems.filter((item) => {
          return item.name.match(re);
        });
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    watch: {
      categoryItems() {
        this.getCategoryItems();
      },
    }, 

    methods: {
      updatePhotoDialog(id){
        this.changePhotoDialog = true;
        this.photoId = id;
      },
      changePhoto(){
        // console.log("change photo");
        this.changePhotoDialog = false;
        // console.log(this.changeImage);
        // console.log(this.photoId);
        let formData = new FormData;
        formData.append("photo", this.changeImage);
        formData.append("id", this.photoId);
        // console.log(formData);
        if(this.changeImage == null){
          alert("Insert Image");
        }
        else{
          axios.post(this.getDomain()+'api/invphoto/store', formData,
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
              'content-type': 'multipart/form-data'
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeCategoryItem', res.data.allItems);
            this.$store.commit('imagePath', res.data.path);
          })
          .catch(err => console.error(err));
        }
      },
      onPhotoChange(e){
        if(e == null){
          this.changePicUrl = null;
          this.changeImage = "";
        }
        else{
          this.changePicUrl = URL.createObjectURL(e);
          this.changeImage = e;
          // console.log(this.item.image);
        }
      },
      checkInputs(){
        if((this.item.name == "") || (this.item.desc == "") || (this.item.size == "") || (this.item.supplierPrice == null) ||
          (this.item.discount == null) || (this.item.quantity == null) || (this.item.qtyLimit == null) || (this.item.itemCode == "") ||
          (this.item.expirationDate == "") || (this.itemImage == null)){
          alert("Complete Input Feilds");
        }
        else{
          this.saveItem();
        }
      },
      saveItem(){
        this.dialog = false;
        console.log(this.item);
        let formData = new FormData;
        formData.append("image", this.itemImage);
        for(let property in this.item)
        {
        formData.append(property,this.item[property]);
        }
        
        axios.post(this.getDomain()+'api/inventory/store', formData,
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
            'content-type': 'multipart/form-data'
        }
        })
        .then(res => {
          if(res.data.cond){
            alert(res.data.message);
          }
          else{
            this.$store.commit('storeCategoryItem', res.data.allItems);
            this.$store.commit('imagePath', res.data.path);
          }
          
        })
        .catch(err => console.error(err));
      },
      assignCategory(cond){
        var baking = [{ title: 'Pasta' },{ title: 'Cereals' },{ title: 'Sugar' },{ title: 'Mixes' }];
        var beverages = [{ title: 'Cofee-Tea' },{ title: 'Carbonated Drinks' },{ title: 'Juice' },{ title: 'Milk' },{ title: 'Chocalate' },{ title: 'Energy Drinks' }];
        var breadBakery = [{ title: 'Sandwich' },{ title: 'Pastries' },{ title: 'Cakes' },{ title: 'Biscuit' }];
        var canGoods = [{ title: 'Fish' },{ title: 'Meat' },{ title: 'Beef' },{ title: 'Vegetables' }];
        var condiments = [{ title: 'Sauce' },{ title: 'Paste' }];
        var dairy = [{ title: 'Cheese' },{ title: 'Butter' },{ title: 'Margarine' },{ title: 'Milk' },{ title: 'Cream' }];
        var frozenGoods = [{ title: 'Hotdog' },{ title: 'Nuggets' },{ title: 'Ham' }];
        var laundry = [{ title: 'Fabric Softener' },{ title: 'Liquid Detergent' },{ title: 'Powder Detergent'},{ title: 'Dishwashing Liquid'}];
        var noodles = [{ title: 'Cup Noodles' },{ title: 'Pancit Canton' },{ title: 'Instant noodles'}];
        var personalCare = [{ title: 'Shampoo' },{ title: 'Soap' },{ title: 'Toothpaste'}];
        var snacks = [{ title: 'Chips' },{ title: 'Crackers' },{ title: 'Nuts'},{ title: 'Pretzels'},{ title: 'Biscuits'},{ title: 'Popcorn'}];
        var sweets = [{ title: 'Candy' },{ title: 'Candy Bar' }];
        if(cond == "Baking"){
          this.item.category = "Baking";
          this.item.underCategory = "Pasta";
          this.update.category = "Baking";
          this.update.underCategory = "Pasta";
          this.underCat = baking;
        }
        else if(cond == "Beverage"){
          this.item.category = "Beverage";
          this.item.underCategory = "Cofee-Tea";
          this.update.category = "Beverage";
          this.update.underCategory = "Cofee-Tea";
          this.underCat = beverages;
        }
        else if(cond == "Bread-Bakery"){
          this.item.category = "Bread-Bakery";
          this.item.underCategory = "Sandwich";
          this.update.category = "Bread-Bakery";
          this.update.underCategory = "Sandwich";
          this.underCat = breadBakery;
        }
        else if(cond == "Canned Goods"){
          this.item.category = "Canned Goods";
          this.item.underCategory = "Fish";
          this.update.category = "Canned Goods";
          this.update.underCategory = "Fish";
          this.underCat = canGoods;
        }
        else if(cond == "Condiments"){
          this.item.category = "Condiments";
          this.item.underCategory = "Sauce";
          this.update.category = "Condiments";
          this.update.underCategory = "Sauce";
          this.underCat = condiments;
        }
        else if(cond == "Dairy"){
          this.item.category = "Dairy";
          this.item.underCategory = "Cheese";
          this.update.category = "Dairy";
          this.update.underCategory = "Cheese";
          this.underCat = dairy;
        }
        else if(cond == "Frozen Foods"){
          this.item.category = "Frozen Foods";
          this.item.underCategory = "Hotdog";
          this.update.category = "Frozen Foods";
          this.update.underCategory = "Hotdog";
          this.underCat = frozenGoods;
        }
        else if(cond == "Laundry"){
          this.item.category = "Laundry";
          this.item.underCategory = "Fabric Softener";
          this.update.category = "Laundry";
          this.update.underCategory = "Fabric Softener";
          this.underCat = laundry;
        }
        else if(cond == "Noodles"){
          this.item.category = "Noodles";
          this.item.underCategory = "Cup Noodles";
          this.update.category = "Noodles";
          this.update.underCategory = "Cup Noodles";
          this.underCat = noodles;
        }
        else if(cond == "Personal Care"){
          this.item.category = "Personal Care";
          this.item.underCategory = "Shampoo";
          this.update.category = "Personal Care";
          this.update.underCategory = "Shampoo";
          this.underCat = personalCare;
        }
        else if(cond == "Snacks"){
          this.item.category = "Snacks";
          this.item.underCategory = "Chips";
          this.update.category = "Snacks";
          this.update.underCategory = "Chips";
          this.underCat = snacks;
        }
        else if(cond == "Sweets"){
          this.item.category = "Sweets";
          this.item.underCategory = "Candy";
          this.update.category = "Sweets";
          this.update.underCategory = "Candy";
          this.underCat = sweets;
        }
      },
      assignUnderCat(val){
        this.item.underCategory = val;
      },
      getRetailPrice(){
        this.item.retailPrice = (this.item.supplierPrice - (this.item.supplierPrice * (this.item.discount / 100)));
        this.item.retailPrice = this.priceRound(this.item.retailPrice + (this.item.retailPrice * .05));
      },
      onFileChange(e){
        if(e == null){
          this.picUrl = null;
          this.itemImage = "";
        }
        else{
          this.picUrl = URL.createObjectURL(e);
          this.itemImage = e;
          // console.log(this.item.image);
        }
      },
      saveUpdate(){
        this.updateDialog = false;
        console.log(this.update);
        axios.put(this.getDomain()+'api/invitems/'+this.update.id, {
          register: this.update
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          console.log(res.data);
          this.$store.commit('storeCategoryItem', res.data.allItems);
            this.$store.commit('imagePath', res.data.path);
        })
        .catch(err => console.error(err));
      },
      updateItem(item){
        console.log(item);
        this.updateDialog = true;
        this.update.id = item.id;
        this.update.name = item.name;
        this.update.desc = item.description;
        this.update.size = item.size;
        this.update.supplierPrice = item.supplierPrice;
        this.update.discount = item.discount;
        this.update.retailPrice = item.retailPrice;
        this.update.quantity = item.quantity;
        this.update.qtyLimit = item.qtyLimit;
        this.update.itemCode = item.itemCode;
        this.update.category = item.category;
        this.update.underCategory = item.underCategory;
        this.update.expirationDate = item.expirationDate;
      },
      toSortItems(cond){
        if(cond == "az"){
          this.showItems.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));
        }
        else if(cond == "date"){
          this.showItems.sort((a,b) => (a.expirationDate > b.expirationDate) ? 1 : ((b.expirationDate > a.expirationDate) ? -1 : 0));
        }
        else if(cond == "za"){
          this.showItems.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));
          this.showItems.reverse();
        }
        else if(cond == "lowprice"){
          this.showItems.sort((a,b) => ((a.retailPrice * 1) > (b.retailPrice * 1)) ? 1 : (((b.retailPrice * 1) > (a.retailPrice * 1)) ? -1 : 0));
        }
        else if(cond == "hiprice"){
          this.showItems.sort((a,b) => ((a.retailPrice * 1) > (b.retailPrice * 1)) ? 1 : (((b.retailPrice * 1) > (a.retailPrice * 1)) ? -1 : 0));
          this.showItems.reverse();
        }
        else if(cond == "id"){
          this.showItems.sort((a,b) => (a.id > b.id) ? 1 : ((b.id > a.id) ? -1 : 0));
        }
      },
      toSearchItems(){
        this.showItems = this.categoryItems;
        this.showItems = this.computedShowItems;
      },
      getCategoryItems() {
        if(!(this.categoryItems == null)){
          this.showItems = this.categoryItems;
        }
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      }
    },
    beforeMount(){
      this.getCategoryItems();
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