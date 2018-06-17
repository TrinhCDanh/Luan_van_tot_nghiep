<template>
    <v-toolbar
      color="indigo "
      dark
      app
      :clipped-left="$vuetify.breakpoint.mdAndUp"
      fixed
    >
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Trung tâm máy tính - Kỹ thuật viên</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon v-bind:to="{name: 'Home'}">
          <v-icon color="white">home</v-icon>
      </v-btn>
      <v-btn icon v-bind:to="{name: 'MayPhongmayList'}">
          <v-icon color="white">desktop_windows</v-icon>
      </v-btn>
      <v-dialog v-model="dialog" persistent max-width="290">
        <v-btn slot="activator" icon><v-icon color="white">power_settings_new</v-icon></v-btn>
        <v-card>
          <v-card-title class="headline">Are you sure?</v-card-title>
          <v-card-text>Bạn có chắc chắn muốn thoát khỏi phiên làm việc?</v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" flat @click="logout(), dialog = false">Yes</v-btn>
            <v-btn color="green darken-1" flat @click.native="dialog = false">No</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-menu bottom left>
        <v-btn slot="activator" icon large v-bind:to="{ name: 'TaikhoanEdit' }">
          <v-avatar size="32px" tile>
            <img
              class="avatar"
              :src="image"
              alt="Vuetify"
            >
          </v-avatar>
        </v-btn>
      </v-menu>
    </v-toolbar>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: "layout-header",
        data() {
            return {
                urlCurrent: location.origin,
                kythuatvien_current_id: sessionStorage.getItem('kythuatvien_id'),
                image: 'https://vuetifyjs.com/static/doc-images/logo.svg',
                dialog: false,
                drawer: null,
                menuitems: [
                  { title: 'Đăng xuất' },
                  { title: 'Click Me', func: 'test()' },
                  { title: 'Click Me' },
                  { title: 'Click Me 2' }
                ]
            }
        },
        methods: {
          logout() {
            window.open(this.urlCurrent + '/kythuatvien/logout', '_self');
          },
          onToggleSidebar (event) {
            this.$emit('clickedToggleSidebar');
          },
          test() {
            alert('hello');
          }
        },
        mounted() {
        },
        created: function() {
          var _this = this;
          let uri = location.origin+'/api/kythuatvien/'+ _this.kythuatvien_current_id + '/edit';
          Axios.get(uri).then((response) => {
            if(response.data.image) {
              _this.image = _this.urlCurrent + '/images/' + response.data.image;
            }
          });
        }
    };
</script>

<style scope>
  .avatar {
    border-radius: 50%!important;
    width: 100%!important;
    height: 100%!important;
  }
</style>

