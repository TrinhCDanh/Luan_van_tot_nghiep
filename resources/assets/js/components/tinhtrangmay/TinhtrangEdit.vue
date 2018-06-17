<template id="edit-tinhtrangmay">
  <!-- <div>
    <h3>Ghi nhận tình trạng máy</h3>
    <v-form v-model="valid" v-on:submit.prevent = "createtinhtrangmay" method="POST">
      <input type="hidden" name="_token" :value="tinhtrangmay._token">

      <v-text-field
            name="input-7-2"
            label="Ghi nhận"
            value="Input Text"
            class="input-group--focused"
            multi-line
            v-model="tinhtrangmay.mota_kythuatvien"
      ></v-text-field>

      <v-text-field
            name="input-7-2"
            label="Ghi nhận"
            value="Input Text"
            class="input-group--focused"
            multi-line
            v-model="tinhtrangmay.mota_giangvien"
      ></v-text-field>

      <v-btn v-bind:to="{name: 'TinhtrangList'}">Back</v-btn>
      <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
    </v-form>
  </div> -->
  <v-layout justify-center>
    <v-flex xs12 sm10 md8 lg6>
      <v-card ref="form">
        <v-card-title>
          <p class="display-1">Ghi nhận tình trạng máy</p>
        </v-card-title>
        <v-form v-model="valid" v-on:submit.prevent = "edittinhtrangmay" method="POST">
          <v-card-text>

            <v-text-field
              name="input-7-2"
              label="Ghi nhận"
              value="Input Text"
              class="input-group--focused"
              multi-line
              v-model="tinhtrangmay.mota_kythuatvien"
            ></v-text-field>

            <v-radio-group v-model="tinhtrangmay.tinhtrang" column label="Tình trạng hiện tại">
              <v-radio
                label="Tốt"
                value="0"
              ></v-radio>
              <v-radio
                label="Đang bảo trì"
                value="1"
              ></v-radio>
            </v-radio-group>

          </v-card-text>
          <v-divider class="mt-5"></v-divider>
          <v-card-actions>
            <v-btn flat>Cancel</v-btn>
            <v-spacer></v-spacer>
            <v-btn type="submit" color="primary" flat >Submit</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
 export default {
   data: function () {
     return {
        urlCurrent: location.origin,
        tinhtrangmay: {mota_kythuatvien: '', tinhtrang: '0'},
        kythuatvien_current_id: '',
        may_slug: '',
        tinhtrangmay_id: '',
        valid: false,
        // name: '',
        // nameRules: [
        //   v => !!v || 'Bạn chưa nhập tên phòng máy',
        //   //  v => v.length <= 10 || 'Name must be less than 4 characters'
        // ],
        // email: '',
        // emailRules: [
        //   v => !!v || 'E-mail is required',
        //   v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        // ],
     }
   },
   created() {
      var _this = this;
      let urlfullCurrent = window.location.href;

      _this.kythuatvien_current_id = sessionStorage.getItem('kythuatvien_id');
      console.log(_this.kythuatvien_current_id);

      _this.may_slug = urlfullCurrent.slice(urlfullCurrent.lastIndexOf('tinhtrangmay/') + 13 , urlfullCurrent.indexOf('/edit'));
      _this.tinhtrangmay_id = urlfullCurrent.slice(urlfullCurrent.lastIndexOf('edit/') + 5 , urlfullCurrent.length);

      Axios.get(_this.urlCurrent+'/api/tinhtrangmay/'+ _this.tinhtrangmay_id + '/edit').then((response) => {
        _this.tinhtrangmay.mota_kythuatvien = response.data.mota_kythuatvien;
      });

      Axios.get(_this.urlCurrent+'/api/may/'+ _this.may_slug).then((response) => {
        _this.tinhtrangmay.tinhtrang = response.data.tinhtrang.toString();
      });


   },
   methods: {
     edittinhtrangmay: function() {
      //this.tinhtrangmay.tinhtrang = parseInt(this.tinhtrangmay.tinhtrang);
      var dataToTinhtrangmay = {
        mota_kythuatvien: this.tinhtrangmay.mota_kythuatvien,
        mota_giangvien: '',
        tinhtrang: parseInt(this.tinhtrangmay.tinhtrang),
        kythuatvien_id: this.kythuatvien_current_id,
        may_slug: this.may_slug
      }
      //console.log(this.tinhtrangmay);
       let uri = location.origin + '/api/tinhtrangmay/' + this.tinhtrangmay_id;
       Axios.patch(uri, dataToTinhtrangmay).then((response) => {
          // this.$router.push({name: 'TinhtrangmayList'})
          this.$router.push({ path: `/kythuatvien/tinhtrangmay/${this.may_slug}` });
       })
     }
   }
 }
</script>

<!-- SELECT kythuatvien.name as tenkythuatvien, giangvien.username as tengiangvien, tinhtrangmay.ngayghinhan, tinhtrangmay.mota_kythuatvien, tinhtrangmay.mota_giangvien, tinhtrangmay.id
FROM ((((may JOIN tinhtrangmay on may.id = tinhtrangmay.may_id)
LEFT JOIN chitiet_ghinhan on tinhtrangmay.id = chitiet_ghinhan.tinhtrangmay_id)
LEFT JOIN chitiet_baotri on tinhtrangmay.id = chitiet_baotri.tinhtrangmay_id)
LEFT JOIN kythuatvien on chitiet_baotri.kythuatvien_id = kythuatvien.id)
LEFT JOIN giangvien on chitiet_ghinhan.giangvien_id = giangvien.id
WHERE may.id = 32 -->