<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div
            class="d-flex justify-end"
          >
            <h2>Total Earned and Profile</h2>
          </div>
        </v-col>
      </v-row>

      <!-- Date rows -->
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
        <!-- Total sales column -->
        <v-col>
          <v-sheet>
            <div
              class="d-flex justify-end"
            >
              <h1>9999999</h1>
            </div>
            <div
              class="d-flex justify-end light-green lighten-1"
            >
              <p
                class="white--text headline"
              >Offline Sales</p>
            </div>
          </v-sheet>
        </v-col>
        <!-- Pie graph column -->
        <v-col>
          <h1>Pie Graph</h1>
        </v-col>
      </v-row>

      <v-row>
        <!-- Graph column -->
        <v-col>
          <v-card
            class="mx-auto text-center"
            color="green"
            dark
            max-width="600"
          >
            <v-card-text>
              <div class="text-h4 font-weight-thin">
                Total Sales
              </div>
            </v-card-text>

            <v-card-text>
              <v-sheet color="rgba(0, 0, 0, .12)">
                <v-sparkline
                  :value="value"
                  color="rgba(255, 255, 255, .7)"
                  height="100"
                  padding="24"
                  stroke-linecap="round"
                  smooth
                >
                  <template v-slot:label="item">
                    ${{ item.value }}
                  </template>
                </v-sparkline>
              </v-sheet>
            </v-card-text>
          </v-card>
        </v-col>
        
        <!-- High in demand column -->
        <v-col>
          <v-card
            class="mx-auto"
            max-width="300"
            tile
          >
            <v-list dense>
              <v-subheader>High in Demand</v-subheader>
              <v-list-item-group
                color="primary"
              >
                <v-list-item
                  v-for="(item, i) in hDemand"
                  :key="i"
                >
                  <v-list-item-icon>
                    <v-icon v-text="i + 1"></v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title v-text="item.text"></v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card>
        </v-col>

        <!-- Low in demand column -->
        <v-col>
          <v-card
            class="mx-auto"
            max-width="300"
            tile
          >
            <v-list dense>
              <v-subheader>Low in Demand</v-subheader>
              <v-list-item-group
                color="primary"
              >
                <v-list-item
                  v-for="(item, i) in lDemand"
                  :key="i"
                >
                  <v-list-item-icon>
                    <v-icon v-text="i + 1"></v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title v-text="item.text"></v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      value: [
        423,
        446,
        675,
        510,
        590,
        610,
        760,
      ],
      hDemand: [
        { text: 'Real-Time', icon: 'mdi-clock' },
        { text: 'Audience', icon: 'mdi-account' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
      ],
      lDemand: [
        { text: 'Real-Time', icon: 'mdi-clock' },
        { text: 'Audience', icon: 'mdi-account' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
        { text: 'Conversions', icon: 'mdi-flag' },
      ],
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
    }),
  }
</script>