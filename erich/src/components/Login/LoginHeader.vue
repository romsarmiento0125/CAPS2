<template>
  <div>
    <h1>Header</h1>
  </div>
</template>

<script>
export default {
  
  data: () => ({

  }),

  methods: {
    getcreds() {
      axios.get('http://127.0.0.1:8000/api/customers')
      .then(res => console.log(res))
      .catch(err => console.error(err));
    }
  },

  beforeMount(){
    this.getcreds();
  },
}
</script>