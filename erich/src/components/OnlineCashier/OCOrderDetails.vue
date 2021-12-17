<template>
  <div>
    <v-dialog
      transition="dialog-top-transition"
      max-width="600"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          v-bind="attrs"
          v-on="on"
        >View Order Details</v-btn>
      </template>
      <template v-slot:default="dialog">
        <v-card>
          <v-toolbar
            color="primary"
            dark
          >Order Details</v-toolbar>
          <div
            class="d-flex"
          >
            <p
              class="title"
            >
              Invoice#{{ivNumber}}
            </p>
            <v-spacer></v-spacer>
            <p
              class="title"
            >
              {{odDate}}
            </p>
          </div>
          <v-card-text>
            <v-list>
              <v-list-item-group
              >
                <v-list-item
                  v-for="(item, i) in items"
                  :key="i"
                >
                  <v-list-item-content
                    class="border ma-2 rounded-lg"
                    v-if="ivNumber == item.IvNumber"
                  >
                    <div>
                      <p>{{item.ItemName}}</p>
                      
                      <div
                        class="d-flex"
                      >
                        <p>{{item.ItemDesc}}</p>
                        <v-spacer></v-spacer>
                        <p>{{priceRound(item.RPrice * item.Quantity)}}</p>
                      </div>
                    </div>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card-text>
          <v-card-actions class="justify-end">
            <v-btn
              text
              @click="dialog.value = false"
            >Close</v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-dialog>
  </div>
</template>

<script>
  export default {
    props: ['ivNumber', 'odDate'],

    data: () => ({
      items: [
        { IvNumber: '001', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        { IvNumber: '001', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
      ],
    }),

    methods: {
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
    }
  }
</script>