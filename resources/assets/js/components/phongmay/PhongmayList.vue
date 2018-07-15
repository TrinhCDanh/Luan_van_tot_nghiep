<template id="phongmay-list">
    <div class="row">
        <v-btn round color="error" class="pull-right" v-bind:to="{name: 'PhongmayAdd'}">
            <v-icon>add</v-icon>
            Thêm thông tin phòng máy
        </v-btn>
        <br>
        <v-alert :value="error" type="error" v-if="error != ''" style="margin-top: 20px">
            {{ error }}
        </v-alert>
        <br>
        <v-card>
            <v-card-title>
                <p class="display-1">Danh sách phòng máy</p>
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="phongmaylist" :search="search" :loading="isLoading"
                          :rows-per-page-items='[10, 20, 30, { text: "All", value: -1 }]'>
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <td class="text-xs-left">{{ props.item.tenphongmay }}</td>
                    <td class="text-xs-left">{{ props.item.soluongmay }}</td>
                    <td class="justify-center layout px-0">
                        <v-btn icon class="mx-0" @click="editItem(props.item.id)">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0"  v-if="props.index == phongmaylist.length - 1" @click="xacnhanxoa(props.item)">
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
                               @click.native="deleteItem(selectedPhongmay, selectedPhongmay.id), dialog = false">Yes
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
                phongmay: '',
                search: '',
                isLoading: false,
                dialog: false,
                error: '',
                headers: [
                    {text: 'Tên phòng máy', value: 'tenphongmay', sortable: false},
                    {text: 'Số lượng máy', value: 'soluongmay', sortable: false},
                    {text: 'Actions', value: 'name', sortable: false, align: 'center'}
                ],
                phongmaylist: [],
                selectedPhongmay: ''
            };
        },
        created: function () {
            var _this = this;
            _this.isLoading = true;
            var url = location.origin + '/api/phongmay';
            setTimeout(() => {
                axios.get(url).then((rep) => {
                    _this.isLoading = false;
                    _this.phongmaylist = rep.data;
                })
            })
        },
        methods: {
            xacnhanxoa(item) {
                var _this = this;
                _this.selectedPhongmay = item;
                _this.dialog = true;
            },
            editItem(id) {
                this.$router.push({path: `/admin/phongmay/edit/` + id});
            },
            deleteItem(item, id) {
                axios.delete(location.origin + '/api/phongmay/' + id).then((rep) => {
                    const index = this.phongmaylist.indexOf(item);
                    if (rep.data.error) {
                        this.error = rep.data.error;
                        setTimeout(() =>{
                            this.error = '';
                        },5000)
                    } else {
                        this.phongmaylist.splice(index, 1);
                    }
                })
            },
        },
        computed: {
            filteredphongmay: function () {
                if (this.phongmaylist.length) {
                    return this.phongmaylist;
                }
            },
        }
    }
</script>