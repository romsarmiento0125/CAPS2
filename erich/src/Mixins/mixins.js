export const Mixins = {
  methods: {
    getDomain() {
      //return "http://erichgrocery.store/public/";
      return "http://127.0.0.1:8000/";
    },
    loginAgain(data){
      axios.post(this.getDomain()+'api/customerlogin/store',{
        clientCred: data
      })
      .then(res => this.loginSuccess(res.data))
      .catch(err => console.error(err));
    },
    loginSuccess(cinfo) {
      if(cinfo == "InvalidCredentials"){
      }
      else{
        axios.post(this.getDomain()+'api/loginaddress/store',{
          clientCred: this.usersData
        })
        .then(res => this.saveInfos(res.data, cinfo))
        .catch(err => console.error(err));
      }
    },
    saveInfos(data, cinfo) {
      //console.log(data);
      this.$store.commit('storeCustomerAddress', data);
      this.$store.commit('storeCustomerInfo', cinfo);
    }
  },
}