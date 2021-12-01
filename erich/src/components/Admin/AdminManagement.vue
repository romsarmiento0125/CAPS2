<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-btn>Staff</v-btn>
        </v-col>
        <v-col>
          <v-btn>Customer</v-btn>
        </v-col>
      </v-row>
    </v-container>
    <manage-staff v-if="true"></manage-staff>
    <manage-customer v-else></manage-customer>
  </div>
</template>

<script>
  import AdminManagementStaff from './AdminManagement/ManageStaff.vue'
  import AdminManagementCustomer from './AdminManagement/ManageCustomer.vue'

  export default {
    components: {
      'manage-staff': AdminManagementStaff,
      'manage-customer': AdminManagementCustomer,
    }
  }
</script>