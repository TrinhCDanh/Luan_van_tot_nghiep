<template id="add-thu">
  <div>
    <h3>Add new thu</h3>
    <v-form v-model="valid" v-on:submit.prevent = "createthu" method="POST">
      <v-text-field v-model="thu.tenthu" :rules="nameRules" label="Tên thứ (Thứ hai, Thứ ba,...)" required></v-text-field>
      <v-btn v-bind:to="{name: 'ThuList'}">Back</v-btn>
      <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
    </v-form>
  </div>
</template>

<script>
 export default {
   data: function () {
     return {
        thu: {tenthu: ''},
        valid: false,
        name: '',
        nameRules: [
          v => !!v || 'Bạn chưa nhập tên thứ',
          v => v.length <= 10 || 'Name must be less than 10 characters'
        ]
     }
   },
   methods: {
     createthu: function() {
       let uri = location.origin + '/api/thu';
       Axios.post(uri, this.thu).then((response) => {
          this.$router.push({name: 'ThuList'})
       })
     }
   }
 }
</script>