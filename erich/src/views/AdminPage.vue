<template>
  <div>
    <div>
      <v-app id="inspire">

        <v-navigation-drawer
          app
        >
          <v-sheet
            color="grey lighten-4"
            class="pa-4"
          >
            <v-avatar
              class="mb-4"
              color="grey darken-1"
              size="64"
            ></v-avatar>

            <div>john@vuetifyjs.com</div>
          </v-sheet>

          <v-divider></v-divider>

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
                <v-list-item-title
                  
                  
                >
                  <v-btn
                    color="primary"
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

        <v-main>
          <v-container
            class="py-8 px-6"
            fluid
          >
            <v-row>
              <v-col>
                <admin-transactions v-if="aTransactions"></admin-transactions>
                <admin-inventory v-else-if="aInventory"></admin-inventory>
                <admin-management v-else-if="aManagement"></admin-management>
                <admin-dashboard v-else></admin-dashboard>
              </v-col>
            </v-row>
          </v-container>
        </v-main>
      </v-app>

      <!-- <h1>This is admin page container</h1>
      <v-btn
        color="primary"
        :to="{name: 'Admin' , params: { id: 'dashboard', title: 'DashBoard'}}"
        @click="adminSidebar('as')"
      >
        Dashboard
      </v-btn>
      <v-btn
        color="primary"
        :to="{name: 'Admin' , params: { id: 'transactions', title: 'Transactions'}}"
        @click="adminSidebar('at')"
      >
        Transactions
      </v-btn>
      <v-btn
        color="primary"
        :to="{name: 'Admin' , params: { id: 'inventory', title: 'Inventory'}}"
        @click="adminSidebar('ai')"
      >
        Inventory
      </v-btn>
      <v-btn
        color="primary"
        :to="{name: 'Admin' , params: { id: 'management', title: 'Management'}}"
        @click="adminSidebar('am')"
      >
        Admin Management
      </v-btn>
      <admin-transactions v-if="aTransactions"></admin-transactions>
      <admin-inventory v-else-if="aInventory"></admin-inventory>
      <admin-management v-else-if="aManagement"></admin-management>
      <admin-dashboard v-else></admin-dashboard> -->
    </div>
  </div>
</template>

<script>
  import AdminDashboard from '../components/Admin/AdminDashboard.vue'
  import AdminTransactions from '../components/Admin/AdminTransactions.vue'
  import AdminInventoryItems from '../components/Admin/AdminInventoryItems.vue'
  import AdminManagement from '../components/Admin/AdminManagement.vue'

  export default{
    name: 'Admin',

    components: {
      'admin-dashboard': AdminDashboard,
      'admin-transactions': AdminTransactions,
      'admin-inventory': AdminInventoryItems,
      'admin-management': AdminManagement,
    },

    data: () => ({
      aTransactions: false,
      aInventory: false,
      aManagement: false,
      links: [
        {id: 1, AdminName: 'Dashboard', AdminCondition: 'as', Admin: 'Admin', AdminId: 'dashboard', AdminTitle: 'Dashboard'},
        {id: 2, AdminName: 'Transactions', AdminCondition: 'at', Admin: 'Admin', AdminId: 'transaction', AdminTitle: 'Transaction'},
        {id: 3, AdminName: 'Inventory', AdminCondition: 'ai', Admin: 'Admin', AdminId: 'inventory', AdminTitle: 'Inventory'},
        {id: 4, AdminName: 'Admin Management', AdminCondition: 'am', Admin: 'Admin', AdminId: 'management', AdminTitle: 'Management'},
      ],
    }),

    methods: {
      adminSidebar(cond){
        if(cond == "at") {
          this.aTransactions = true;
          this.aInventory = false;
          this.aManagement = false;
        }
        else if(cond == "ai") {
          this.aTransactions = false;
          this.aInventory = true;
          this.aManagement = false;
        }
        else if(cond == "am") {
          this.aTransactions = false;
          this.aInventory = false;
          this.aManagement = true;
        }
        else {
          this.aTransactions = false;
          this.aInventory = false;
          this.aManagement = false;
        }
      }
    }
  }
</script>