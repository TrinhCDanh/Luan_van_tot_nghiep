<template id="edit-kythuatvien">

  <v-layout justify-center>

      <v-dialog v-model="dialog" persistent max-width="290">
        <v-card>
          <v-card-title class="headline">Are you sure?</v-card-title>
          <v-card-text>{{ warnContent }}</v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" flat @click="uploadAvatar('yes'), dialog = false">Yes</v-btn>
            <v-btn color="green darken-1" flat @click.native="dialog = false">No</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-flex xs12 sm10 md8 lg6>
        <v-card ref="form">
          <v-card-title>
            <p class="display-1">Import lịch dạy của giảng viên</p>
          </v-card-title>
          <v-form v-model="valid" v-on:submit.prevent = "uploadAvatar" method="POST">
            <v-card-text>

              <v-alert :value="successTrigger" type="success">
                {{ successContent }}
              </v-alert>

              <input type="hidden" name="_token" :value="kythuatvien._token">
              
              <v-select
                :items="hockyList"
                v-model="selectedHocky"
                label="Học kỳ"
                single-line
                item-text="tenhocky"
                item-value="id"
                return-object
                persistent-hint
              ></v-select>

              <div class="file-upload">
                  <input type="file" id="fileInput" ref = "fileInput" v-on:change="onImageChange"/>
                  <v-btn class="btn-image"><img id="blah" alt="your image" style="width: 100%" v-bind:src="image" /></v-btn>
                  <p style="text-align: center; margin-top: 10px">Up file excel tại đây với đuôi file .xlsx</p> 
              </div>

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

  
</template>

<script>
 export default {
   data: function () {
     return {
        urlCurrent: location.origin,
        kythuatvien_current_id: sessionStorage.getItem('kythuatvien_id'),
        kythuatvien: {makythuatvien: '', name: '', oldpassword: '', confirmpassword: ''},
        valid: false,
        switch1: false,
        error: false,
        errorContent: '',
        image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9F8HEyStEfOMabrtLwi5r9UyiLej5Ahk1fm4AiVLKm0kgsyOt3w',
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
        tab: null,
        items: [
          'Thông tin', 'Ảnh đại diệns'
        ],
        hockyList: [],
        selectedHocky: 0,
        dialog: false,
        warnContent: '',
        successContent: '',
        successTrigger: false
     }
   },
   methods: {
     test() {
        return 'hello';
     },
     editkythuatvien: function() {
       var _this = this;
    //    let uri = location.origin + '/api/kythuatvien/' + _this.kythuatvien_current_id;
    //    Axios.patch(uri, _this.kythuatvien).then((response) => {
    //       _this.$router.push({name: 'KythuatvienList'})
    //    })

        Axios.post(location.origin + '/api/kythuatvien-edit-mycount/' + _this.kythuatvien_current_id, _this.kythuatvien).then((response) => {
        //   _this.$router.push({name: 'KythuatvienList'})
            if(response.data.fail) {
                _this.error = true;
                _this.errorContent = response.data.fail;
                console.log(response.data);
                setTimeout(() => {
                    _this.error = false;
                    _this.errorContent = '';
                }, 5000);
            } else _this.$router.push({name: 'Home'});
            //console.log(response.data);
        });
     },
     uploadAvatar(tieptuc = 'no') {
        var _this = this;

        var formData = new FormData();
        var hocky_id = "";
        if(typeof _this.selectedHocky == 'number')
          hocky_id = _this.selectedHocky;
        else 
          hocky_id = _this.selectedHocky.id;
        formData.append('id', '1');
        formData.append('fileExcel', this.$refs.fileInput.files[0]);
        formData.append('hocky_id', hocky_id);
        formData.append('tieptuc', tieptuc);
        
        //console.log(formData);

        Axios.post(location.origin + '/api/lichday', formData).then((response) => {
          console.log(response.data);
          if(response.data.warn) {
            _this.dialog = true;
            _this.warnContent = response.data.warn;
          }
          if(response.data.success) {
            _this.successContent = response.data.success;
            _this.successTrigger = true;
            setTimeout(() => {
                _this.successContent = '';
                _this.successTrigger = false;
            }, 5000);
            _this.image = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9F8HEyStEfOMabrtLwi5r9UyiLej5Ahk1fm4AiVLKm0kgsyOt3w';
          }
          
          // if(response.data.fail) {
          //       _this.error = true;
          //       _this.errorContent = response.data.fail.image[0];
          //       console.log(response.data);
          //       setTimeout(() => {
          //           _this.error = false;
          //           _this.errorContent = '';
          //       }, 5000);
          // } else _this.image = _this.urlCurrent + '/images/' + response.data;
          // _this.$emit('uploadAvatar');
        //   _this.$router.push({name: 'KythuatvienList'})
            // if(response.data.fail) {
            //     _this.error = true;
            //     _this.errorContent = response.data.fail;
            //     console.log(response.data);
            //     setTimeout(() => {
            //         _this.error = false;
            //         _this.errorContent = '';
            //     }, 5000);
            // } else 
            //_this.$router.push({name: 'Home'});
            //console.log(response.data);
        });
     },
     checkOldPass() {
         console.log(this.kythuatvien.password);
     },
     onImageChange(e) {
            // let files = e.target.files || e.dataTransfer.files;
            // if (!files.length)
            //     return;
            // this.createImage(files[0]); 
            // console.log('hello image');
            this.image = "http://entefire.it/fire/wp-content/uploads/corso-excel-base.png";
        },
        // createImage(file) {
        //     let reader = new FileReader();
        //     let vm = this;
        //     reader.onload = (e) => {
        //         vm.image = e.target.result;
        //     };
        //     reader.readAsDataURL(file);
        // },
   },
   created: function() {
      var _this = this;
      let uri = location.origin+'/api/kythuatvien/'+ _this.kythuatvien_current_id + '/edit';
      Axios.get(uri).then((response) => {
        _this.kythuatvien = response.data;
        if(_this.kythuatvien.image) {
          _this.image = _this.urlCurrent + '/images/' + _this.kythuatvien.image;
          console.log(_this.image);
        }
          
        console.log(_this.kythuatvien);
      });
      Axios.get(_this.urlCurrent+'/api/hocky').then((response) => {
        // _this.hockyList = response.data;
        
        for(var hocky of response.data) {
          let hockyItem = { id: hocky.id, tenhocky: hocky.tenhocky + ' - ' + hocky.namhoc, ngaybatdau: hocky.ngaybatdau, ngayketthuc: hocky.ngayketthuc }
          _this.hockyList.push(hockyItem);
        }
        console.log(_this.hockyList);

        var ngayhientai = Date.now();
        for(var hocky of this.hockyList) {
          var ngaybatdau = new Date(hocky.ngaybatdau).getTime();
          var ngayketthuc = new Date(hocky.ngayketthuc).getTime();
          if(ngaybatdau < ngayhientai && ngayhientai < ngayketthuc) {
            _this.selectedHocky = hocky.id;
            break;
          }
        }
      }).catch(function (error) {
        _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
      });
    }
 }
</script>

<style scope>
    .changePass {
        animation: showchangepass 0.25s;
    }
    .file-upload {
      white-space: nowrap;
      position: relative;
      width: 250px;
      height: 250px;
      background-color: gold;
      margin: auto;
    }

    .file-upload input[type="file"] {
      position: absolute;
      top:0; left:0;
      height: 100%;
      z-index: 100;
      opacity: 0;
      cursor: pointer;
    }
    /* .file-upload input[type="file"]:hover + .btn-image {
      opacity: 0.5;
    } */
    .btn-image {
      padding: 0;
      margin: 0;
      background-color: #fff;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }
    .btn-image .btn__content {
      padding: 0;
    }
    @keyframes showchangepass {
        from { opacity: 0 }
        to { opacity: 1 }
    }
</style>
