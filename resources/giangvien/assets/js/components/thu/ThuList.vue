<template id="thu-list">
  <div class="row">
    <v-btn class="pull-right" v-bind:to="{name: 'ThuAdd'}">
      <!-- <router-link class="btn btn-xs btn-primary" v-bind:to="{name: 'thuAdd'}"> -->
        <span class="glyphicon glyphicon-plus"></span>
        Thêm thông tin thứ
      <!-- </router-link> -->
    </v-btn>

    </br></br>
    <v-card>
      <v-card-title>
        <p class="display-1">Danh sách thứ</p>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table :headers="headers" :items="thulist" :search="search">
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.tenthu }}</td>
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
      thu: '',
      search: '',
      headers: [
        { text: 'Tên thứ', value: 'tenthu', sortable: false },
        { text: 'Actions', value: 'name', sortable: false }
      ],
      thulist: [
      ]
    };
  },
  created: function() {
    let uri = location.origin+'/api/thu';
    Axios.get(uri).then((response) => {
      this.thulist = response.data;
    });
  },
  methods: {
    editItem (id) {
      let path = '/admin/thu/edit/'+id;
      let thu_id = id;
      this.$router.push({ path: `/admin/thu/edit/${thu_id}` });
    },

    deleteItem (item,id) {
      Axios.delete(location.origin+'/api/thu/'+id).then((response) => {
        const index = this.thulist.indexOf(item)
        this.thulist.splice(index, 1)
      });
      // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') && 
    },
  },
  computed: {
    filteredthu: function(){
      if(this.thulist.length) {
        return this.thulist;
      }
    },    
  }
}
</script>