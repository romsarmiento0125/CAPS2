<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col class="">
          <v-btn
            outlined
            class="px-10 bgWhite"
            color="#787878"
            @click="openDialog"
          >
            <h4 class="fontTitle black--grey ">
              Add new
            </h4>
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col class="mt-n3">
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">
                    #
                  </th>
                  <th class="text-left">
                    Name
                  </th>
                  <th class="text-left">
                    Email
                  </th>
                  <th class="text-left">
                    Mobile No.
                  </th>
                  <th class="text-left">
                    Role
                  </th>
                  <th class="text-left">
                    Account Status
                  </th>
                  <th class="text-left">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="profile in staff"
                  :key="profile.id"
                >
                  <td>{{ profile.id }}</td>
                  <td>{{ profile.first_Name }} &nbsp; {{ profile.last_Name }}</td>
                  <td>{{ profile.email }}</td>
                  <td>{{ profile.mobile_Number }}</td>
                  <td>{{ profile.tag }}</td>
                  <td>
                    <div
                      class="d-flex align-center"
                    >
                      <p
                        class="my-0 mr-2"
                      >
                        {{profile.status}}
                      </p>
                      <v-switch
                        :input-value="profile.status == 'Active'"
                        @click="changeStatus(profile.status, profile.id)"
                      ></v-switch>
                    </div>
                    
                  </td>
                  <td>
                    <div
                      class="d-flex flex-column"
                    >
                      <v-btn
                        small
                        dark
                        color="#FFA600"
                        class="mt-2 my-1"
                        @click="openDialogUpdate(profile)"
                      >Update
                      </v-btn>
                    </div>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
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
            <h4 class="my-2 ml-2 fontTitle">User Profile</h4>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col
                  cols="12"
                  md="6"
                >
                  <v-text-field
                    v-model="personalInfo.First_Name"
                    label="First name"
                    required
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-text-field
                    v-model="personalInfo.Last_Name"
                    label="Last name"
                    persistent-hint
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="personalInfo.Email"
                    label="Email"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="personalInfo.Mobile_Number"
                    label="Mobile number"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="personalInfo.Birthday"
                    label="Birthday"
                    placeholder="2020-01-30"
                    required
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-select
                    :items="['Male', 'Female']"
                    v-model="personalInfo.Gender"
                    label="Gender"
                    required
                  ></v-select>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-select
                    :items="['Admin', 'Ocashier', 'Pcashier', 'Encoder']"
                    v-model="personalInfo.Tag"
                    label="Role"
                    required
                  ></v-select>
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
              
              @click="dialog = false"
            >
              Close
            </v-btn>
            <v-btn
              color="#1106A0"
              dark
              class="px-10"
              @click="addStaff"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <div>
      <v-dialog
        v-model="updateDialog"
        persistent
        max-width="600px"
      >
        <v-card>
          <v-card-title>
            <h4 class="my-2 ml-2 fontTitle">Update Profile</h4>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col
                  cols="12"
                  md="6"
                >
                  <v-text-field
                    v-model="updateInfo.First_Name"
                    label="First name"
                    required
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-text-field
                    v-model="updateInfo.Last_Name"
                    label="Last name"
                    persistent-hint
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="updateInfo.Mobile_Number"
                    label="Mobile number"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="updateInfo.Birthday"
                    label="Birthday"
                    placeholder="2020-01-30"
                    required
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-select
                    :items="['Male', 'Female', 'Other']"
                    v-model="updateInfo.Gender"
                    label="Gender"
                    required
                  ></v-select>
                </v-col>
                <v-col
                  cols="12"
                  sm="6"
                  md="6"
                >
                  <v-select
                    :items="['Admin', 'Ocashier', 'Pcashier', 'Encoder']"
                    v-model="updateInfo.Tag"
                    label="Role"
                    required
                  ></v-select>
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
              @click="saveUpdateDialog(updateInfo)"
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
  import {Mixins} from '../../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    props:['staff'],

    data: () => ({
      dialog: false,
      profiles: [
        
      ],
      personalInfo: {
        First_Name: "",
        Last_Name: "",
        Mobile_Number: "",
        Email: "",
        Gender: "Other",
        Municipality: "Sta.Maria",
        Barangay: "Pulong Buhangin",
        UnderBarangay: "Gulod",
        HomeAddress: "Block 0 Lot 0",
        Birthday: "",
        Tag: "",
        id: "",
        ShipFee: "Free",
        Default: "True",
      },
      updateInfo: {
        First_Name: "gg",
        Last_Name: "",
        Mobile_Number: "",
        Email: "",
        Gender: "",
        Birthday: "",
        Tag: "",
        id: "",
      },
      updateDialog: false,
    }),

    computed: {
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {
      openDialogUpdate(items){
        this.updateInfo.First_Name = items.first_Name;
        this.updateInfo.Last_Name = items.last_Name;
        this.updateInfo.Mobile_Number = items.mobile_Number;
        this.updateInfo.Email = items.email;
        this.updateInfo.Gender = items.gender;
        this.updateInfo.Birthday = items.birthday;
        this.updateInfo.Tag = items.tag;
        this.updateInfo.id = items.id;
        this.updateDialog = true;
      },
      saveUpdateDialog(data){
        // console.log(data);
        if((data.First_Name == "") || (data.Last_Name == "") || (data.Email == "") || (data.Mobile_Number == "") || (data.Birthday == "")){
          alert("Incomplete Input Fields");
        }
        else{
          // console.log("save");
          axios.put(this.getDomain()+'api/editprofiles/'+data.id, {
            register: data
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('allPeople', res.data.staff);
          })
          .catch(err => console.error(err));
          this.updateDialog = false;
        }
      },
      changeStatus(status, id){
        console.log(status);
        axios.put(this.getDomain()+'api/editstaff/'+id, {
          register: status
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          console.log(res.data);
          this.$store.commit('allPeople', res.data.staff);
        })
        .catch(err => console.error(err));
      },
      openDialog(){
        this.dialog = true;
      },
      addStaff(){
        // console.log(this.personalInfo);
        if((this.personalInfo.First_Name == "") || (this.personalInfo.Last_Name == "") || (this.personalInfo.Mobile_Number == "") ||
          (this.personalInfo.Birthday == "") || (this.personalInfo.Tag == "")){
          alert("Please complete the input fields");
        }
        else{
          this.dialog = false;
          axios.post(this.getDomain()+'api/addstaff/store', {
            register: this.personalInfo
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            console.log(res.data);
          })
          .catch(err => console.error(err));
        }
      }
    },
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