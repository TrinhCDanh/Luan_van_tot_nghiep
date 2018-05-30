<template id="may-list-status">
  <div class="row">
    <v-btn class="pull-right" v-on:click="addItem()">
      <!-- <router-link class="btn btn-xs btn-primary" v-bind:to="{name: 'HockyAdd'}"> -->
        <span class="glyphicon glyphicon-plus"></span>
        Thêm máy mới
      <!-- </router-link> -->
    </v-btn>

    </br></br>
    <v-card>
      <v-card-title>
        <p class="display-1">Danh sách máy của phòng máy </p>
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
          <td class="text-xs-left">{{ props.item.tinhtrang == 0 ? 'Tốt' : 'Gặp vấn đề' }}</td>
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
  data:function(){
    return {
      may: '',
      search: '',
      phongmay_id: '',
      headers: [
        { text: 'Tên/STT máy', value: 'sothutumay', sortable: false },
        { text: 'Tình trạng máy', value: 'tinhtrang', sortable: false},
        { text: 'Actions', value: 'name', sortable: false }
      ],
      maylist: []
    };
  },
  created: function() {
    let urlCurrent = window.location.href;
    this.phongmay_id = urlCurrent.slice(urlCurrent.lastIndexOf('may/') + 4 , urlCurrent.length);
    let uri = location.origin+'/api/phongmay-have-may/' + this.phongmay_id;
    Axios.get(uri).then((response) => {
      this.maylist = response.data;
      console.log(this.maylist);
    });
  },
  methods: {

    addItem() {
      // Axios.post(location.origin + '/api/may', this.phongmay_id).then((response) => {
          // this.$router.push({name: 'HockyList'})
          // console.log(response.data);
          //let lastMay = this.maylist.lastIndexOf(item);
          let lastIndex = this.maylist.length - 1;
          let nextIndex = this.maylist[lastIndex].sothutumay + 1;
          let newItem = {
            id: nextIndex,
            sothutumay: nextIndex,
            tinhtrang: 0,
            phongmay_id: this.phongmay_id
          }
          this.maylist.push(newItem);
       // })
    },

    deleteItem (item,id) {
      Axios.delete(location.origin+'/api/may/'+id).then((response) => {
        const index = this.maylist.indexOf(item)
        this.maylist.splice(index, 1)
      });
      // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') && 
    }

  },
  computed: {
    filteredmay: function(){
      if(this.maylist.length) {
        return this.maylist;
      }
    },    
  }
}
</script>