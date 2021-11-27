<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col
          offset="1"
          cols="7"
          class="d-flex justify-center"
        >
          <v-sheet
            color="#FFFFFF"
            width="100%"
            class="my-10"
          >
            <v-row>
              <v-col>
                <p>product</p>
              </v-col>
              <v-col>
                <div
                  class="d-flex"
                >
                  <p>quantity</p>
                  <p>total price</p>
                  <p>action</p>
                </div>
              </v-col>
            </v-row>

            <v-divider></v-divider>

            <v-row>
              <v-col>
                <v-list>
                  <v-list-item-group
                  >
                    <v-list-item
                      v-for="item in items"
                      :key="item.id"
                    >
                      <v-list-item-content
                        class="border ma-2 rounded-lg"
                      >
                        <v-row
                        >
                          <v-col
                            cols=""
                          >
                            <div
                              class="d-flex align-center"
                            >
                              <v-checkbox

                              ></v-checkbox>
                              <v-img
                                height="120px"
                                width="120px"
                                contain
                                :src="require('../../assets/'+item.item_image)"
                              ></v-img>
                              <v-list-item-title>
                                <span>{{item.item_name}}</span>
                                <br>
                                <span>{{item.item_desc}}</span>
                              </v-list-item-title>
                            </div>
                          </v-col>
                          <v-col
                            cols="6"
                            class="d-flex align-center"
                          >
                            <div
                              class="d-flex align-center"
                            >
                              <div
                                class="qtt d-flex align-center justify-center"
                              >
                                <v-btn
                                  depressed
                                  color="transparent"
                                  class=""
                                >
                                  <v-icon
                                    x-large
                                  >
                                    mdi-minus-box-outline
                                  </v-icon>
                                </v-btn>
                                <p
                                  class=" my-0 px-2"
                                >
                                  1
                                </p>
                                <v-btn
                                  depressed
                                  color="transparent"
                                >
                                  <v-icon
                                    x-large
                                  >
                                    mdi-plus-box-outline
                                  </v-icon>
                                </v-btn>
                              </div>

                              <div
                                class="tp my-0 d-flex align-center justify-center"
                              >
                                <v-icon>
                                  mdi-currency-php
                                </v-icon>
                                <p>
                                  {{item.item_price}}
                                </p>
                              </div>

                              <v-btn
                                class="act justify-center"
                                color="primary"
                                plain
                                disabled
                              >
                                Delete
                              </v-btn>
                            </div>
                          </v-col>
                        </v-row>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list-item-group>
                </v-list>
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
        <v-col
          cols="4"
          class="d-flex justify-center"
        >
          <v-sheet
            color="#FFFFFF"
            height="200"
            width="80%"
            class="my-10"
          >
            <v-row>
              <v-col>total</v-col>
              <v-col>999</v-col>
            </v-row>

            <v-divider></v-divider>

            <v-row>
              <v-col>
                <p>taxes and shipping are calasdjhasga</p>
                <v-btn
                  color="primary"
                  :to="{name: 'Cart' , params: { id: 'place-order', title: 'Place Order'}}"
                  @click="showPlaceOrder()"
                >
                  Place Order
                </v-btn>
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      items: [
        {id: 0, item_name: "Koko Crunch", item_desc: "this is item description", item_price: 156.50, item_image: 'SamplePhoto.png'},
        {id: 1, item_name: "Pancake Plus", item_desc: "this is item description", item_price: 79.95, item_image: 'SamplePhoto.png'},
        {id: 2, item_name: "Gardenia", item_desc: "this is item description", item_price: 67.50, item_image: 'SamplePhoto.png'},
      ],
    }),
    
    methods: {
      showPlaceOrder() {
        this.$emit('scItemsEmit');
      }
    }
  }
</script>