<template id="lop-list">
    <div class="row">
        <v-btn round color="error" class="pull-right" v-bind:to="{name: 'LopAdd'}">
            <v-icon>add</v-icon>
            Thêm thông tin lớp mới
        </v-btn>
        <br>
        <v-alert :value="error" type="error" v-if="error != ''" style="margin-top: 20px">
            {{ error }}
        </v-alert>
        <br>
        <v-card>
            <v-card-title>
                <p class="display-1">Danh sách nhóm lớp</p>
                <v-spacer></v-spacer>
                <v-layout wrap>
                    <v-flex xs12 sm6 md6>
                        <v-select
                                :items="hockyList"
                                v-model="selectedHocky"
                                label="Học kỳ"
                                single-line
                                item-text="tenhocky"
                                item-value="id"
                                return-object
                                persistent-hint
                                v-on:change="chooseHocky()"
                        ></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                        <v-text-field
                                v-model="search"
                                append-icon="search"
                                label="Search"
                                single-line
                                hide-details
                        ></v-text-field>
                    </v-flex>
                </v-layout>

            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="listLop"
                    :search="search"
                    :loading="isLoading"
                    :rows-per-page-items='[10, 20, 30, { text: "All", value: -1 }]'
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <td class="text-xs-left">{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.nhomlop }}</td>
                    <td class="text-xs-left">{{ props.item.siso }}</td>
                    <td class="justify-center layout px-0">
                        <v-btn icon class="mx-0" @click="editItem(props.item.id)">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="xacnhanxoa(props.item)">
                            <v-icon color="pink">delete</v-icon>
                        </v-btn>
                    </td>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Your search for "{{ search }}" found no results.
                </v-alert>
            </v-data-table>
        </v-card>

        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent max-width="290">
                <v-card>
                    <v-card-title class="headline">Are you sure?</v-card-title>
                    <v-card-text>Bạn có chắc chắn muốn xóa dữ liệu này?</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="green darken-1" flat @click.native="dialog = false">No</v-btn>
                        <v-btn color="green darken-1" flat
                               @click.native="deleteItem(selectedNhomlop, selectedNhomlop.id), dialog = false">Yes
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                urlCurrent: location.origin,
                search: '',
                listLop: [],
                isLoading: false,
                error: '',
                selectedNhomlop: {},
                hockyList: [],
                selectedHocky: 0,
                dialog: false,
                headers: [
                    {text: 'id', value: 'id', sortable: false},
                    {text: 'Lớp trong nhóm', value: 'nhomlop', sortable: false},
                    {text: 'Sỉ Số', value: 'siso'},
                    {text: 'Actions', value: 'Option', sortable: false, align: 'center'}
                ],
            };
        },
        created() {
            var _this = this;
            _this.isLoading = true;
            axios.get(_this.urlCurrent + '/api/hocky').then((rep) => {
                for (var hocky of rep.data) {
                    let hockyItem = {
                        id: hocky.id,
                        tenhocky: hocky.tenhocky + '-' + hocky.namhoc,
                        ngaybatdau: hocky.ngaybatdau,
                        ngayketthuc: hocky.ngayketthuc
                    }
                    _this.hockyList.push(hockyItem);
                }
                var ngayhientai =  Date.now();
                for (var hocky of this.hockyList){
                    var ngaybatdau = new Date(hocky.ngaybatdau).getTime();
                    var ngayketthuc = new Date(hocky.ngayketthuc).getTime();
                    if(ngaybatdau < ngayhientai && ngayhientai < ngayketthuc){
                        _this.selectedHocky = hocky.id;
                        break;
                    }
                }
                setTimeout(function () {
                    axios.get(_this.urlCurrent + '/api/nhomlop-hocky/' + _this.selectedHocky).then((rep) =>{
                        _this.isLoading = false;
                        _this.listLop = rep.data;
                    })
                },2000)

            }).catch(function (error) {
                    _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
            });
        },
        methods: {
            xacnhanxoa(item) {
                var _this = this;
                _this.selectedNhomlop = item;
                _this.dialog = true;
            },
            deleteItem(item, id) {
                let url = window.location.origin + '/api/nhomlop/' + id;
                axios.delete(url).then((rep) => {
                    const index = this.listLop.indexOf(item);
                    if (rep.data.error) {
                        this.error = rep.data.error;
                        setTimeout(() => {
                            this.error = "";
                        }, 5000);
                    }
                    else {
                        this.listLop.splice(index, 1);
                    }
                });
            },
            editItem(id) {
                this.$router.push({path: '/admin/lop/edit/' + id})
            },
            chooseHocky() {
                var _this = this;
                var hocky_id = '';
                _this.isLoading = true;
                _this.listLop = [];
                setTimeout(function () {
                    hocky_id = _this.selectedHocky.id;
                    setTimeout(function () {
                        axios.get(_this.urlCurrent + '/api/nhomlop-hocky/' + hocky_id).then((rep) => {
                            _this.isLoading = false;
                            _this.listLop = rep.data;
                        })
                    }, 1000)
                }, 1000)
            }
        },
        computed: {}
    }
</script>