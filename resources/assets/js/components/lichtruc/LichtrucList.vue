<template id="lichtruc-list">
    <div class="lichtruc-list-container">

        <div style="position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);text-align: center">
            <v-progress-circular v-if="isLoading" :size="70" :width="7" indeterminate color="blue">

            </v-progress-circular>
            <p class="error-text">{{ fetchError }}</p>
        </div>

        <v-card v-if="!isLoading" class="lichtruc-box">
            <v-card-title>
                <p class="display-1">Danh sách học kỳ</p>
                <v-spacer></v-spacer>
                <label style="font-weight: bold">Chọn học kỳ : </label>
                <select name="carlist" form="carform" class="slt-hocky" v-model="selectedHocky"
                        v-on:change="chooseHocky()">
                    <option
                            v-for="(hocky,index) in hockyList"
                            :value="hocky.id"
                            :key="index"
                    >
                        {{ hocky.tenhocky }} - {{ hocky.namhoc }}
                    </option>
                </select>

                <!--<v-select-->
                        <!--v-model="selectedHocky"-->
                        <!--:items="hockyList"-->
                        <!--item-text="tenhocky"-->
                        <!--item-value="id"-->
                        <!--label="Select"-->
                        <!--persistent-hint-->
                        <!--return-object-->
                        <!--single-line-->
                <!--&gt;</v-select>-->


            </v-card-title>
            <div class="lichtruc-data">
                <div class="col-ca">
                    <div class="ca-content" style="height: 50px">
                    </div>
                    <div class="ca-content" v-for="(ca,index) in caList" :key="index">
                        <p style="text-align: center; line-height: 100px; font-weight: bold">{{ ca.tenca }}</p>
                    </div>
                </div>
                <div class="col-thu">
                    <div class="row-thu">
                        <div class="thu-content" v-for="(thu,index) in thuList" :key="index">
                            <p style="text-align: center; line-height: 50px; font-weight: bold">{{ thu.tenthu }}</p>
                        </div>
                    </div>
                    <div class="lichtruc-content">
                        <div v-for="( thu, key ) in thuList" :key="key" style="width: 14.28%;">
                            <div v-for="( ca, key ) in caList" :key="key">
                                <div style="border: 1px solid white; height: 100px; background-color: #eeeeee">
                                    <div class="lichtruc-detail" v-if="checkLichtruc(ca.id, thu.id) == ''">
                                        <v-btn icon class="mx-0 btn-add" @click="addItem(ca.id, thu.id)">
                                            <v-icon color="blue">add</v-icon>
                                        </v-btn>
                                    </div>
                                    <div v-else class="lichtruc-detail">
                                        <div class="name-ktv">{{ checkLichtruc(ca.id, thu.id).name }}</div>
                                        <div class="btn-action">
                                            <v-btn icon class="mx-0" @click="editItem(checkLichtruc(ca.id, thu.id).id)">
                                                <v-icon color="teal">edit</v-icon>
                                            </v-btn>
                                            <v-btn icon class="mx-0" @click="deleteItem(ca.id, thu.id)">
                                                <v-icon color="pink">delete</v-icon>
                                            </v-btn>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </v-card>

    </div>

</template>

<script>
    export default {
        data: function () {
            return {
                isLoading: false,
                countLoading: 0,
                fetchError: '',
                urlCurrent: location.origin,
                hockyList: [],
                caList: [],
                thuList: [],
                selectedHocky: 0,
                lichtrucList: [
                    // { ca_id: 1, thu_id: 1, name: 'Kythuatvien Two' },
                    // { ca_id: 5, thu_id: 1, name: 'Kythuatvien Five'},
                    // { ca_id: 3, thu_id: 2, name: 'Kythuatvien Six'},
                    // { ca_id: 1, thu_id: 2, name: 'Kythuatvien Six'},
                    // { ca_id: 3, thu_id: 4, name: 'Kythuatvien Six'}
                ]
            };
        },
        created: function () {
            var _this = this;
            _this.fetchData();
        },
        methods: {
            fetchData() {
                var _this = this;
                _this.isLoading = false;
                axios.get(_this.urlCurrent + '/api/ca').then((rep) => {
                    _this.caList = rep.data;
                    _this.countLoading++;
                }).catch(function (error) {
                    _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
                })


                Axios.get(_this.urlCurrent + '/api/thu').then((response) => {
                    _this.thuList = response.data;
                    _this.countLoading++;
                }).catch(function (error) {
                    _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
                });

                Axios.get(_this.urlCurrent + '/api/hocky').then((response) => {
                    _this.hockyList = response.data;
                    // _this.selectedHocky = _this.hockyList.id;

                    var ngayhientai = Date.now();//new Date('2018-12-12');

                    for (var hocky of this.hockyList) {

                        var ngaybatdau = new Date(hocky.ngaybatdau).getTime();
                        var ngayketthuc = new Date(hocky.ngayketthuc).getTime();

                        if (ngaybatdau < ngayhientai && ngayhientai < ngayketthuc) {
                            _this.selectedHocky = hocky.id;
                            _this.countLoading++;
                            // console.log(_this.selectedHocky);
                            break;
                        }
                    }
                    Axios.get(_this.urlCurrent + '/api/lichtruc-hocky/' + _this.selectedHocky).then((response) => {
                        _this.countLoading++;
                        _this.lichtrucList = response.data;
                        console.log(_this.lichtrucList);

                        if (_this.countLoading == 4) {
                            setTimeout(() => {
                                _this.lichtrucList = response.data;
                                _this.isLoading = false;
                            }, 2000);
                        }
                    }).catch(function (error) {
                        _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
                    });

                }).catch(function (error) {
                    _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
                });


                // Axios.get(_this.urlCurrent + '/api/lichtruc-hocky/' + _this.selectedHocky).then((response) => {
                //     _this.countLoading++;
                //     _this.lichtrucList = response.data;
                //     console.log(_this.lichtrucList);
                //
                //     if (_this.countLoading == 4) {
                //         setTimeout(() => {
                //             _this.lichtrucList = response.data;
                //             _this.isLoading = false;
                //         }, 2000);
                //     }
                // }).catch(function (error) {
                //     _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
                // });
            },
            chooseHocky() {
                Axios.get(this.urlCurrent + '/api/lichtruc-hocky/' + this.selectedHocky).then((response) => {
                    this.lichtrucList = response.data;
                    console.log(this.lichtrucList);
                    // can select 1 cai dau tien
                });
            },


            addItem(ca, thu) {
                //alert(ca_id + ' - ' + thu_id);
                this.$router.push({
                    name: 'LichtrucAdd',
                    params: {hocky_id: this.selectedHocky, ca_id: ca, thu_id: thu}
                });
            },

            deleteItem(ca_id, thu_id) {
                for (var item of this.lichtrucList) {
                    if (item.ca_id == ca_id && item.thu_id == thu_id) {
                        axios.delete(this.urlCurrent + '/api/lichtruc/' + item.id).then((rep) =>{
                            const index = this.lichtrucList.indexOf(item);
                            this.lichtrucList.splice(index, 1);
                        });
                        break;
                    }
                }
            },
            // deleteItem(ca_id, thu_id) {
            //     var dem = 0;
            //     var result = '';
            //     for (var item of this.lichtrucList) {
            //         if (item.ca_id == ca_id && item.thu_id == thu_id)
            //             dem++;
            //         if (dem == 1) {
            //             Axios.delete(this.urlCurrent + '/api/lichtruc/' + item.id).then((response) => {
            //                 const index = this.lichtrucList.indexOf(item);
            //                 this.lichtrucList.splice(index, 1);
            //             });
            //             break;
            //         }
            //     }
            // },
            // editItem(lichtruc_id) {
            //     //console.log(lichtruc_id);
            //     this.$router.push({path: `/admin/lichtruc/edit/${lichtruc_id}`});
            // },
            // checkLichtruc(ca_id, thu_id) {
            //     var dem = 0;
            //     var result = '';
            //     for (var item of this.lichtrucList) {
            //         if (item.ca_id == ca_id && item.thu_id == thu_id)
            //             dem++;
            //         if (dem == 1) {
            //             result = item;
            //             break;
            //         }
            //     }
            //     return result;
            // }



            // console.log ra có vấn đề
            checkLichtruc(ca_id, thu_id) {
                var dem = 0;
                var result = '';
                for (var item of this.lichtrucList) {
                    if (item.ca_id == ca_id && item.thu_id == thu_id) {
                        dem++;
                    }
                    if (dem == 1) {
                        result = item;
                    }
                }
                return result;
            },
            editItem (id) {
              this.$router.push({ path: `/admin/lichtruc/edit/` + id });
            },

            // deleteItem (item,id) {
            //   Axios.delete(location.origin+'/api/lichtruc/'+id).then((response) => {
            //     const index = this.lichtruclist.indexOf(item)
            //     this.lichtruclist.splice(index, 1)
            //   });
            //   // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') &&
            // },
        },
        computed: {
            // filteredlichtruc: function(){
            //   if(this.lichtruclist.length) {
            //     return this.lichtruclist;
            //   }
            // },
        },
        mounted() {
        }
    }
</script>

<style scoped>
    .lichtruc-box, .error-text {
        animation: displayLoading 0.5s;
    }

    .slt-hocky:focus {
        border: none;
    }

    .lichtruc-data, .row-thu, .lichtruc-content {
        display: flex;
    }

    .col-ca {
        width: 12.5%;
    }

    .col-thu {
        width: 87.5%;
    }

    .ca-content {
        border: 1px solid white;
        height: 100px;
        background-color: #2a4456;
        color: white;
    }

    .thu-content {
        width: 14.28%;
        border: 1px solid white;
        height: 50px;
        background-color: #19b698;
        color: white;
    }

    .lichtruc-detail {
        text-align: center;
        display: flex;
        justify-content: center;
        align-content: center;
        flex-flow: wrap;
        height: 100%;
    }

    .lichtruc-detail > div {
        align-items: center;
        width: 100%;
    }

    .lichtruc-detail .btn-add {
        align-self: center;
    }

    .name-ktv {
        font-size: 14px;
    }

    @keyframes displayLoading {
        from {
            opacity: 0
        }
        to {
            opacity: 1
        }
    }

    @media screen and (max-width: 1000px) {
        .lichtruc-box {
            overflow-x: scroll;
        }

        .col-ca {
            min-width: 150px;
        }

        .col-thu {
            min-width: 1000px;
        }
    }

</style>

<!-- SELECT chitiet_truc.id, chitiet_truc.ca_id, chitiet_truc.thu_id, kythuatvien.name, chitiet_truc.hocky_id FROM (((chitiet_truc join hocky on chitiet_truc.hocky_id = hocky.id) join thu on chitiet_truc.thu_id = thu.id) JOIN ca on chitiet_truc.ca_id = ca.id) JOIN kythuatvien on chitiet_truc.kythuatvien_id = kythuatvien.id WHERE hocky_id = 17 -->