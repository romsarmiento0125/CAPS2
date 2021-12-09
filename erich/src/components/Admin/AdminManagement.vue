<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div
            class="d-flex"
          >
            <v-btn
              color="blue"
              @click="gtStaffCustomer('st')"
            >Staff</v-btn>
            <v-btn
              color="yellow"
              @click="gtStaffCustomer('cs')"
            >Customer</v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <manage-staff v-if="manageStaff"></manage-staff>
    <manage-customer v-else-if="manageCustomer"></manage-customer>
  </div>
</template>

<script>
  import AdminManagementStaff from './AdminManagement/ManageStaff.vue'
  import AdminManagementCustomer from './AdminManagement/ManageCustomer.vue'

  export default {
    data: () => ({
      manageStaff: true,
      manageCustomer: false,
    }),

    methods: {
      gtStaffCustomer(cond) {
        if(cond == "st") {
          this.manageStaff = true;
          this.manageCustomer = false;
        }
        else if(cond == "cs") {
          this.manageStaff = false;
          this.manageCustomer = true;
        }
      }
    },

    components: {
      'manage-staff': AdminManagementStaff,
      'manage-customer': AdminManagementCustomer,
    }
  }
</script>