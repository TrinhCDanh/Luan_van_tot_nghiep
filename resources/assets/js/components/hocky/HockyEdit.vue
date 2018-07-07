<template id="edit-hocky">
  <div>
    <v-layout justify-center>
      <v-flex xs12 sm10 md8 lg6>
        <v-card ref="form">
          <v-card-title>
              <p class="display-1">Cập nhật thông tin học kỳ</p>
          </v-card-title>
          <v-form v-model="valid" v-on:submit.prevent="editHocky" method="POST">
              <v-card-text>

                <v-alert :value="error" type="error" v-if="error != ''">
                  {{ error }}
                </v-alert>

                <v-select
                  :items="hockyNameList"
                  v-model="selectedHockyName"
                  label="Tên học kỳ"
                  single-line
                  item-text="name"
                  item-value="name"
                  return-object
                  persistent-hint
                  :rules="nameRules"
                  required
                ></v-select>

                <v-select
                  :items="namhocList"
                  v-model="selectedNamhoc"
                  label="Năm học"
                  single-line
                  item-text="name"
                  item-value="name"
                  return-object
                  persistent-hint
                  :rules="namhocRules"
                  required
                ></v-select>

                <v-layout row wrap>
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
                      <v-date-picker v-model="hocky.ngaybatdau"  @input="$refs.menubatdau.save(hocky.ngaybatdau)"></v-date-picker>
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
                      <v-date-picker v-model="hocky.ngayketthuc"  @input="$refs.menuketthuc.save(hocky.ngayketthuc)"></v-date-picker>
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
        hockyNameList: [
          { name: 'Học kỳ I' }, 
          { name: 'Học kỳ II' }, 
          { name: 'Học kỳ III' }
        ],
        selectedHockyName: {},
        namhocList: [],
        selectedNamhoc: {},
        hocky: {tenhocky: '', namhoc: '', ngaybatdau: '', ngayketthuc: ''},
        valid: false,
        name: '',
        error:'',
        nameRules: [
          v => !!v || 'Chưa chọn tên học kỳ'
        ],
        namhocRules: [
          v => !!v || 'Chưa chọn tên năm học'
        ],
        ngaybatdauRules: [
          v => !!v || 'Phải chọn ngày bắt đầu'
        ],
        ngayketthucRules: [
          v => !!v || 'Phải chọn ngày kết thúc'
        ],
        date: null,
        menu: false,
        modal: false,
        menuketthuc: false,
        menubatdau: false
      }
    },
    methods: {
      editHocky: function () {
          //  //console.log(this.hocky);
          //   let uri = location.origin + '/api/hocky/' + this.hocky.id; // CHỈ CẦN DƯ DẤU / LÀ AXIOS SẼ HIỂU SAI PHƯƠNG THỨC TRUYỀN POST THÀNH GET
          //   console.log(uri);
          //   Axios.patch(uri, this.hocky).then((response) => {
          //      this.$router.push({name: 'HockyList'})
          //      // console.log(response.data);
          //   })
        var _this = this;
        let url = location.origin + '/api/hocky/' + _this.hocky.id;

        let ngaybatdau = _this.hocky.ngaybatdau;
        let ngayketthuc = _this.hocky.ngayketthuc;
        //console.log(new Date(ngaybatdau).getDay());
        _this.hocky.tenhocky = _this.selectedHockyName.name || "";
        _this.hocky.namhoc = _this.selectedNamhoc.name || "";
        let tenhocky = _this.hocky.tenhocky;
        let namhoc = _this.hocky.namhoc;
        //console.log(this.hocky);
        // console.log('hello' + tenhocky);
        if(ngaybatdau == "" || ngayketthuc == "" || tenhocky == "" || namhoc == "")
          _this.error = 'Chưa nhập đầy đủ thông tin';
        else if(new Date(ngaybatdau).getDay() != 1)
          _this.error = 'Ngày bắt đầu nên là Thứ hai';
        else if(new Date(ngayketthuc).getDay() != 0)
          _this.error = 'Ngày kết thúc nên là Chủ nhật';
        else if(ngayketthuc < ngaybatdau)
          _this.error = 'Ngày kết thúc phải lớn hơn ngày bắt đầu';
        else 
          _this.error = "";

        if(_this.error == ""){
          axios.patch(url, this.hocky).then((rep) => {
              if(rep.data.error) {
                _this.error = rep.data.error;
              }
              else {
                _this.$router.push({name:'HockyList'})
                _this.error = '';
              }
          });
        }
      }
    },
    created: function () {
      var _this = this;
      var today = new Date();
      var currentYear = today.getFullYear();
      var prevYear = currentYear - 1;
      var namhoc = { name: prevYear + " - " + currentYear };
      _this.namhocList.push(namhoc);
      for(var i = 2; i <= 4; i++) {
        var nextYear = currentYear + 1;
        namhoc = { name: currentYear + " - " + nextYear };
        _this.namhocList.push(namhoc);
        currentYear = nextYear;
      }

        let urlCurrent = location.href;
        let hocky_id = urlCurrent.slice(urlCurrent.indexOf('edit/') + 5);
        let url = location.origin + '/api/hocky/' + hocky_id + '/edit';
        axios.get(url).then((rep) => {
            _this.hocky = rep.data;
            _this.selectedHockyName = { name: _this.hocky.tenhocky },
            _this.selectedNamhoc = { name: _this.hocky.namhoc }
        })
    }
  }
</script>