<template id="tinthrangmay-list">
  <div class="row">
    <v-btn class="pull-right" v-bind:to="{name: 'TinhtrangAdd'}">
        <span class="glyphicon glyphicon-plus"></span>
        Ghi nhận tình trạng
    </v-btn>

    </br></br>
    <v-card>
      <v-card-title>
        <p class="display-1">Lịch sử ghi nhận của máy</p>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table :headers="headers" :items="tinhtrangmaylist" :search="search" :rows-per-page-items="[10,20]" :loading="isLoading">
        <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.ngayghinhan }}</td>
          <td class="text-xs-left" v-if="props.item.tenkythuatvien != null">KTV: {{ props.item.tenkythuatvien }}</td>
          <td class="text-xs-left" v-else>GV: {{ props.item.tengiangvien }}</td>
          <td class="text-xs-left" v-if="props.item.mota_kythuatvien != null">{{ props.item.mota_kythuatvien }}</td>
          <td class="text-xs-left" v-else>{{ props.item.mota_giangvien }}</td>
          <td class="justify-center layout px-0">
            <v-btn icon class="mx-0" @click="viewItem(props.item.id)">
              <v-icon color="teal">visibility</v-icon>
            </v-btn>
            <v-dialog v-model="dialog" persistent max-width="290">
              <v-btn slot="activator" icon><v-icon color="pink">delete</v-icon></v-btn>
              <v-card>
                <v-card-title class="headline">Are you sure?</v-card-title>
                <v-card-text>Bạn có chắc chắn muốn xóa dòng lịch sử này?</v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="green darken-1" flat @click="deleteItem(props.item, props.item.id), dialog = false">Yes</v-btn>
                  <v-btn color="green darken-1" flat @click.native="dialog = false">No</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
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
      may_slug: '',
      onlyOneEdit: 0,
      dialog: false,
      headers: [
        { text: 'Ngày ghi nhận', value: 'ngaybatdau', sortable: false },
        { text: 'Tên người ghi nhận', value: 'tenkythuatvien', sortable: false },
        { text: 'Nội dung ghi nhận', value: 'mota', sortable: false, width: 500 },
        // { text: 'Tên giảng viên', value: 'tengiangvien', sortable: false },
        { text: 'Actions', value: 'name', sortable: false, align: 'center' }
      ],
      tinhtrangmaylist: [

      ]

    };
  },
  created: function() {
    var _this = this;
    let urlfullCurrent = window.location.href;

    _this.isLoading = true;

    _this.may_slug = urlfullCurrent.slice(urlfullCurrent.lastIndexOf('tinhtrangmay/') + 13 , urlfullCurrent.length);

    let uri = location.origin+'/api/tinhtrang-may-list/' + _this.may_slug;
    Axios.get(uri).then((response) => {
      setTimeout(() => {
          _this.isLoading = false;
          _this.tinhtrangmaylist = response.data;
          console.log( _this.tinhtrangmaylist);
      }, 2000);
    });
  },
  methods: {
    // editItem (id) {
    //   this.$router.push({ path: `/kythuatvien/tinhtrangmay/${this.may_slug}/edit/${id}` });
    // },
    viewItem (id) {
      this.$router.push({ path: `/admin/tinhtrangmay/${this.may_slug}/view/${id}` });
    },
    deleteItem (item,id) {
      Axios.delete(location.origin+'/api/tinhtrangmay/'+id).then((response) => {
        const index = this.tinhtrangmaylist.indexOf(item)
        this.tinhtrangmaylist.splice(index, 1)
      });
      // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') &&
    },
    // editInDay(ngayghinhan) {

    //   var ngayhientai = Date.now();

    //   var todayStart = new Date();
    //   todayStart.setHours(0,0,0,0);

    //   var todayEnd = new Date();
    //   todayEnd.setHours(23,59,59,999);

    //   var ngayghinhan = new Date(ngayghinhan).getTime();
    //   if(ngayghinhan > todayStart && ngayghinhan < todayEnd) return true;
    //   else return false;

    // }
  },
  computed: {
    filteredkythuatvien: function(){
      if(this.tinhtrangmaylist.length) {
        return this.tinhtrangmaylist;
      }
    },
  }
}
</script>