<template>
  <div>
    <h1>Scan barcode</h1>
    <v-text-field
      label="Outlined"
      placeholder="Placeholder"
      outlined
      v-model="barcodeInv"
    ></v-text-field>
    <v-btn
      depressed
      color="primary"
      @click="saveItem"
    >
      Save barcode
    </v-btn>
    <h1>{{barcodeBuy}}</h1>
  </div>
</template>

<script>
  export default {
    name: 'StoreOrders',

    data: () => ({
      barcodeInv: '',
      barcodeBuy: '',
      barcode: '',
      interval: 0,
    }),

    methods: {
      saveItem() {
        alert(this.barcodeInv);
        
      },
      showItem() {
        alert("item show");
      },
      handleBarcode(scanned_barcode) {
          this.barcodeBuy = scanned_barcode;
          this.barcodeInv = scanned_barcode;
      },
      myfunc(evt){
        // // var barcode = '';
        // // var interval;
        // console.log("goods");
        // console.log('this is ' + this.barcode);
        // if (this.interval){
        //   clearInterval(this.interval);
        // }
        // if (evt.code == 'Enter') {
        //     console.log('evt.code');
        //     console.log('enter this is ' + this.barcode);
        //     if (this.barcode){
        //       console.log('if barcode' + this.barcode);
        //       this.handleBarcode(this.barcode);
        //     }
        //     this.barcode = '';
        //     return;
        // }
        // if (evt.key != 'Shift'){
        //   this.barcode += evt.key;
        //   console.log('shift this is ' + this.barcode);
        // }
        // this.interval = setInterval(() => this.barcode = '', 20);
        if (this.interval){
          clearInterval(this.interval);
        }
        if (evt.code == 'Enter') {
            if (this.barcode){
              this.handleBarcode(this.barcode);
            }
            this.barcode = '';
            return;
        }
        if (evt.key != 'Shift'){
          this.barcode += evt.key;
        }
        this.interval = setInterval(() => this.barcode = '', 20);
      },
    },

    mounted() {
      
      console.log("mounted");
      
      // document.addEventListener('keydown', function(evt) {
      //     if (interval)
      //         clearInterval(interval);
      //     if (evt.keyCode == 'Enter') {
      //         if (barcode)
      //             handleBarcode(barcode);
      //         barcode = '';
      //         return;
      //     }
      //     if (evt.key != 'Shift')
      //         barcode += evt.key;
      //     interval = setInterval(() => barcode = '', 20);
      // });
      window.addEventListener('keydown', this.myfunc);
    },
  }
</script>