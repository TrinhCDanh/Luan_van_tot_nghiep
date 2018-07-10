<template id="monhoc-add">
    <div>
        <v-layout justify-center>
            <v-flex xs12 sm10 md8 lg6>
                <v-card ref="form">
                    <v-card-title>
                        <p class="display-1">Thêm thông tin môn học</p>
                    </v-card-title>
                    <v-form v-model="valid" v-on:submit.prevent="editMonHoc" method="POST">
                        <v-card-text>

                            <v-alert :value="error" type="error" v-if="error != ''">
                                {{ error }}
                            </v-alert>
                            <!-- <v-text-field v-model="hocky.tenhocky" :rules="nameRules" label="Tên học kỳ" required></v-text-field> -->

                            <v-text-field
                                    v-model="monhoc.mamonhoc"
                                    :rules="mamonhocRules"
                                    label="Mã Môn Học"
                                    required
                            ></v-text-field>
                            <v-text-field
                                    v-model="monhoc.tenmonhoc"
                                    :rules="tenmonhocRules"
                                    label="Tên Môn Học"
                                    required
                            ></v-text-field>
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
                                                v-model="monhoc.ngaybatdau"
                                                label="Ngày bắt đầu"
                                                prepend-icon="event"
                                                readonly
                                                :rules="ngaybatdauRules"
                                        ></v-text-field>
                                        <v-date-picker v-model="monhoc.ngaybatdau"
                                                       @input="$refs.menubatdau.save(monhoc.ngaybatdau)"></v-date-picker>
                                    </v-menu>
                                </v-flex>
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
                                        <v-text-field
                                                slot="activator"
                                                v-model="monhoc.ngayketthuc"
                                                label="Ngày kết thúc"
                                                prepend-icon="event"
                                                readonly
                                                :rules="ngayketthucRules"
                                        ></v-text-field>
                                        <v-date-picker v-model="monhoc.ngayketthuc"
                                                       @input="$refs.menuketthuc.save(monhoc.ngayketthuc)"></v-date-picker>
                                    </v-menu>
                                </v-flex>
                            </v-layout>

                        </v-card-text>
                        <v-divider class="mt-5"></v-divider>
                        <v-card-actions>
                            <v-btn v-bind:to="{name: 'MonhocList'}">Back</v-btn>
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
                valid: false,
                monhoc: {mamonhoc: '', tenmonhoc: '', ngaybatdau: '', ngayketthuc: ''},
                date: null,
                menu: false,
                modal: false,
                menubatdau: false,
                menuketthuc: false,
                mamonhoc: '',
                tenmonhoc: '',
                error: '',
                mamonhocRules: [
                    v => !!v || 'Chưa nhập mã môn học'
                ],
                tenmonhocRules: [
                    v => !!v || 'Chưa nhập tên môn học'
                ],
                ngaybatdauRules: [
                    v => !!v || 'Phải chọn ngày bắt đầu'
                ],
                ngayketthucRules: [
                    v => !!v || 'Phải chọn ngày kết thúc'
                ],
            };
        },
        created() {
            let urlCurrent = window.location.href;
            let id_monhoc = urlCurrent.slice(urlCurrent.lastIndexOf('edit') + 5);
            // API tra ve data
            let url = location.origin + '/api/monhoc/' + id_monhoc + '/edit';
            console.log(url);

            axios.get(url).then((rep) => {
                this.monhoc = rep.data;
            });
        },
        methods: {
            // editeMonHoc: function () {
            //     let url = location.origin + '/api/monhoc/' + this.monhoc.id;
            //     console.log(url);
            //     axios.patch(url, this.monhoc).then((rep) => {
            //         this.$router.push({name: 'MonhocList'})
            //         console.log(rep.data);
            //     });
            // }
            editMonHoc: function () {
                var _this = this;
                let url = window.location.origin + '/api/monhoc/' + this.monhoc.id;

                var maMon = _this.monhoc.mamonhoc;
                var ngaybatdau = _this.monhoc.ngaybatdau;
                var ngayketthuc = _this.monhoc.ngayketthuc;
                var tenmonhoc = _this.monhoc.tenmonhoc;

                if (ngaybatdau == "" || ngayketthuc == "" || tenmonhoc == "" || maMon == "")
                    _this.error = 'Chưa nhập đầy đủ thông tin';
                else if (ngayketthuc < ngaybatdau)
                    _this.error = 'Ngày kết thúc phải lớn hơn ngày bắt đầu';
                else{
                    _this.error = "";
                }
                if(_this.error == ""){
                    axios.patch(url, _this.monhoc).then((rep) => {
                        if (rep.data.error) {
                            _this.error = rep.data.error;
                        }
                        else {
                            // _this.$router.push({name: 'MonhocList'})
                            _this.error = '';
                        }
                    });
                }
            }
        },
        computed: {}
    }
</script>