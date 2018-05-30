<template id="add-phongmay">
  <div>
    <h3>Add new phongmay</h3>
    <v-form v-model="valid" v-on:submit.prevent = "createphongmay" method="POST">
      <v-text-field v-model="phongmay.tenphongmay" :rules="nameRules" label="Tên phòng máy" required></v-text-field>
      <v-text-field type="number" v-model="phongmay.soluongmay" :rules="soluongRules" label="Số lượng máy trong phòng" required></v-text-field><!-- :rules="emailRules" -->   
      <v-btn v-bind:to="{name: 'PhongmayList'}">Back</v-btn>
      <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
    </v-form>
  </div>
</template>

<script>
 export default {
   data: function () {
     return {
        phongmay: {tenphongmay: '', soluongmay: ''},
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
     createphongmay: function() {
       let uri = location.origin + '/api/phongmay';
       Axios.post(uri, this.phongmay).then((response) => {
          this.$router.push({name: 'PhongmayList'})
       })
     }
   }
 }
</script>