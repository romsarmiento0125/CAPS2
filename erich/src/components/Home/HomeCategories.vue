<template>
  <div
    class="ma-5"
  >
    <v-container>
      <v-row>
        <v-col
          v-for="product in products"
          :key="product.pname"
          cols="3"
        >
          <v-card
            height="100%"
            class="rounded-lg"
          >
            <v-img
              height="100%"
              width="100%"
              src="https://picsum.photos/1920/1080?random"
              gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
              class="white--text align-end"
            >
              <v-card-title>
                <h3>
                  {{product.ptitle}}
                </h3>
              </v-card-title>

            </v-img>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      products: [
        { pname: "Bakery.jpg", ptitle: "Bread" },
        { pname: "Beverage.jpg", ptitle: "Beverage" },
        { pname: "Dairy.jpg", ptitle: "Dairy" },
        { pname: "meats.jpg", ptitle: "Meat" },
      ],
    })
  }
</script>