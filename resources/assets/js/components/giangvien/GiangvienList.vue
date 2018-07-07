<template id="giangvien-list">
  <div class="row">
    <v-btn round color="error" class="pull-right" v-bind:to="{name: 'GiangvienAdd'}">
        <v-icon >add</v-icon>
        Thêm giảng viên mới
    </v-btn>
    <br>
      <v-alert :value="error" type="error" v-if="error != ''" style="margin-top: 20px">
          {{ error }}
      </v-alert>
    <br>
    <v-card>
      <v-card-title>
        <p class="display-1">Danh sách giảng viên</p>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table :headers="headers" :items="giangvienlist" :search="search" :loading="isLoading" :rows-per-page-items='[10, 20, 30, { text: "All", value: -1 }]'>
        <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.magiangvien }}</td>
          <td class="text-xs-left">{{ props.item.username }}</td>
          <td class="text-xs-left">{{ props.item.email }}</td>
          <td class="text-xs-left">{{ props.item.status == 0 ? 'Chưa kích hoạt' : 'Đã kích hoạt'}}</td>
          <td class="justify-center layout px-0">
            <v-btn icon class="mx-0" @click="editItem(props.item.id)" v-if="props.item.status == 0">
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
          <v-card-text>{{ selectedGiangvien.status == 1 ? 'Tài khoản này đã được kích hoạt. Bạn thực sự muốn xóa tài khoản này?' : 'Bạn có chắc chắn muốn xóa dữ liệu này?'}}</v-card-text>
          <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="green darken-1" flat @click.native="dialog = false">No</v-btn>
              <v-btn color="green darken-1" flat @click.native="deleteItem(selectedGiangvien, selectedGiangvien.id), dialog = false">Yes</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>

  </div>
</template>

<script>
export default {
  data:function(){
    return {
      isLoading: false,
      giangvien: '',
      search: '',
      dialog: false,
      error: '',
      selectedGiangvien: {},
      headers: [
        { text: 'Mã giảng viên', value: 'magiangvien', sortable: false },
        { text: 'Tên giảng viên', value: 'username', sortable: false },
        { text: 'Email', value: 'email', sortable: false },
        { text: 'Tình trạng', value: 'status', sortable: false },
        { text: 'Actions', value: 'name', sortable: false, align: 'center' }
      ],
      giangvienlist: []

    };
  },
  created: function() {
    var _this = this;
    _this.isLoading = true;
    let uri = location.origin+'/api/giangvien';
    Axios.get(uri).then((response) => {
      setTimeout(() => {
          _this.isLoading = false;
          this.giangvienlist = response.data;
      }, 2000);
    });
  },
  methods: {
    xacnhanxoa(item) {
      var _this = this;
      _this.selectedGiangvien = item;
      _this.dialog = true;
    },
    editItem (id) {
      this.$router.push({ path: `/admin/giangvien/edit/${id}` });
    },
    deleteItem (item,id) {
      Axios.delete(location.origin+'/api/giangvien/'+id).then((response) => {
        const index = this.giangvienlist.indexOf(item)
        if(response.data.error) {
            this.error = response.data.error;
            setTimeout(() => {
                this.error = "";
            }, 5000);
        }
        else 
          this.giangvienlist.splice(index, 1)
      });
    },
  },
  computed: {
    filteredgiangvien: function(){
      if(this.giangvienlist.length) {
        return this.giangvienlist;
      }
    },
  }
}
</script>