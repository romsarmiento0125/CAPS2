<template>
  <div>
    <div>
      <h1>This is admin page container</h1>
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
      <admin-dashboard v-else></admin-dashboard>
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