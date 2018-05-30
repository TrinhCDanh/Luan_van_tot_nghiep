<template id="add-ca">
  <div>
    <h3>Add new ca</h3>
    <v-form v-model="valid" v-on:submit.prevent = "createca" method="POST">
      <v-text-field v-model="ca.tenca" :rules="nameRules" label="Tên ca" required></v-text-field>
      <v-text-field type="number" v-model="ca.tietso" :rules="soluongRules" label="Tiết số (123 - 456 - 789 - 012)" required></v-text-field><!-- :rules="emailRules" -->   
      <v-btn v-bind:to="{name: 'CaList'}">Back</v-btn>
      <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
    </v-form>
  </div>
</template>

<script>
 export default {
   data: function () {
     return {
        ca: {tenca: '', tietso: ''},
        valid: false,
        name: '',
        nameRules: [
          v => !!v || 'Bạn chưa nhập tên phòng máy',
          v => v.length <= 10 || 'Name must be less than 4 characters'
        ],
        soluongRules: [
          v => !!v || 'Bạn chưa nhập số lượng máy',
          v => !Number.isNaN(v) || 'Name must be less than 10 characters'
        ]
     }
   },
   methods: {
     createca: function() {
       let uri = location.origin + '/api/ca';
       Axios.post(uri, this.ca).then((response) => {
          this.$router.push({name: 'CaList'})
       })
     }
   }
 }
</script>