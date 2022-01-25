<template>
  <div>
    <v-container
      fluid
    >
      
      <v-row>
        <v-col cols="6">
          <v-text-field
            class=""
            rounded
            color="#1106A0"
            append-icon="mdi-magnify"
            hide-details="auto"
            outlined
            dense
            height="small"
            background-color="white"
            placeholder="Search for entire store here.."
          >
          </v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
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
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="profile in customer"
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
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import {Mixins} from '../../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    props:['customer'],

    data: () => ({
      dialog: false,
      profiles: [],
    }),

    computed: {
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {
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
    },
  }
</script>