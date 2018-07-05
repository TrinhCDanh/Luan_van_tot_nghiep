<template id="may-list">
    <div class="row">
        <v-card>
            <v-card-title>
                <p class="display-1">Danh sách máy của phòng máy {{ tenPhongMay }}</p>
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="maylist" :search="search">
                <template slot="items" slot-scope="props">
                    <td class="text-xs-left">{{ props.item.sothutumay }}</td>
                    <td class="justify-center layout px-0">
                        <v-btn icon class="mx-0" @click="deleteItem(props.item, props.item.id)">
                            <v-icon color="pink">delete</v-icon>
                        </v-btn>
                    </td>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Your search for "{{ search }}" found no results.
                </v-alert>
            </v-data-table>
        </v-card>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                may: '',
                search: '',
                headers: [
                    {text: 'Tên/STT máy', value: 'sothutumay', sortable: false},
                    {text: 'Actions', value: 'name', sortable: false}
                ],
                maylist: [],
                tenPhongMay: '',
            };
        },
        created: function () {
            var _this = this;
            let urlCurrent = window.location.href;
            let phongmay_id = urlCurrent.slice(urlCurrent.lastIndexOf('may/') + 4, urlCurrent.length);
            let uri = location.origin + '/api/phongmay-have-may/' + phongmay_id;
            Axios.get(uri).then((response) => {
                this.maylist = response.data;
            });
            _this.fetchData();
        },
        methods: {
            fetchData() {
                var _this = this;
                let urlCurrentHref = window.location.href;
                let id = urlCurrentHref.slice(urlCurrentHref.lastIndexOf('may/') + 4,urlCurrentHref.length);
                let url = location.origin + '/api/ten-phongmay/' + id;
                axios.get(url).then((response) => {
                    this.tenPhongMay = response.data[0].tenphongmay;
                }).catch(function () {
                    return 'Loi'
                });
            },
            deleteItem(item, id) {
                // Axios.delete(location.origin+'/api/may/'+id).then((response) => {
                //   const index = this.maylist.indexOf(item)
                //   this.maylist.splice(index, 1)
                // })
                Axios.delete(location.origin + '/api/may/' + item.slug).then((response) => {
                    const index = this.maylist.indexOf(item)
                    this.maylist.splice(index, 1)
                });
                ;
                // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') &&
            },

        },
        computed: {
            filteredmay: function () {
                if (this.maylist.length) {
                    return this.maylist;
                }
            },
        },
        mounted(){

        }
    }
</script>