<template>
  <div>
    <v-container
      fluid
    >
      <v-sheet
        color="White"
        width="100%"
        height="100%"
        class="mb-5"
      >
        <v-row>
          <v-col>
            <p>All</p>
          </v-col>
          <v-col>
            <p>To Pack</p>
          </v-col>
          <v-col>
            <p>To Receive</p>
          </v-col>
          <v-col>
            <p>To Pickup</p>
          </v-col>
          <v-col>
            <p>Complete</p>
          </v-col>
          <v-col>
            <p>Cancelled</p>
          </v-col>
        </v-row>
      </v-sheet>
      <v-sheet>
        <v-row>
          <v-col>
            <div class="mt-5"></div>
            <v-divider></v-divider>
            <div>
              <p>Items</p>
            </div>
            <v-divider></v-divider>
            <div class="mb-5"></div>
          </v-col>
        </v-row>
      </v-sheet>
    </v-container>
  </div>
</template>