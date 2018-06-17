<template id="add-hocky">
  <div>
    <!-- <form v-on:submit.prevent = "createhocky" method="POST">
      <div class="form-group">
        <label for="add-title">Tên học kỳ</label>
        <input type="text" id="add-title" v-model="hocky.tenhocky" class="form-control" required placeholder="Học kỳ I, Học kỳ II, Học kỳ Hè" />
      </div>
      <div class="form-group">
        <label for="add-body">Năm học</label>
        <input type="text" id="add-title" v-model="hocky.namhoc" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="add-body">Ngày bắt đầu</label>
        <input type="date" id="add-title" v-model="hocky.ngaybatdau" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="add-body">Ngày kết thúc</label>
        <input type="date" id="add-title" v-model="hocky.ngayketthuc" class="form-control" required />
      </div>
      <v-btn style="background-color: gold " type="submit" class="btn btn-xs btn-primary">Create hocky</v-btn>
      <router-link class="btn btn-xs btn-warning" v-bind:to="'/'">Cancel</router-link>
    </form> -->
  
    <v-layout justify-center>
      <v-flex xs12 sm10 md8 lg6>
        <v-card ref="form">
          <v-card-title>
            <p class="display-1">Thêm thông tin học kỳ mới</p>
          </v-card-title>
          <v-form v-model="valid" v-on:submit.prevent = "createhocky" method="POST">
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
     createhocky: function() {
      //console.log(this.hocky);
       let uri = location.origin + '/api/hocky'; // CHỈ CẦN DƯ DẤU / LÀ AXIOS SẼ HIỂU SAI PHƯƠNG THỨC TRUYỀN POST THÀNH GET
       console.log(uri);
       Axios.post(uri, this.hocky).then((response) => {
          this.$router.push({name: 'HockyList'})
          // console.log(response.data);
       })
     }
   }
 }
</script>