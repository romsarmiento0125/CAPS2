<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-btn
            @click="openDialog"
          >Add new</v-btn>
        </v-col>
        <v-col>
          <v-btn

          >Sort</v-btn>
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
                    Supplier Name
                  </th>
                  <th class="text-left">
                    Contact
                  </th>
                  <th class="text-left">
                    Address
                  </th>
                  <th class="text-left">
                    Supplied Product
                  </th>
                  <th class="text-left">
                    Action
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
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    props:['customer'],

    data: () => ({
      dialog: false,
      profiles: [],
    }),

    computed: {

    },

    methods: {
      openDialog(){
        this.dialog = true;
      },
    },
  }
</script>