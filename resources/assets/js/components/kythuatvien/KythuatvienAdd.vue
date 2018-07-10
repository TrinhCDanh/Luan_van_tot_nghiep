<template id="add-kythuatvien">
    <div>
        <v-layout justify-center>
            <v-flex xs12 sm10 md8 lg6>
                <v-card ref="form">
                    <v-card-title>
                        <p class="display-1">Thêm thông tin kỹ thuật viên</p>
                    </v-card-title>
                    <v-form v-model="valid" v-on:submit.prevent="createkythuatvien" method="POST">
                        <v-card-text>

                            <v-alert :value="error" type="error" v-if="error != ''">
                                {{ error }}
                            </v-alert>

                            <input type="hidden" name="_token" :value="kythuatvien._token">
                            <v-text-field v-model="kythuatvien.makythuatvien" :rules="maktvRules"
                                          label="Mã số kỹ thuật viên" required @change="matkhau()"></v-text-field>
                            <v-text-field v-model="kythuatvien.name" :rules="nameRules" label="Tên kỹ thuật viên"
                                          required></v-text-field>
                            <v-text-field v-model="kythuatvien.email" :rules="emailRules" label="Email"
                                          required></v-text-field><!-- :rules="emailRules" -->
                            <v-text-field type="password" :rules="passRules" v-model="kythuatvien.password"
                                          label="Mật khẩu" required></v-text-field>

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
                urlCurrent: location.origin,
                kythuatvien: {makythuatvien: '', name: '', email: '', password: '', _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                // kythuatvien: {
                //     makythuatvien: '',
                //     name: '',
                //     email: '',
                //     password: '',
                //     _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                // },
                valid: false,
                name: '',
                error: '',
                email: '',
                nameRules: [
                    v => !!v || 'Bạn chưa nhập tên kỹ thuật viên',
                ],
                maktvRules: [
                    v => !!v || 'Bạn chưa nhập mã kỹ thuật viên',
                ],
                passRules: [
                    v => !!v || 'Bạn chưa nhập mật khẩu',
                ],
                emailRules: [
                    v => !!v || 'Bạn chưa nhập email',
                    v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Địa chỉ mail không hợp lệ'
                ],
            }
        },
        methods: {
            // matkhau() {
            //   console.log(this.kythuatvien.name);
            //   this.kythuatvien.password = this.kythuatvien.makythuatvien;
            // },
            matkhau: function () {
                this.kythuatvien.password = this.kythuatvien.makythuatvien;
            },
            createkythuatvien: function () {
                var _this = this;
                if (_this.kythuatvien.makythuatvien == '' || _this.kythuatvien.name == '' || _this.kythuatvien.email == '' || _this.kythuatvien.password == '') {
                    _this.error = 'Chưa nhập đầy đủ thông tin';
                }else{
                    _this.error = '';
                    axios.post(_this.urlCurrent + '/api/kythuatvien',this.kythuatvien).then((rep) =>{
                        if(rep.data.error){
                            _this.error = rep.data.error;
                            console.log(rep.data.error);
                        }
                        console.log(rep.data.error);
                    })
                }
            }
            // createkythuatvien: function () {
            //     var _this = this;
            //     var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            //
            //     if (_this.kythuatvien.makythuatvien == "" || _this.kythuatvien.name == "" || _this.kythuatvien.email == "" || _this.kythuatvien.password == "")
            //         _this.error = 'Chưa nhập đầy đủ thông tin';
            //     else if (!filter.test(_this.kythuatvien.email))
            //         _this.error = 'Email không hợp lệ';
            //     else
            //         _this.error = '';
            //
            //     //  Axios.post(_this.urlCurrent + '/api/kythuatvien', this.kythuatvien).then((response) => {
            //     //     this.$router.push({name: 'KythuatvienList'})
            //     //  })
            //
            //     if (_this.error == "") {
            //         Axios.post(_this.urlCurrent + '/api/kythuatvien', this.kythuatvien).then((response) => {
            //             if (response.data.error) {
            //                 _this.error = response.data.error;
            //             }
            //             else {
            //                 _this.$router.push({name: 'KythuatvienList'})
            //                 _this.error = '';
            //             }
            //         });
            //     }
            // }
        }
    }
</script>