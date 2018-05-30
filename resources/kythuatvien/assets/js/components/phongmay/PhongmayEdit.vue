<template id="add-phongmay">
  <div>
    <h3>Cập nhật thông tin phòng máy</h3>
    <v-form v-model="valid" v-on:submit.prevent = "createphongmay" method="POST">
      <v-text-field v-model="phongmay.tenphongmay" :rules="nameRules" label="Tên phòng máy" required></v-text-field>
      <v-btn @click="showMayList(phongmay.id)">Số lượng máy có trong phòng: {{phongmay.soluongmay}}</v-btn>
      <!--<v-text-field type="number" v-model="phongmay.soluongmay" :rules="soluongRules" label="Số lượng máy trong phòng" required></v-text-field> --><!-- :rules="emailRules" -->   
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
     editphongmay: function() {
       let uri = location.origin + '/api/phongmay/' + this.phongmay.id; 
       console.log(uri);
       Axios.patch(uri, this.phongmay).then((response) => {
          this.$router.push({name: 'PhongmayList'})
       })
     },
     showMayList(phongmay_id) {
        this.$router.push({ path: `/admin/phongmay/may/${phongmay_id}` });
     }
   },
   created: function() {
      let urlCurrent = window.location.href;
      let phongmay_id = urlCurrent.slice(urlCurrent.lastIndexOf('edit/') + 5 , urlCurrent.length);
      let uri = location.origin+'/api/phongmay/'+ phongmay_id + '/edit';
      Axios.get(uri).then((response) => {
        this.phongmay = response.data;
      });
    }
 }
</script>