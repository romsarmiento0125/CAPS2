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
    <manage-staff v-if="manageStaff" :staff="staffPerson"></manage-staff>
    <manage-customer v-else-if="manageCustomer" :customer="customerPerson"></manage-customer>
  </div>
</template>

<script>
  import AdminManagementStaff from './AdminManagement/ManageStaff.vue'
  import AdminManagementCustomer from './AdminManagement/ManageCustomer.vue'

  export default {
    data: () => ({
      manageStaff: true,
      manageCustomer: false,
      staffPerson: [],
      customerPerson: [],
    }),

    computed: {
      allPeople() {
        return this.$store.state.allPeople;
      },
    },

    watch: {
      allPeople(){
        this.sortPeople();
      }
    },

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
      },
      sortPeople(){
        if(this.allPeople == null){
          this.staffPerson = [];
          this.customerPerson = [];
        }
        else{
          this.staffPerson = [];
          this.customerPerson = [];
          this.allPeople.forEach(data => {
            if(data.tag == "Customer"){
              this.customerPerson.push({
                birthday: data.birthday,
                email: data.email,
                first_Name: data.first_Name,
                gender: data.gender,
                id: data.id,
                last_Name: data.last_Name,
                mobile_Number: data.mobile_Number,
                status: data.status,
                tag: data.tag,
              });
            }
            else{
              this.staffPerson.push({
                birthday: data.birthday,
                email: data.email,
                first_Name: data.first_Name,
                gender: data.gender,
                id: data.id,
                last_Name: data.last_Name,
                mobile_Number: data.mobile_Number,
                status: data.status,
                tag: data.tag,
              });
            }
          });
        }
      }
    },

    components: {
      'manage-staff': AdminManagementStaff,
      'manage-customer': AdminManagementCustomer,
    },

    mounted(){
      this.sortPeople();
    }
  }
</script>