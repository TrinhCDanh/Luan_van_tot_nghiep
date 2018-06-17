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
      <v-btn icon>
        <v-icon>apps</v-icon>
      </v-btn>
      <v-btn icon href="https://vuetifyjs.com/en/components/menus">
          <v-icon>notifications</v-icon>
      </v-btn>
      <v-menu bottom left>
          <v-btn slot="activator" icon large>
            <v-avatar size="32px" tile>
              <img
                src="https://vuetifyjs.com/static/doc-images/logo.svg"
                alt="Vuetify"
              >
            </v-avatar>
          </v-btn>
          <v-list>
            <v-list-tile v-for="(item, i) in menuitems" :key="i" @click="test(item.action)">
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile>
          </v-list>
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
                dialog: false,
                drawer: null,
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
          }
        },
        mounted() {
        }
    };
</script>
