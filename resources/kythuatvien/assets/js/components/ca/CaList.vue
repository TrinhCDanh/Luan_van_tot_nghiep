<template id="ca-list">
  <div class="row">
    <v-btn class="pull-right" v-bind:to="{name: 'CaAdd'}">
      <!-- <router-link class="btn btn-xs btn-primary" v-bind:to="{name: 'caAdd'}"> -->
        <span class="glyphicon glyphicon-plus"></span>
        Thêm thông tin ca
      <!-- </router-link> -->
    </v-btn>

    </br></br>
    <v-card>
      <v-card-title>
        <p class="display-1">Danh sách ca</p>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table :headers="headers" :items="calist" :search="search">
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.tenca }}</td>
          <td class="text-xs-left">{{ props.item.tietso }}</td>
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
      ca: '',
      search: '',
      headers: [
        { text: 'Tên ca', value: 'tenca', sortable: false },
        { text: 'Tiết số', value: 'tietso', sortable: false  },
        { text: 'Actions', value: 'name', sortable: false }
      ],
      calist: [
      ]
    };
  },
  created: function() {
    let uri = location.origin+'/api/ca';
    Axios.get(uri).then((response) => {
      this.calist = response.data;
    });
  },
  methods: {
    editItem (id) {
      let path = '/admin/ca/edit/'+id;
      let ca_id = id;
      this.$router.push({ path: `/admin/ca/edit/${ca_id}` });
    },

    deleteItem (item,id) {
      Axios.delete(location.origin+'/api/ca/'+id).then((response) => {
        const index = this.calist.indexOf(item)
        this.calist.splice(index, 1)
      });
      // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') && 
    },
  },
  computed: {
    filteredca: function(){
      if(this.calist.length) {
        return this.calist;
      }
    },    
  }
}
</script>