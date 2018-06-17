<template id="may-list-status">
  <div class="row">
    <!-- </br></br> -->
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
      <v-data-table :headers="headers" :items="maylist" :search="search" :rows-per-page-items="[10,20]" :loading="isLoading">
        <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>>
        <template slot="items" slot-scope="props">
          <td class="text-xs-left">{{ props.item.sothutumay }}</td>
          <td class="text-xs-left">{{ props.item.tinhtrang == 0 ? 'Tốt' : 'Gặp vấn đề' }}</td>
          <td class="justify-center layout px-0">
            <v-btn icon class="mx-0" @click="goListTinhtrangmay(props.item.id, props.item.slug)">
              <v-icon color="pink">edit</v-icon>
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
    var _this = this;
    let urlCurrent = window.location.href;

    _this.isLoading = true;

    _this.phongmay_id = urlCurrent.slice(urlCurrent.lastIndexOf('may/') + 4 , urlCurrent.length);
    let uri = location.origin+'/api/phongmay-have-may/' + _this.phongmay_id;
    Axios.get(uri).then((response) => {
      setTimeout(() => {
          _this.isLoading = false;
          _this.maylist = response.data;
      }, 2000);
    });
  },
  methods: {
    goListTinhtrangmay(may_id, may_slug) {
      this.$router.push({ path: `/kythuatvien/tinhtrangmay/${may_slug}` });
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