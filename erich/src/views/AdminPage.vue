<template>
  <div>
    <div>
      <v-app id="inspire" style="background: #F5F5F5;">

        <v-navigation-drawer
          app
          color="#1106A0"
          
        >
          <v-sheet
            class="pa-4 bg" 
          >
            <v-row>
              <v-col cols="9">
                <router-link
                  to="/"
                >
                  <v-img
                    contain
                    src="../assets/ERICHWHITE.svg"
                    max-height="120px"
                    max-width="120px"
                    class="ml-3"
                  >
                  </v-img>
                </router-link>
              </v-col>

              <v-col cols="3">
                <div class="d-flex justify-end">
                  <v-btn
                    text
                  @click="sideBarPicker"
                  >
                    <v-img
                    src="../assets/refresh.png"
                    max-height="30px"
                    max-width="30px"
                    >
                    </v-img>
                </v-btn>
                </div>
              </v-col>
            </v-row>
            
          </v-sheet>

          <v-divider class="dColor"></v-divider>

          <v-list>
            <v-list-item
              v-for="link in links"
              :key="link.id"
              link
            >
              <!-- <v-list-item-icon>
                <v-icon>{{ icon }}</v-icon>
              </v-list-item-icon> -->

              <v-list-item-content>
                <v-list-item-title>
                  <v-btn
                    text
                    color="#fff"
                    :to="{name: link.Admin , params: { id: link.AdminId , title: link.AdminTitle}}"
                    @click="adminSidebar(link.AdminCondition)"
                  >
                    {{ link.AdminName }}
                  </v-btn>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-navigation-drawer>

        <v-main
          class="pa-0"
        >
          <v-container
            class="py-8 px-6"
            fluid
            
          >
            <v-row>
              <v-col>
                <admin-onlineSales v-if="aOnlineSales"></admin-onlineSales>
                <admin-offlineSales v-else-if="aOfflineSales"></admin-offlineSales>
                <admin-transactions v-else-if="aTransactions"></admin-transactions>
                <admin-inventory v-else-if="aInventory"></admin-inventory>
                <admin-supplierList v-else-if="aSupplierList"></admin-supplierList>
                <admin-management v-else-if="aManagement"></admin-management>
                <admin-dashboard v-else-if="aDashboard"></admin-dashboard>
              </v-col>
            </v-row>
          </v-container>
        </v-main>
      </v-app>
    </div>
  </div>
</template>

<script>
  import AdminDashboard from '../components/Admin/AdminDashboard.vue'
  import AdminOnlineSales from '../components/Admin/AdminOnlineSales.vue'
  import AdminOfflineSales from '../components/Admin/AdminOfflineSales.vue'
  import AdminTransactions from '../components/Admin/AdminTransactions.vue'
  import AdminInventoryItems from '../components/Admin/AdminInventoryItems.vue'
  import AdminSupplierList from '../components/Admin/AdminSupplierList.vue'
  import AdminManagement from '../components/Admin/AdminManagement.vue'
  import {Mixins} from '../Mixins/mixins.js'

  export default{
    name: 'Admin',
    mixins: [Mixins],

    components: {
      'admin-dashboard': AdminDashboard,
      'admin-onlineSales': AdminOnlineSales,
      'admin-offlineSales': AdminOfflineSales,
      'admin-transactions': AdminTransactions,
      'admin-inventory': AdminInventoryItems,
      'admin-supplierList': AdminSupplierList,
      'admin-management': AdminManagement,
    },

    data: () => ({
      aDashboard: true,
      aOnlineSales: false,
      aOfflineSales: false,
      aTransactions: false,
      aInventory: false,
      aManagement: false,
      aSupplierList: false,
      links: [],
    }),

    computed: {
      usersTag(){
        return this.$store.state.userTag;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    watch:{
      usersTag(){
        this.sideBarPicker();
      }
    },

    methods: {
      adminSidebar(cond){
        if(cond == "aon") {
          this.aDashboard = false,
          this.aOnlineSales = true,
          this.aOfflineSales = false;
          this.aTransactions = false;
          this.aInventory = false;
          this.aSupplierList = false;
          this.aManagement = false;
        }
        else if(cond == "aof") {
          this.aDashboard = false,
          this.aOnlineSales = false,
          this.aOfflineSales = true;
          this.aTransactions = false;
          this.aInventory = false;
          this.aSupplierList = false;
          this.aManagement = false;
        }
        else if(cond == "at") {
          this.aDashboard = false,
          this.aOnlineSales = false,
          this.aOfflineSales = false;
          this.aTransactions = true;
          this.aInventory = false;
          this.aSupplierList = false;
          this.aManagement = false;
        }
        else if(cond == "ai") {
          this.aDashboard = false,
          this.aOnlineSales = false,
          this.aOfflineSales = false;
          this.aTransactions = false;
          this.aInventory = true;
          this.aSupplierList = false;
          this.aManagement = false;
        }
        else if(cond == "asl") {
          this.aDashboard = false,
          this.aOnlineSales = false,
          this.aOfflineSales = false;
          this.aTransactions = false;
          this.aInventory = false;
          this.aSupplierList = true;
          this.aManagement = false;
        }
        else if(cond == "am") {
          this.aDashboard = false,
          this.aOnlineSales = false,
          this.aOfflineSales = false;
          this.aTransactions = false;
          this.aInventory = false;
          this.aSupplierList = false;
          this.aManagement = true;
        }
        else if(cond == "as"){
          this.aDashboard = true,
          this.aOnlineSales = false,
          this.aOfflineSales = false;
          this.aTransactions = false;
          this.aInventory = false;
          this.aSupplierList = false;
          this.aManagement =false;
        }
        else {
          this.aOnlineSales = false,
          this.aOfflineSales = false;
          this.aTransactions = false;
          this.aInventory = false;
          this.aSupplierList = false;
          this.aManagement =false;
        }
      },
      sideBarPicker(){
        var l1 = {id: 1, AdminName: 'Dashboard', AdminCondition: 'as', Admin: 'Admin', AdminId: 'dashboard', AdminTitle: 'Dashboard'};
        var l2 = {id: 2, AdminName: 'Online Sales', AdminCondition: 'aon', Admin: 'Admin', AdminId: 'onlinesales', AdminTitle: 'Online Sales'};
        var l3 = {id: 3, AdminName: 'Offline Sales', AdminCondition: 'aof', Admin: 'Admin', AdminId: 'offlinesales', AdminTitle: 'Offline Sales'};
        var l4 = {id: 4, AdminName: 'Transactions', AdminCondition: 'at', Admin: 'Admin', AdminId: 'transaction', AdminTitle: 'Transaction'};
        var l5 = {id: 5, AdminName: 'Inventory', AdminCondition: 'ai', Admin: 'Admin', AdminId: 'inventory', AdminTitle: 'Inventory'};
        var l6 = {id: 6, AdminName: 'Supplier List', AdminCondition: 'asl', Admin: 'Admin', AdminId: 'supplierlist', AdminTitle: 'Supplier List'};
        var l7 = {id: 7, AdminName: 'Admin Management', AdminCondition: 'am', Admin: 'Admin', AdminId: 'management', AdminTitle: 'Management'};

        this.links = [];

        if(this.usersTag == "Admin"){
          this.links.push(l1);
          this.links.push(l2);
          this.links.push(l3);
          this.links.push(l4);
          this.links.push(l5);
          this.links.push(l6);
          this.links.push(l7);
          axios.get(this.getDomain()+'api/adminalldata',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('adminDataDeliver', res.data.deliver);
            this.$store.commit('adminDataPickup', res.data.pickup);
            this.$store.commit('adminDataPhysical', res.data.physical);
            this.$store.commit('allPeople', res.data.user);
            this.$store.commit('suppliers', res.data.supplier);
          })
          .catch(err => console.error(err));
        }
        else if(this.usersTag == "Encoder"){
          this.links.push(l5);
          this.links.push(l6);
          this.aDashboard = false,
          this.aOnlineSales = false,
          this.aOfflineSales = false;
          this.aTransactions = false;
          this.aInventory = true;
          this.aSupplierList = false;
          this.aManagement = false;
          axios.get(this.getDomain()+'api/supplier',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data.data);
            this.$store.commit('suppliers', res.data.data);
          })
          .catch(err => console.error(err));
        }
      }
    },
    beforeMount(){
      this.sideBarPicker();
      
    },
  }
</script>

<style scoped>
.bg{
  background-color: #1106A0;

}
.dColor{
  background-color: #fff;
}
</style>