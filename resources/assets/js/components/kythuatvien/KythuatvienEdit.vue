<template id="edit-kythuatvien">
  <div>
    <v-layout justify-center>
      <v-flex xs12 sm10 md8 lg6>
        <v-card ref="form">
          <v-card-title>
            <p class="display-1">Cập nhật thông tin kỹ thuật viên</p>
          </v-card-title>
          <v-form v-model="valid" v-on:submit.prevent = "editkythuatvien" method="POST">
            <v-card-text>

              <input type="hidden" name="_token" :value="kythuatvien._token">
              <v-text-field v-model="kythuatvien.makythuatvien" label="Mã số kỹ thuật viên" required></v-text-field>
              <v-text-field v-model="kythuatvien.name" :rules="nameRules" label="Tên kỹ thuật viên" required></v-text-field>
              <v-text-field v-model="kythuatvien.email" :rules="emailRules" label="Email" required></v-text-field><!-- :rules="emailRules" -->
              <v-text-field type="password" v-model="kythuatvien.password" label="Mật khẩu" required></v-text-field>

            </v-card-text>
            <v-divider class="mt-5"></v-divider>
            <v-card-actions>
              <v-btn v-bind:to="{name: 'KythuatvienList'}">Back</v-btn>
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
        kythuatvien: {makythuatvien: '', name: '', email: '', password: '', _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
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
     editkythuatvien: function() {
       let uri = location.origin + '/api/kythuatvien/' + this.kythuatvien.id;
         let email = this.kythuatvien.email;
         let makythuatvien = this.kythuatvien.makythuatvien;
         let name = this.kythuatvien.name;
         let password = this.kythuatvien.password;
         if(email != '' && makythuatvien != '' && name != '' && password != ''){
             Axios.patch(uri, this.kythuatvien).then((response) => {
                 this.$router.push({name: 'KythuatvienList'})
             })
         }else{
             this.error = 'Vui lòng kiểm tra lại thông tin'
         }
     }
   },
   created: function() {
      let urlCurrent = window.location.href;
      let kythuatvien_id = urlCurrent.slice(urlCurrent.lastIndexOf('edit/') + 5 , urlCurrent.length);
      let uri = location.origin+'/api/kythuatvien/'+ kythuatvien_id + '/edit';
      Axios.get(uri).then((response) => {
        this.kythuatvien = response.data;
       console.log(response.data);
      });

   },
     mounted(){
         console.log(this.kythuatvien);
     }
 }
</script>