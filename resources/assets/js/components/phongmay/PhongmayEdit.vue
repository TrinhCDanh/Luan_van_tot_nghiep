<template id="add-phongmay">
  <div>
    <v-layout justify-center>
      <v-flex xs12 sm10 md8 lg6>
        <v-card ref="form">
          <v-card-title>
            <p class="display-1">Cập nhật thông tin phòng máy</p>
          </v-card-title>
          <v-form v-model="valid" v-on:submit.prevent="editphongmay" method="POST">
            <v-card-text>

              <v-alert :value="error" type="error" v-if="error != ''">
                {{ error }}
              </v-alert>
              <br>
              <v-text-field v-model="phongmay.tenphongmay" :rules="nameRules" label="Tên phòng máy" required></v-text-field>
              <v-btn @click="showMayList(phongmay.id)" style="margin-left: 0; color: white" color="blue" light>Số lượng máy có trong phòng: {{phongmay.soluongmay}}</v-btn>
            </v-card-text>
            <v-divider class="mt-5"></v-divider>
            <v-card-actions>
              <v-btn v-bind:to="{name: 'PhongmayList'}">Back</v-btn>
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
        phongmay: {tenphongmay: '', soluongmay: ''},
        valid: false,
        name: '',
        error: '',
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
       var _this = this;
       let uri = location.origin + '/api/phongmay/' + _this.phongmay.id; 
       // console.log(_this.phongmay);
       Axios.patch(uri, _this.phongmay).then((response) => {
          if(response.data.error) {
            _this.error = response.data.error;
          }
          else {
            _this.error = "";
            _this.$router.push({name: 'PhongmayList'})
          }   
       })
     },
     showMayList(phongmay_id) {
        this.$router.push({ path: `/admin/phongmay/may/${phongmay_id}` });
     }
   },
     created: function () {
         let urlCurrent = window.location.href;
         let phongmay_id = urlCurrent.slice(urlCurrent.lastIndexOf('edit/') + 5, urlCurrent.length);
         let uri = location.origin + '/api/phongmay/' + phongmay_id + '/edit';
         Axios.get(uri).then((response) => {
             this.phongmay = response.data;
         });
     }
 }
</script>