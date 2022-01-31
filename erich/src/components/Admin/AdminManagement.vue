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
              class="px-10"
              dark
              color="#1106A0"
              @click="gtStaffCustomer('st')"
            >Staff</v-btn>
            <v-btn
              class="ml-3"
              dark
              color="#FFA600"
              @click="gtStaffCustomer('cs')"
            >Customer</v-btn>
            <v-btn
              class="ml-3"
              dark
              color="#E53935"
              @click="gtStaffCustomer('uv')"
            >Unverified</v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <manage-staff v-if="manageStaff" :staff="staffPerson"></manage-staff>
    <manage-customer v-else-if="manageCustomer" :customer="customerPerson"></manage-customer>
    <manage-unverified v-else-if="manageUnverified" :unverified="unverifiedPerson"></manage-unverified>
  </div>
</template>

<script>
  import AdminManagementStaff from './AdminManagement/ManageStaff.vue'
  import AdminManagementCustomer from './AdminManagement/ManageCustomer.vue'
  import AdminManagementUnverified from './AdminManagement/MangeUnverified.vue'

  export default {
    components: {
      'manage-staff': AdminManagementStaff,
      'manage-customer': AdminManagementCustomer,
      'manage-unverified': AdminManagementUnverified,
    },

    data: () => ({
      manageStaff: true,
      manageCustomer: false,
      manageUnverified: false,
      staffPerson: [],
      customerPerson: [],
      unverifiedPerson: [],
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
          this.manageUnverified = false;
        }
        else if(cond == "cs") {
          this.manageStaff = false;
          this.manageCustomer = true;
          this.manageUnverified = false;
        }
        else if(cond == "uv") {
          this.manageStaff = false;
          this.manageCustomer = false;
          this.manageUnverified = true;
        }
      },
      sortPeople(){
        if(this.allPeople == null){
          this.staffPerson = [];
          this.customerPerson = [];
          this.unverifiedPerson = [];
        }
        else{
          this.staffPerson = [];
          this.customerPerson = [];
          this.unverifiedPerson = [];
          // console.log(this.allPeople);
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
            else if(data.tag == "Unverified"){
              this.unverifiedPerson.push({
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

    

    mounted(){
      this.sortPeople();
    }
  }
</script>