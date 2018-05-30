<template id="add-kythuatvien">
  <div>
    <h3>Thêm thông tin kỹ thuật viên mới</h3>
    <v-form v-model="valid" v-on:submit.prevent = "createkythuatvien" method="POST">
      <input type="hidden" name="_token" :value="kythuatvien._token">
      <v-text-field v-model="kythuatvien.id" label="Mã số kỹ thuật viên" required></v-text-field>
      <v-text-field v-model="kythuatvien.name" :rules="nameRules" label="Tên kỹ thuật viên" required></v-text-field>
      <v-text-field v-model="kythuatvien.email" :rules="emailRules" label="Email" required></v-text-field><!-- :rules="emailRules" -->   
      <v-text-field type="password" v-model="kythuatvien.password" label="Mật khẩu" required></v-text-field>
      <v-btn v-bind:to="{name: 'KythuatvienList'}">Back</v-btn>
      <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
    </v-form>
  </div>
</template>

<script>
 export default {
   data: function () {
     return {
        kythuatvien: {id: '', name: '', email: '', password: '', _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        valid: false,
        name: '',
        nameRules: [
          v => !!v || 'Bạn chưa nhập tên phòng máy',
          //  v => v.length <= 10 || 'Name must be less than 4 characters'
        ],
        email: '',
        emailRules: [
          v => !!v || 'E-mail is required',
          v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ],
     }
   },
   methods: {
     createkythuatvien: function() {
       let uri = location.origin + '/api/kythuatvien';
       Axios.post(uri, this.kythuatvien).then((response) => {
          this.$router.push({name: 'KythuatvienList'})
       })
     }
   }
 }
</script>