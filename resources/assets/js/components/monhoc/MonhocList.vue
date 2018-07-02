<template id="monhoc-list">
    <div class="row">
        <v-btn round color="error" class="pull-right" v-bind:to="{name: 'MonhocAdd'}">
            <v-icon>add</v-icon>
            Thêm thông tin môn học mới
        </v-btn>
        <br><br>
        <v-card>
            <v-card-title>
                Nutrition
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    :headers="headers" :items="listMon" :search="search" :loading="isLoading">
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <td class="text-xs-left">{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.tenmonhoc }}</td>
                    <td class="text-xs-left">{{ props.item.ngaybatdau }}</td>
                    <td class="text-xs-left">{{ props.item.ngayketthuc }}</td>
                    <v-btn icon class="mx-0" @click="editItem(props.item.id)">
                        <v-icon color="teal">edit</v-icon>
                    </v-btn>
                    <v-btn icon class="mx-0" @click="deleteItem(props.item,props.item.id)">
                        <v-icon color="pink">delete</v-icon>
                    </v-btn>
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
                search: '',
                isLoading: false,
                headers: [
                    {text: 'id', value: 'id'},
                    {text: 'Tên môn học', value: 'Tên MH'},
                    {text: 'Ngày bắt đầu ', value: 'Ngày bắt đầu'},
                    {text: 'Ngày kết thúc ', value: 'Ngày kết thúc'},
                    {text: 'Option', value: 'Option'}
                ],
                listMon: [],
                // editItem (item) {
                //     this.editedIndex = this.listMon.indexOf(item)
                //     this.editedItem = Object.assign({}, item)
                //     this.dialog = true
                // },


                /*
                  Do đặt comfirm trong then() thì sau khi axios có chọn yes hay no gì nó cũng xóa pt trong csdl,
                  tại vì khi đặt confirm nằm trong then() có nghĩa là sau khi axiod gửi đi yêu cầu cho server thì server sẽ
                  xóa phần tử ở trong csdl đi và sẽ phản hồi lại respone .
                  then() có nghĩa là sau khi nhận respone thì nó sẽ làm gì tiếp theo đặt comfirm trong thì lúc đó nó đã xóa
                  xong rồi nó mới hỏi là có xóa hay ko
                */

                //confirm('Are you sure you want to delete this item?') && this.listMon.splice(index, 1)

            }
        },
        created() {
            var _this = this;
            _this.isLoading = true;
            let url = location.origin + '/api/monhoc/';
            axios.get(url).then((rep) => {
               setTimeout(() =>{
                   _this.isLoading = false;
                   this.listMon = rep.data;
               },2000)
            })
        },
        methods: {
             deleteItem (item,id) {
                 let url = location.origin + '/api/monhoc/';
                 var xacnhanxoa = confirm('Are you sure you want to delete this item?');
                 if(xacnhanxoa){
                     axios.delete(url + id).then((rep) =>{
                         const index = this.listMon.indexOf(item);
                         this.listMon.splice(index);
                     });
                 }
             },
              editItem (id) {
                 // tai sao khong de dc  router name
                    this.$router.push({ path: `/admin/monhoc/edit/`+ id });
                },

        },
        computed: {},
        mounted() {

        }
    }
</script>