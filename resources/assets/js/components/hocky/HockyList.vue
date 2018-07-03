<template id="hocky-list">
    <div class="row">
        <v-btn round color="error" class="pull-right" v-bind:to="{name: 'HockyAdd'}">
            <v-icon>add</v-icon>
            Thêm thông tin học kỳ mới
        </v-btn>
        </br></br>
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
            <v-data-table v-bind:pagination.sync="pagination"
                          :headers="headers" :items="hockylist" :search="search" :loading="isLoading" sort-field="field" sort-desc="false">
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
        <!-- <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Học kỳ</th>
              <th>Năm học</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(hocky, index) in filteredhocky" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ hocky.tenhocky }}</td>
              <td>{{ hocky.namhoc }}</td>
              <td>{{ hocky.ngaybatdau }}</td>
              <td>{{ hocky.ngayketthuc }}</td>
            </tr>
          </tbody>
        </table> -->
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                pagination : {'sortBy': 'column1', 'descending': true, 'rowsPerPage': -1},
                search: '',
                isLoading: false,
                headers: [
                    {text: 'Tên học kỳ', value: 'tenhocky'},
                    {text: 'Năm học', value: 'namhoc'},
                    {text: 'Ngày bắt đầu', value: 'ngaybatdau'},
                    {text: 'Ngày kết thúc', value: 'ngayketthuc'},
                    {text: 'Actions', value: 'name', align: 'center'}
                ],
                hockylist: [
                    // {
                    //   id
                    //   tenhocky: 'Frozen Yogurt',
                    //   namhoc: 159,
                    //   ngaybatdau: 6.0,
                    //   ngayketthuc: 24
                    // }
                ],


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

            deleteItem(item, id) {
                var xacnhanxoa = confirm('Bạn muốn xóa học kỳ ' + item.namhoc);
                if (xacnhanxoa){
                    Axios.delete(location.origin + '/api/hocky/' + id).then((rep) => {
                        const  index = this.hockylist.indexOf(item)
                        this.hockylist.splice(index,1)
                    });
                }

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