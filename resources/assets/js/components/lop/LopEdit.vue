<template id="lop-edit">
    <div>
        <v-layout justify-center>
        <v-flex xs12 sm10 md8 lg6>
            <v-card ref="form">
            <v-card-title>
                <p class="display-1">Cập nhật thông tin nhóm lớp</p>
            </v-card-title>
            <v-form v-model="valid" v-on:submit.prevent="editItem" method="POST">
                <v-card-text>
                
                <v-alert :value="error" type="error" v-if="error != ''">
                {{ error }}
                </v-alert>
                <!-- <v-text-field v-model="hocky.tenhocky" :rules="nameRules" label="Tên học kỳ" required></v-text-field> -->
                
                <v-select
                    :items="hockyList"
                    v-model="selectedHocky"
                    label="Học kỳ"
                    single-line
                    item-text="tenhocky"
                    item-value="id"
                    return-object
                    persistent-hint
                    :rules="hockyRules"
                ></v-select>

                <v-text-field
                    v-model="lop.nhomlop"
                    :rules="nhomlopRules"
                    label="Tên Lớp"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="lop.siso"
                    :rules="sisolRules"
                    label="Sỉ Số"
                    type="number"
                    required
                ></v-text-field>

                </v-card-text>
                <v-divider class="mt-5"></v-divider>
                <v-card-actions>
                <v-btn v-bind:to="{name: 'LopList'}">Back</v-btn>
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
                valid: false,
                lop: {nhomlop: '', siso: ''},
                error: '',
                hockyList: [],
                selectedHocky: 0,
                sisolRules: [
                    v => !!v || 'Sỉ số không để trống',
                ],
                nhomlopRules: [
                    v => !!v || 'Tên lớp không để trống',
                ],
                hockyRules: [
                    v => !!v || 'Chưa chọn học kỳ',
                ]
            };
        },
        created() {

            var _this = this;

            Axios.get(_this.urlCurrent+'/api/hocky').then((response) => {
                for(var hocky of response.data) {
                    let hockyItem = { id: hocky.id, tenhocky: hocky.tenhocky + ' - ' + hocky.namhoc, ngaybatdau: hocky.ngaybatdau, ngayketthuc: hocky.ngayketthuc }
                    _this.hockyList.push(hockyItem);
                }
            }).catch(function (error) {
                _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
            });

            let urlCurrent = window.location.href;
            let id_lop = urlCurrent.slice(urlCurrent.lastIndexOf('/edit') + 5);
            axios.get(_this.urlCurrent + '/api/nhomlop' + id_lop + '/edit').then((rep) => {
                _this.lop = rep.data;
                _this.selectedHocky = _this.lop.hocky_id;
            });
        },
        methods: {
            editItem: function () {
                var _this = this;
                var hocky_id = "";
                if(typeof _this.selectedHocky == 'number')
                    hocky_id = _this.selectedHocky;
                else 
                    hocky_id = _this.selectedHocky.id;

                var nhomlopItem = {
                    nhomlop: _this.lop.nhomlop,
                    siso: _this.lop.siso,
                    hocky_id: hocky_id
                }
                console.log(nhomlopItem);

                if(nhomlopItem.nhomlop == '' || nhomlopItem.siso == '') 
                    _this.error = 'Chưa nhập đầy đủ thông tin';
                else
                    _this.error = '';
                    
                if(_this.error == ""){
                    axios.patch(_this.urlCurrent+ '/api/nhomlop/' + this.lop.id, nhomlopItem).then((rep) => {
                        if(rep.data.error) {
                            _this.error = rep.data.error;
                        }
                        else {
                            _this.$router.push({name:'LopList'})
                            _this.error = '';
                        }   
                    });
                }
            }
        },
        computed: {}
    }
</script>