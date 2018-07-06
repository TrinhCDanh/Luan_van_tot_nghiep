<template id="add-hocky">
  <div>
    <v-layout justify-center>
      <v-flex xs12 sm10 md8 lg6>
        <v-card ref="form">
          <v-card-title>
            <p class="display-1">Thêm thông tin học kỳ mới</p>
          </v-card-title>
          <v-form v-model="valid" v-on:submit.prevent = "createhocky" method="POST">
            <v-card-text>
              
              <v-alert :value="error" type="error" v-if="error != ''">
                {{ error }}
              </v-alert>
              <!-- <v-text-field v-model="hocky.tenhocky" :rules="nameRules" label="Tên học kỳ" required></v-text-field> -->

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
                      :rules="ngaybatdauRules"
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
                      :rules="ngayketthucRules"
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
          hockyNameList: [
            { id: 1, name: 'Học kỳ I' }, 
            { id: 2, name: 'Học kỳ II' }, 
            { id: 3, name: 'Học kỳ III' }
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
    created() {
      var _this = this;
      var today = new Date(); // lấy ngày hiện tại
      var currentYear = today.getFullYear(); // lấy năm hiện tại
      var prevYear = currentYear - 1; // 
      var namhoc = { id: 1, name: prevYear + " - " + currentYear }; // id không quan trọng
      _this.namhocList.push(namhoc);
      console.log(_this.namhocList);
      for(var i = 2; i <= 4; i++) {
        var nextYear = currentYear + 1;
        namhoc = { id: i, name: currentYear + " - " + nextYear };
        _this.namhocList.push(namhoc);
        currentYear = nextYear;
      }
    },
    methods: {
      createhocky: function() {
        var _this = this;
        let url = location.origin + '/api/hocky'; // CHỈ CẦN DƯ DẤU / LÀ AXIOS SẼ HIỂU SAI PHƯƠNG THỨC TRUYỀN POST THÀNH GET
        let ngaybatdau = _this.hocky.ngaybatdau;
        let ngayketthuc = _this.hocky.ngayketthuc;
        //console.log(new Date(ngaybatdau).getDay());
        _this.hocky.tenhocky = _this.selectedHockyName.name || ""; // nếu có 1 thì 1 
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
            axios.post(url,_this.hocky).then((rep) => {
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
    }
 }
</script>