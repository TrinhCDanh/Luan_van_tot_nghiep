<template id="edit-kythuatvien">
  <v-layout justify-center>
    <v-flex xs12 sm10 md8 lg6>
      <v-card ref="form">
        <v-card-title>
          <p class="display-1">Quản lý tài khoản</p>
        </v-card-title>
        <v-tabs icons-and-text grow dark color="cyan">
          <v-tabs-slider color="yellow"></v-tabs-slider>
          <v-tab href="#tab-1">
            Thông tin tài khoản
            <v-icon>account_box</v-icon>
          </v-tab>
          <v-tab href="#tab-2">
            Ảnh đại diện
            <v-icon>image</v-icon>
          </v-tab>
          <v-tab-item :id="'tab-1'">
            <v-card flat>
              <v-form v-model="valid" v-on:submit.prevent = "editkythuatvien" method="POST">
                <v-card-text>
                  <v-alert :value="error" type="error">
                      {{ errorContent }}.
                  </v-alert>
                  <br>
                  <input type="hidden" name="_token" :value="kythuatvien._token">
                  <v-text-field v-model="kythuatvien.makythuatvien" label="Mã số kỹ thuật viên" required></v-text-field>
                  <v-text-field v-model="kythuatvien.name" :rules="nameRules" label="Tên kỹ thuật viên" required></v-text-field>
                  <v-text-field v-model="kythuatvien.email" :rules="emailRules" label="Email" required disabled></v-text-field><!-- :rules="emailRules" -->

                  <v-switch :label="`Đổi mật khẩu: ${switch1.toString() == 'true' ? 'Yes' : 'No'}`" v-model="switch1"></v-switch>
                  <div v-if="switch1" class="changePass">
                      <v-text-field type="password" v-model="kythuatvien.oldpassword" label="Mật khẩu cũ" required></v-text-field>
                      <v-text-field type="password" v-model="kythuatvien.newpassword" label="Mật khẩu mới" required></v-text-field>
                      <v-text-field type="password" v-model="kythuatvien.confirmpassword" label="Nhập lại mật khẩu mới" required></v-text-field>
                  </div>

                </v-card-text>
                <v-divider class="mt-5"></v-divider>
                <v-card-actions>
                  <v-btn v-bind:to="{name: 'Home'}">Back</v-btn>
                  <v-spacer></v-spacer>
                  <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
                </v-card-actions>
              </v-form>
            </v-card>
          </v-tab-item>
          <v-tab-item :id="'tab-2'">
            <v-card flat>
              <v-form v-model="valid" v-on:submit.prevent = "uploadAvatar" method="POST">
                
                <v-card-text> 
                      <v-alert :value="error" type="error">
                          {{ errorContent }}.
                      </v-alert>
                      <br>
                      <div class="file-upload">
                          <input type="file" id="fileInput" ref = "fileInput" v-on:change="onImageChange"/>
                          <v-btn class="btn-image"><img id="blah" alt="your image" style="width: 100%" v-bind:src="image" /></v-btn> 
                      </div>
                      <p style="text-align:center; margin-top: 10px">Khuyến khích ảnh đại diện kích thước vuông, dung lượng tối đa 1MB</p>
                </v-card-text>
                <v-divider class="mt-5"></v-divider>
                <v-card-actions>
                  <v-btn v-bind:to="{name: 'Home'}">Back</v-btn>
                  <v-spacer></v-spacer>
                  <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
                </v-card-actions>
              </v-form>
            </v-card>
          </v-tab-item>
        </v-tabs>
        
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
        image: 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png',
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
     }
   },
   methods: {
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
     uploadAvatar() {
        var _this = this;

        var formData = new FormData();
        formData.append('id', '1');
        formData.append('image', this.$refs.fileInput.files[0]);

        Axios.post(location.origin + '/api/kythuatvien-upload-avatar/' + _this.kythuatvien_current_id, formData).then((response) => {
          console.log(response.data);
          if(response.data.fail) {
                _this.error = true;
                _this.errorContent = response.data.fail.image[0];
                console.log(response.data);
                setTimeout(() => {
                    _this.error = false;
                    _this.errorContent = '';
                }, 5000);
          } else _this.image = _this.urlCurrent + '/images/' + response.data;
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
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]); 
            console.log('hello image');
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
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
