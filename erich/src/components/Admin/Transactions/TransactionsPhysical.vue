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
            <div>
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
            </div>
            <div>
              <v-btn>
                <p>Generate Report</p>
              </v-btn>
            </div>
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">
                    Id
                  </th>
                  <th class="text-left">
                    Receipt No.
                  </th>
                  <th class="text-left">
                    Total Item
                  </th>
                  <th class="text-left">
                    Total Amount
                  </th>
                  <th class="text-left">
                    Date
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="record in records"
                  :key="record.id"
                >
                  <td>{{ record.id }}</td>
                  <td>{{ record.receipt }}</td>
                  <td>{{ record.totitem }}</td>
                  <td>{{ record.totamount }}</td>
                  <td>{{ record.date }}</td>
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
        records: [
          {id: 1, receipt: '10001', totitem: '5', totamount: '500', date: '2018-08-15'},
          {id: 2, receipt: '20003', totitem: '6', totamount: '500', date: '2018-08-15'},
          {id: 3, receipt: '30004', totitem: '4', totamount: '500', date: '2018-08-15'},
          {id: 4, receipt: '40006', totitem: '7', totamount: '500', date: '2018-08-15'},
          {id: 5, receipt: '50008', totitem: '9', totamount: '500', date: '2018-08-15'},
        ],
      }
    },
  }
</script>