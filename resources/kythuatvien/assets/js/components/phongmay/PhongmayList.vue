<template id="phongmay-list">
  <div class="row">
    <v-btn class="pull-right" v-bind:to="{name: 'PhongmayAdd'}">
      <!-- <router-link class="btn btn-xs btn-primary" v-bind:to="{name: 'phongmayAdd'}"> -->
        <span class="glyphicon glyphicon-plus"></span>
        Thêm thông tin phòng máy
      <!-- </router-link> -->
    </v-btn>

    </br></br>
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
      <v-data-table :headers="headers" :items="phongmaylist" :search="search">
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.tenphongmay }}</td>
          <td class="text-xs-left">{{ props.item.soluongmay }}</td>
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
      phongmay: '',
      search: '',
      headers: [
        { text: 'Tên phòng máy', value: 'tenphongmay', sortable: false },
        { text: 'Số lượng máy', value: 'soluongmay', sortable: false  },
        { text: 'Actions', value: 'name', sortable: false }
      ],
      phongmaylist: [
      ]
    };
  },
  created: function() {
    let uri = location.origin+'/api/phongmay';
    Axios.get(uri).then((response) => {
      this.phongmaylist = response.data;
    });
  },
  methods: {
    editItem (id) {
      let path = '/admin/phongmay/edit/'+id;
      let phongmay_id = id;
      this.$router.push({ path: `/admin/phongmay/edit/${phongmay_id}` });
    },

    deleteItem (item,id) {
      Axios.delete(location.origin+'/api/phongmay/'+id).then((response) => {
        const index = this.phongmaylist.indexOf(item)
        this.phongmaylist.splice(index, 1)
      });
      // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') && 
    },
  },
  computed: {
    filteredphongmay: function(){
      if(this.phongmaylist.length) {
        return this.phongmaylist;
      }
    },    
  }
}
</script>