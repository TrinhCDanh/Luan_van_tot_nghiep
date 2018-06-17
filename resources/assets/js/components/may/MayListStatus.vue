<template id="may-list-status">
  <div class="row">
    <v-btn class="pull-right" v-on:click="addItem()">
        <span class="glyphicon glyphicon-plus"></span>
        Thêm máy mới
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
            <v-btn icon class="mx-0" @click="goListTinhtrangmay(props.item.id, props.item.slug)">
              <v-icon color="teal">visibility</v-icon>
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
        // this.$router.push({name: 'HockyList'})
        // console.log(response.data);
        //let lastMay = this.maylist.lastIndexOf(item);
        let lastIndex = this.maylist.length - 1;
        let sothutumayPrev = this.maylist[lastIndex].sothutumay;
        console.log(sothutumayPrev);

        let sothutumayNextArr = sothutumayPrev.split("_");
        //sothutumayPrev.slice(sothutumayPrev.lastIndexOf('_') + 1 , sothutumayPrev.length);
        let test = parseInt(sothutumayNextArr[1]) + 1;

        let sothutumayNext = sothutumayNextArr[0] + "_" + ('0' + test).slice(-2) ;

        let slugNext = sothutumayNextArr[0].toLowerCase() + "-" + ('0' + test).slice(-2);
        console.log(slugNext);

        let newItem = {
          sothutumay: sothutumayNext,
          phongmay_id: this.phongmay_id,
          tinhtrang: 0,
          slug: slugNext
        }

        Axios.post(location.origin + '/api/may', newItem).then((response) => {
            this.maylist.push(newItem);
        });
    },

    deleteItem (item,id) {
      console.log(item.slug);
      Axios.delete(location.origin+'/api/may/'+item.slug).then((response) => {
        const index = this.maylist.indexOf(item)
        this.maylist.splice(index, 1)
      });
      // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') &&
    },

    goListTinhtrangmay(may_id, may_slug) {
      this.$router.push({ path: `/admin/tinhtrangmay/${may_slug}` });
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