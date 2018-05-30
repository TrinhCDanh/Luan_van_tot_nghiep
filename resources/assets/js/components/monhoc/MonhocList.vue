<template id="monhoc-list">
  <div class="row">
    <h1>Đây là trang môn học</h1>
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
              :headers="headers"
              :items="listMon"
              :search="search"
      >
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.id }}</td>
          <td class="text-xs-left">{{ props.item.tenmonhoc }}</td>
          <td class="text-xs-left">{{ props.item.ngaybatdau }}</td>
          <td class="text-xs-left">{{ props.item.ngayketthuc }}</td>
          <v-btn icon class="mx-0" @click="editItem(props.item)">
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
  data:function(){
    return {
        search: '',
        headers: [
            { text: 'id', value: 'id' },
            { text: 'Tên môn học', value: 'Tên MH' },
            { text: 'Ngày bắt đầu ', value: 'Ngày bắt đầu' },
            { text: 'Ngày kết thúc ', value: 'Ngày kết thúc' },
            { text: 'Option',value:'Option'}
        ],
        listMon:[],
        // editItem (item) {
        //     this.editedIndex = this.listMon.indexOf(item)
        //     this.editedItem = Object.assign({}, item)
        //     this.dialog = true
        // },

        deleteItem (item,id) {
            let url = location.origin + '/api/monhoc/';
            // const index = this.listMon.indexOf(item,id)
            axios.delete(url+id).then((rep) => {
                const index = this.listMon.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.listMon.splice(index, 1); //xoa db
            });
             //confirm('Are you sure you want to delete this item?') && this.listMon.splice(index, 1)
        },

    }
  },
  created() {
       let url = location.origin + '/api/monhoc/';
       axios.get(url).then((rep) => {
         this.listMon = rep.data;
           console.log(this.listMon);
       });

  },
  methods: {

  },
  computed: {

  },
    mounted() {
        console.log(location.origin);
    }
}
</script>