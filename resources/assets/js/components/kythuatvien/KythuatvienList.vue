<template id="kythuatvien-list">
  <div class="row">
    <v-btn class="pull-right" v-bind:to="{name: 'KythuatvienAdd'}">
      <!-- <router-link class="btn btn-xs btn-primary" v-bind:to="{name: 'kythuatvienAdd'}"> -->
        <span class="glyphicon glyphicon-plus"></span>
        Thêm kỹ thuật viên mới
      <!-- </router-link> -->
    </v-btn>

    </br></br>
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
      <v-data-table :headers="headers" :items="kythuatvienlist" :search="search">
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.id }}</td>
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
        <tr v-for="(kythuatvien, index) in filteredkythuatvien" :key="index">
          <td>{{ index + 1 }}</td>
          <td>{{ kythuatvien.tenkythuatvien }}</td>
          <td>{{ kythuatvien.namhoc }}</td>
          <td>{{ kythuatvien.ngaybatdau }}</td>
          <td>{{ kythuatvien.ngayketthuc }}</td>
        </tr>
      </tbody>
    </table> -->
  </div>
</template>

<script>
export default {
  data:function(){
    return {
      kythuatvien: '',
      search: '',
      headers: [
        { text: 'Mã kỹ thuật viên', value: 'ngaybatdau', sortable: false },
        { text: 'Tên kỹ thuật viên', value: 'tenkythuatvien', sortable: false },
        { text: 'Email', value: 'email', sortable: false },
        { text: 'Actions', value: 'name', sortable: false }
      ],
      kythuatvienlist: [
        // {
        //   id
        //   tenkythuatvien: 'Frozen Yogurt',
        //   namhoc: 159,
        //   ngaybatdau: 6.0,
        //   ngayketthuc: 24
        // }
      ]
    
    };
  },
  created: function() {
    let uri = location.origin+'/api/kythuatvien';
    Axios.get(uri).then((response) => {
      this.kythuatvienlist = response.data;
      console.log(this.kythuatvienlist);
    });
  },
  methods: {
    editItem (id) {
      let path = '/admin/kythuatvien/edit/'+id;
      let kythuatvien_id = id;
      this.$router.push({ path: `/admin/kythuatvien/edit/${kythuatvien_id}` });
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