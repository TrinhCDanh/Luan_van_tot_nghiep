<template id="hocky-list">
    <div class="row">
        <v-btn round color="error" class="pull-right" v-bind:to="{name: 'HockyAdd'}">
            <v-icon>add</v-icon>
            Thêm thông tin học kỳ mới
        </v-btn>
        <br>
        <v-alert :value="error" type="error" v-if="error != ''" style="margin-top: 20px">
            {{ error }}
        </v-alert>
        <br>
        <v-card>
            <v-card-title>
                <p class="display-1">Danh sách học kỳ</p>
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="hockylist" :search="search" :loading="isLoading" :rows-per-page-items='[10, 20, 30, { text: "All", value: -1 }]'>
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <td class="text-xs-left">{{ props.item.tenhocky }}</td>
                    <td class="text-xs-left">{{ props.item.namhoc }}</td>
                    <td class="text-xs-left">{{ props.item.ngaybatdau }}</td>
                    <td class="text-xs-left">{{ props.item.ngayketthuc }}</td>
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
                    <v-btn color="green darken-1" flat @click.native="deleteItem(selectedHocky, selectedHocky.id), dialog = false">Yes</v-btn>
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
                search: '',
                isLoading: false,
                dialog: false,
                error: '',
                headers: [
                    {text: 'Tên học kỳ', value: 'tenhocky', sortable: false},
                    {text: 'Năm học', value: 'namhoc', sortable: false},
                    {text: 'Ngày bắt đầu', value: 'ngaybatdau', sortable: false},
                    {text: 'Ngày kết thúc', value: 'ngayketthuc', sortable: false},
                    {text: 'Actions', value: 'name', sortable: false, align: 'center'}
                ],
                hockylist: [],
                selectedHocky: {}
            };
        },
        created: function () {
            var _this = this;
            _this.isLoading = true;
            let url = location.origin + '/api/hocky';
            _this.isLoading = true;
            axios.get(url).then((rep) => {
                setTimeout(() =>{
                    _this.isLoading = false;
                    this.hockylist = rep.data;
                },1500)

            });
        },
        methods: {
            editItem(id) {
                let path = '/admin/hocky/edit/' + id;
                let hocky_id = id;
                this.$router.push({path: `/admin/hocky/edit/${hocky_id}`});
            },

            xacnhanxoa(item) {
                var _this = this;
                _this.selectedHocky = item;
                _this.dialog = true;
            },

            deleteItem(item, id) {
                console.log(id);
                Axios.delete(location.origin + '/api/hocky/' + id).then((rep) => {
                    const  index = this.hockylist.indexOf(item)
                    if(rep.data.error) {
                        this.error = rep.data.error;
                        setTimeout(() => {
                            this.error = "";
                        }, 5000);
                    }
                    else {
                        this.hockylist.splice(index,1);
                    }
                });
            },
        },
        computed: {
            // filteredhocky: function () {
            //     if (this.hockylist.length) {
            //         return this.hockylist;
            //     }
            // },
        }
    }
</script>