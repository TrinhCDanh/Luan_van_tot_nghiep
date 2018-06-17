<template id="edit-hocky">
  <div>
    <v-layout justify-center>
      <v-flex xs12 sm10 md8 lg6>
        <v-card ref="form">
          <v-card-title>
            <p class="display-1">Cập nhật thông tin học kỳ</p>
          </v-card-title>
          <v-form v-model="valid" v-on:submit.prevent = "editHocky" method="POST">
            <v-card-text>

              <v-text-field v-model="hocky.tenhocky" :rules="nameRules" label="Tên học kỳ" required></v-text-field>
              <v-text-field v-model="hocky.namhoc"  label="Năm học" required></v-text-field><!-- :rules="emailRules"
        -->      <v-layout row wrap>
                <v-flex xs12 sm6 md6>
                  <v-menu
                    ref="menubatdau"
                    :close-on-content-click="false"
                    v-model="menubatdau"
                    :nudge-right="40"
                    :return-value.sync="date"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <v-text-field
                      slot="activator"
                      v-model="hocky.ngaybatdau"
                      label="Ngày học kỳ bắt đầu"
                      readonly required
                    ></v-text-field>
                    <v-date-picker v-model="hocky.ngaybatdau" @input="$refs.menubatdau.save(hocky.ngaybatdau)"></v-date-picker>
                  </v-menu>
                </v-flex>
                <v-spacer></v-spacer>
                <v-flex xs12 sm6 md6>
                  <v-menu
                    ref="menuketthuc"
                    :close-on-content-click="false"
                    v-model="menuketthuc"
                    :nudge-right="40"
                    :return-value.sync="date"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <v-text-field slot="activator"
                      v-model="hocky.ngayketthuc"
                      label="Ngày học kỳ kết thúc"
                      readonly required
                      :rules="ngaybatdauRules"
                    ></v-text-field>
                    <v-date-picker v-model="hocky.ngayketthuc" @input="$refs.menuketthuc.save(hocky.ngayketthuc)"></v-date-picker>
                  </v-menu>
                </v-flex>
              </v-layout>

            </v-card-text>
            <v-divider class="mt-5"></v-divider>
            <v-card-actions>
              <v-btn v-bind:to="{name: 'HockyList'}">Back</v-btn>
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
        hocky: {tenhocky: '', namhoc: '', ngaybatdau: '', ngayketthuc: ''},
        valid: false,
        name: '',
        nameRules: [
          v => !!v || 'Name is required',
          v => v.length <= 10 || 'Name must be less than 10 characters'
        ],
        // email: '',
        // emailRules: [
        //   v => !!v || 'E-mail is required',
        //   v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        // ],
        ngaybatdauRules: [
          v => !!v || 'Phải chọn ngày bắt đầu'
        ],
        date: null,
        menu: false,
        modal: false,
        menuketthuc: false,
        menubatdau: false
     }
   },
   methods: {
     editHocky: function() {
      //console.log(this.hocky);
       let uri = location.origin + '/api/hocky/' + this.hocky.id; // CHỈ CẦN DƯ DẤU / LÀ AXIOS SẼ HIỂU SAI PHƯƠNG THỨC TRUYỀN POST THÀNH GET
       console.log(uri);
       Axios.patch(uri, this.hocky).then((response) => {
          this.$router.push({name: 'HockyList'})
          // console.log(response.data);
       })
     }
   },
   created: function() {
      let urlCurrent = window.location.href;
      let hocky_id = urlCurrent.slice(urlCurrent.lastIndexOf('edit/') + 5 , urlCurrent.length);
      let uri = location.origin+'/api/hocky/'+ hocky_id + '/edit';
      Axios.get(uri).then((response) => {
        this.hocky = response.data;
      });
    }
 }
</script>