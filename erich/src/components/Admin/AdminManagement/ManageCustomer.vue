<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-btn>Sort</v-btn>
        </v-col>
        <v-col>
          <v-text-field
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
                  <th class="text-left">
                    Last Login
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
                  v-for="profile in profiles"
                  :key="profile.id"
                >
                  <td>{{ profile.id }}</td>
                  <td>{{ profile.name }}</td>
                  <td>{{ profile.email }}</td>
                  <td>{{ profile.mobile }}</td>
                  <td>{{ profile.lastlogin }}</td>
                  <td>{{ profile.status }}</td>
                  <td>
                    <div
                      class="d-flex flex-column"
                    >
                      <v-btn
                        small
                      >Update
                      </v-btn>
                      <v-btn
                        small
                      >Delete
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
  </div>
</template>

<script>
  export default {
    data () {
      return {
        profiles: [
          {id: 1, name: 'Rom S. Sarmiento', email: 'rom@gmail.com', mobile: '09878564352', lastlogin: '2018-08-15', status: 'Active'},
          {id: 2, name: 'Rom S. Sarmiento', email: 'rom@gmail.com', mobile: '09878564352', role: 'admin', lastlogin: '2018-08-15', status: 'Active'},
          {id: 3, name: 'Rom S. Sarmiento', email: 'rom@gmail.com', mobile: '09878564352', role: 'admin', lastlogin: '2018-08-15', status: 'Active'},
          {id: 4, name: 'Rom S. Sarmiento', email: 'rom@gmail.com', mobile: '09878564352', role: 'admin', lastlogin: '2018-08-15', status: 'Active'},
          {id: 5, name: 'Rom S. Sarmiento', email: 'rom@gmail.com', mobile: '09878564352', role: 'admin', lastlogin: '2018-08-15', status: 'Active'},
        ],
      }
    },
  }
</script>