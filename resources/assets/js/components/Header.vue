<template>
    <v-toolbar
      color="blue darken-3"
      dark
      app
      :clipped-left="$vuetify.breakpoint.mdAndUp"
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click="onToggleSidebar()"></v-toolbar-side-icon>
        <span class="hidden-sm-and-down">Trung tâm máy tính</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
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
                dialog: false,
                drawer: null,
                image: 'https://vuetifyjs.com/static/doc-images/logo.svg',
                menuitems: [
                  { title: 'Đăng xuất', action: 'logout' },
                  { title: 'Click Me' , action: 'gohome'},
                  { title: 'Click Me' },
                  { title: 'Click Me 2' }
                ]
            }
        },
        methods: {
          onToggleSidebar (event) {
            this.$emit('clickedToggleSidebar');
          },
          test(action) {
            if(action == 'logout')
              alert(action);
            if(action == 'gohome')
              console.log(action);
          },
          logout() {
            window.open(this.urlCurrent + '/admin/logout', '_self');
          }
        },
        mounted() {
        }
    };
</script>
