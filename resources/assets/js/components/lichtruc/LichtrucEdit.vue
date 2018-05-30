<template id="edit-lichtruc">
  <div>
    <h3>Thêm lịch trực cho kỹ thuật viên</h3>
    <v-form v-model="valid" v-on:submit.prevent = "createlichtruc" method="POST">
      <v-layout row wrap>
        <v-flex xs12 sm4 md4>
          <v-text-field v-model="lichtruc.tenhocky + ' - ' + lichtruc.namhoc" label="Học kỳ" disabled></v-text-field>
        </v-flex>
        <v-spacer></v-spacer>
        <v-flex xs12 sm4 md4>
          <v-text-field v-model="lichtruc.tenthu" label="Thứ" disabled></v-text-field>
        </v-flex><!-- :rules="emailRules" -->
        <v-spacer></v-spacer>
        <v-flex xs12 sm4 md4>
          <v-text-field v-model="lichtruc.tenca" label="Ca" disabled></v-text-field>
        </v-flex>
      </v-layout>

      <v-select
            :items="kythuatvienList"
            v-model="selectedKythuatvien"
            label="Kỹ thuật viên"
            single-line
            item-text="name"
            item-value="id"
            return-object
            persistent-hint
      ></v-select>

      <v-text-field v-model="lichtruc.ghichu" label="Ghi chú" ></v-text-field>
      <v-btn v-bind:to="{name: 'LichtrucList'}">Back</v-btn>
      <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
    </v-form>
  </div>
</template>

<script>
 export default {
   data: function () {
     return {
        urlCurrent: location.origin,
        lichtruc: {
          hocky_id: '',
          thu_id: '',
          ca_id: '',
          kythuatvien_id: '',
          ghichu: ''
        },
        selectedKythuatvien: {},
        kythuatvienList: [],
        valid: false,
     }
   },
   created() {
      var _this = this;
      let urlfullCurrent = window.location.href;
      let lichtruc_id = urlfullCurrent.slice(urlfullCurrent.lastIndexOf('edit/') + 5 , urlfullCurrent.length);

      Axios.get(_this.urlCurrent+'/api/lichtruc/'+ lichtruc_id + '/edit').then((response) => {
        _this.lichtruc = response.data[0];
        _this.selectedKythuatvien = { id: _this.lichtruc.kythuatvien_id, name: _this.lichtruc.name}
      });

      Axios.get(_this.urlCurrent+'/api/kythuatvien/').then((response) => {
        _this.kythuatvienList = response.data;
      });
   },
   methods: {
     createlichtruc: function() {
      var _this = this;
      var data = {
            hocky_id: _this.lichtruc.hocky_id,
            thu_id: _this.lichtruc.thu_id,
            ca_id: _this.lichtruc.ca_id,
            kythuatvien_id: _this.selectedKythuatvien.id,
            ghichu: _this.lichtruc.ghichu
          }
       Axios.patch(_this.urlCurrent + '/api/lichtruc/'+_this.lichtruc.id, data).then((response) => {
          this.$router.push({name: 'LichtrucList'})
       });
     }
   }
 }
</script>