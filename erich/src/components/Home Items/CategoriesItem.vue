<template>
  <div class="grey lighten-4">
    <v-container>
      <v-row>
        <v-col
          offset-lg="1"
          offset-xl="1"
          cols="12"
          sm="12"
          md="12"
          lg="10"
          xl="10"
        >
          <v-row>
            <v-col
              v-for="item in items"
              :key="item.id"
              cols="6"
              sm="4"
              md="3"
              lg="3"
              xl="2"
            >
              <v-card
                width="275px"
                class="ma-2"
              >
                <v-card-text
                  class="pb-0"
                >
                  <p
                    class="ma-0"
                  >{{item.item_sales}}</p>
                </v-card-text>

                <v-img
                  src="../../assets/SamplePhoto.png"
                  contain
                  max-height="200px"
                ></v-img>

                <v-card-title>
                  {{item.item_price}}
                </v-card-title>

                <v-card-subtitle>
                  <span>{{item.item_price}}</span>
                  <br>
                  <span>{{item.item_name}}</span>
                  <br>
                  <span>{{item.item_desc}}</span>
                </v-card-subtitle>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    icon
                  >
                    <v-icon>
                      mdi-cart-outline
                    </v-icon>
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      items: [
        {id: 0, item_name: "Koko Crunch", item_desc: "this is item description", item_price: 156.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 1, item_name: "Pancake Plus", item_desc: "this is item description", item_price: 79.95, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 3, item_name: "Gardeni", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 4, item_name: "Gardena", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 5, item_name: "Gardeia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 6, item_name: "Gardnia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 7, item_name: "Garenia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 8, item_name: "Gadenia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 9, item_name: "Grdenia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 10, item_name: "Gaardenia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 11, item_name: "Gaqrdenia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 12, item_name: "Garwdenia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 13, item_name: "Gardeenia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 14, item_name: "Gardernia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
        {id: 15, item_name: "Gardentia", item_desc: "this is item description", item_price: 67.50, item_sales: "10", item_image: 'SamplePhoto.png'},
      ],
    })
  }
</script>