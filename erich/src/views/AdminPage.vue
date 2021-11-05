<template>
  <div>
    <div>
      <h1>This is admin page container</h1>
      <admin-dashboard></admin-dashboard>
      <admin-transactions></admin-transactions>
      <admin-inventory></admin-inventory>
      <admin-management></admin-management>
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
  }

  }
</script>