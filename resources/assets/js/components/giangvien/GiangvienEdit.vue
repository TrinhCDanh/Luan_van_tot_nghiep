<template id="edit-giangvien">
  <div>
    <v-layout justify-center>
      <v-flex xs12 sm10 md8 lg6>
        <v-card ref="form">
          <v-card-title>
            <p class="display-1">Cập nhật thông tin giảng viên</p>
          </v-card-title>
          <v-form v-model="valid" v-on:submit.prevent = "editgiangvien" method="POST">
            <v-card-text>

              <input type="hidden" name="_token" :value="giangvien._token">
              <v-text-field v-model="giangvien.magiangvien" label="Mã số giảng viên" required></v-text-field>
              <v-text-field v-model="giangvien.username" :rules="nameRules" label="Tên giảng viên" required></v-text-field>
              <v-text-field v-model="giangvien.email" :rules="emailRules" label="Email" required></v-text-field><!-- :rules="emailRules" -->
              <v-text-field type="password" v-model="giangvien.password" label="Mật khẩu" required></v-text-field>

            </v-card-text>
            <v-divider class="mt-5"></v-divider>
            <v-card-actions>
              <v-btn v-bind:to="{name: 'GiangvienList'}">Back</v-btn>
              <v-spacer></v-spacer>
              <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
 export default {
   data: function () {
     return {
        giangvien: {magiangvien: '', username: '', email: '', password: '', _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
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
     editgiangvien: function() {
       let uri = location.origin + '/api/giangvien/' + this.giangvien.id;
       Axios.patch(uri, this.giangvien).then((response) => {
          this.$router.push({name: 'GiangvienList'})
       })
     }
   },
   created: function() {
      let urlCurrent = window.location.href;
      let giangvien_id = urlCurrent.slice(urlCurrent.lastIndexOf('edit/') + 5 , urlCurrent.length);
      let uri = location.origin+'/api/giangvien/'+ giangvien_id + '/edit';
      Axios.get(uri).then((response) => {
        this.giangvien = response.data;
      });
    }
 }
</script>