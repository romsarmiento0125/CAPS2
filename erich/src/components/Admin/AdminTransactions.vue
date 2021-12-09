<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-sheet>
            <div
              class="d-flex"
            >
              <div>
                <v-menu
                  ref="menu"
                  v-model="menu"
                  :close-on-content-click="false"
                  :return-value.sync="date"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="date"
                      label="Picker in menu"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="date"
                    no-title
                    scrollable
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      text
                      color="primary"
                      @click="menu = false"
                    >
                      Cancel
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="$refs.menu.save(date)"
                    >
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>
              </div>

              <div>
                <v-menu
                  ref="menu"
                  v-model="menu"
                  :close-on-content-click="false"
                  :return-value.sync="date"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="date"
                      label="Picker in menu"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="date"
                    no-title
                    scrollable
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      text
                      color="primary"
                      @click="menu = false"
                    >
                      Cancel
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="$refs.menu.save(date)"
                    >
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>
              </div>
            </div>
          </v-sheet>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <div>
            <v-btn
              @click="transComponents('ol')"
            >
              <p>Online</p>
            </v-btn>
            <v-btn
              @click="transComponents('ph')"
            >
              <p>Physical</p>
            </v-btn>
          </div>
          <div>
            <transaction-online v-if="transOnline"></transaction-online>
            <transaction-physical v-else-if="transOffline"></transaction-physical>
          </div>
        </v-col>
      </v-row>
    </v-container>
    
  </div>
</template>

<script>
  import TransactionOnline from './Transactions/TransactionsOnline.vue'
  import TransactionPhysical from './Transactions/TransactionsPhysical.vue'
  
  export default {
    data: () => ({
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      transOnline: true,
      transOffline: false,
    }),

    components: {
      "transaction-online": TransactionOnline,
      "transaction-physical": TransactionPhysical,
    },

    methods: {
      transComponents(cond) {
        if(cond == 'ol') {
          this.transOnline = true;
          this.transOffline = false;
        }
        else if(cond == "ph") {
          this.transOnline = false;
          this.transOffline = true;
        }
      }
    }
  }
</script>