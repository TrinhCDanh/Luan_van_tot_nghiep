<template id="kythuatvien-list">
  <div class="row">
    <v-btn round color="error" class="pull-right" v-bind:to="{name: 'KythuatvienAdd'}">
        <v-icon >add</v-icon>
        Thêm kỹ thuật viên mới
    </v-btn>

    <br><br>
    <v-card>
      <v-card-title>
        <p class="display-1">Danh sách kỹ thuật viên</p>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table :headers="headers" :items="kythuatvienlist" :search="search" :loading="isLoading">
        <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.makythuatvien }}</td>
          <td class="text-xs-left">{{ props.item.name }}</td>
          <td class="text-xs-left">{{ props.item.email }}</td>
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
  </div>
</template>

<script>
export default {
  data:function(){
    return {
      isLoading: false,
      kythuatvien: '',
      search: '',
      headers: [
        { text: 'Mã kỹ thuật viên', value: 'ngaybatdau', sortable: false },
        { text: 'Tên kỹ thuật viên', value: 'tenkythuatvien', sortable: false },
        { text: 'Email', value: 'email', sortable: false },
        { text: 'Actions', value: 'name', sortable: false }
      ],
      kythuatvienlist: [

      ]

    };
  },
  created: function() {
    var _this = this;
    _this.isLoading = true;
    let uri = location.origin+'/api/kythuatvien';
    Axios.get(uri).then((response) => {
      setTimeout(() => {
          _this.isLoading = false;
          this.kythuatvienlist = response.data;
      }, 2000);
    });
  },
  methods: {
    editItem (id) {
      this.$router.push({ path: `/admin/kythuatvien/edit/${id}` });
    },

    deleteItem (item,id) {
      Axios.delete(location.origin+'/api/kythuatvien/'+id).then((response) => {
        const index = this.kythuatvienlist.indexOf(item)
        this.kythuatvienlist.splice(index, 1)
      });
      // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') &&
    },
  },
  computed: {
    filteredkythuatvien: function(){
      if(this.kythuatvienlist.length) {
        return this.kythuatvienlist;
      }
    },
  }
}
</script>