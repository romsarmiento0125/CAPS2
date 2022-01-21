<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-btn
            @click="openDialog"
          >Add new</v-btn>
        </v-col>
        <v-col>
          <div class="text-center">
            <v-menu offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  Sort
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
        <v-col>
          <v-text-field
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
                  @click="updateItem(item)"
                >
                  <v-icon
                    small
                    class="mr-2"
                  >
                    mdi-pencil
                  </v-icon>
                  <p
                    class="my-0"
                  >Update</p>
                </v-btn>
              </template>
          </v-data-table>
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
            <span class="text-h5">Add New Item</span>
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
                    v-model="item.suplierPrice"
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
                          color="primary"
                          dark
                          v-bind="attrs"
                          v-on="on"
                        >
                          {{item.category}}
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
                          color="primary"
                          dark
                          v-bind="attrs"
                          v-on="on"
                        >
                          {{item.underCategory}}
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
              color="blue darken-1"
              text
              @click="dialog = false"
            >
              Close
            </v-btn>
            <v-btn
              color="blue darken-1"
              text
              @click="saveItem"
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
        suplierPrice: null,
        discount: null,
        retailPrice: 0,
        quantity: null,
        qtyLimit: null,
        itemCode: "",
        category: "Baking Goods",
        underCategory: "Pasta",
        expirationDate: "",
        image: "",
      },
      expanded: [],
      singleExpand: false,
      headers: [
        { text: '#', value: 'id'},
        { text: 'Name', value: 'name'},
        // { text: 'Description', value: 'description'},
        { text: 'Supplier Price', value: 'supplierPrice'},
        { text: 'Retail Price', value: 'retailPrice'},
        { text: 'Size', value: 'size'},
        { text: 'Quantity', value: 'quantity'},
        // { text: 'Qty Limit', value: 'qtyLimit'},
        // { text: 'Item Code', value: 'itemCode'},
        { text: 'Category', value: 'category'},
        // { text: 'Discount', value: 'discount'},
        { text: 'Specific Category', value: 'underCategory'},
        // { text: 'Expiration Date', value: 'expirationDate'},
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
    },

    watch: {
      categoryItems() {
        this.getCategoryItems();
      },
    }, 

    methods: {
      openDialog(){
        this.dialog = true;
      },
      saveItem(){
        this.dialog = false;
        console.log(this.item);
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
          this.underCat = baking;
        }
        else if(cond == "Beverage"){
          this.item.category = "Beverage";
          this.item.underCategory = "Cofee-Tea";
          this.underCat = beverages;
        }
        else if(cond == "Bread-Bakery"){
          this.item.category = "Bread-Bakery";
          this.item.underCategory = "Sandwich";
          this.underCat = breadBakery;
        }
        else if(cond == "Canned Goods"){
          this.item.category = "Canned Goods";
          this.item.underCategory = "Fish";
          this.underCat = canGoods;
        }
        else if(cond == "Condiments"){
          this.item.category = "Condiments";
          this.item.underCategory = "Sauce";
          this.underCat = condiments;
        }
        else if(cond == "Dairy"){
          this.item.category = "Dairy";
          this.item.underCategory = "Cheese";
          this.underCat = dairy;
        }
        else if(cond == "Frozen Foods"){
          this.item.category = "Frozen Foods";
          this.item.underCategory = "Hotdog";
          this.underCat = frozenGoods;
        }
        else if(cond == "Laundry"){
          this.item.category = "Laundry";
          this.item.underCategory = "Fabric Softener";
          this.underCat = laundry;
        }
        else if(cond == "Noodles"){
          this.item.category = "Noodles";
          this.item.underCategory = "Cup Noodles";
          this.underCat = noodles;
        }
        else if(cond == "Personal Care"){
          this.item.category = "Personal Care";
          this.item.underCategory = "Shampoo";
          this.underCat = personalCare;
        }
        else if(cond == "Snacks"){
          this.item.category = "Snacks";
          this.item.underCategory = "Chips";
          this.underCat = snacks;
        }
        else if(cond == "Sweets"){
          this.item.category = "Sweets";
          this.item.underCategory = "Candy";
          this.underCat = sweets;
        }
      },
      assignUnderCat(val){
        this.item.underCategory = val;
      },
      getRetailPrice(){
        this.item.retailPrice = (this.item.suplierPrice - (this.item.suplierPrice * (this.item.discount / 100)));
        this.item.retailPrice = this.priceRound(this.item.retailPrice + (this.item.retailPrice * .05));
      },
      onFileChange(e){
        if(e == null){
          this.picUrl = null;
          this.item.image = "";
        }
        else{
          var crypto = require("crypto");
          var id = crypto.randomBytes(2).toString('hex');
          const file = e;
          this.picUrl = URL.createObjectURL(file);
          this.item.image = id + e.name;
          // console.log(this.item.image);
        }
      },
      updateItem(item){
        console.log(item);
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