<template>
    <div>
        <v-navigation-drawer
          fixed
          :clipped="$vuetify.breakpoint.mdAndUp"
          app
          v-model="drawer"
        >
          <v-list dense>
            <template v-for="item in items">
              <v-layout
                row
                v-if="item.heading"
                align-center
                :key="item.heading"
              >
                <v-flex xs6>
                  <v-subheader v-if="item.heading">
                    {{ item.heading }}
                  </v-subheader>
                </v-flex>
                <v-flex xs6 class="text-xs-center">
                  <a href="#!" class="body-2 black--text">EDIT</a>
                </v-flex>
              </v-layout>
              <v-list-group
                v-else-if="item.children"
                v-model="item.model"
                :key="item.text"
                :prepend-icon="item.model ? item.icon : item['icon-alt']"
                append-icon=""
              >
                <v-list-tile slot="activator">
                  <v-list-tile-content>
                    <v-list-tile-title>
                      {{ item.text }}
                    </v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile
                  v-for="(child, i) in item.children"
                  :key="i"
                  @click=""
                >
                  <v-list-tile-action v-if="child.icon">
                    <v-icon>{{ child.icon }}</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>
                      {{ child.text }}
                    </v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list-group>
              <v-list-tile v-else @click="" :key="item.text" :to="{name: item.path}">
                <v-list-tile-action>
                  <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title>
                    {{ item.text }}
                  </v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </template>
          </v-list>
        </v-navigation-drawer>
        <LayoutHeader @clickedToggleSidebar="onToggleSidebar()"></LayoutHeader>
    </div>
</template>
<script>
    import LayoutHeader from "../components/Header"
    import Vue from 'vue'
    import axios from 'axios'
    import VueRouter from 'vue-router'
    export default {
        name: "layout-sidebar",
        components: {
          LayoutHeader
        },
        data() {
            return {
                dialog: false,
                drawer: null,
                items: [
                    { icon: 'dashboard', text: 'Trang chủ', path: 'Home' },
                    { icon: 'chrome_reader_mode', text: 'Quản lý thông tin học kỳ', path: 'HockyList' },
                    // { icon: 'history', text: 'Quản lý thông tin thứ', path: 'ThuList' },
                    // { icon: 'history', text: 'Quản lý thông tin ca', path: 'CaList' },
                    { icon: 'meeting_room', text: 'Quản lý thông tin phòng máy', path: 'PhongmayList' },
                    { icon: 'computer', text: 'Quản lý thông tin máy', path: 'MayPhongmayList' },
                    { icon: 'class', text: 'Quản lý thông danh sách lớp', path: 'LopList' },
                    { icon: 'account_balance_wallet', text: 'Quản lý thông tin môn học', path: 'MonhocList' },
                    { icon: 'account_box', text: 'Quản lý thông tin kỹ thuật viên', path: 'KythuatvienList' },
                    { icon: 'calendar_today', text: 'Quản lý lịch trực', path: 'LichtrucList' },
                    { icon: 'calendar_today', text: 'Quản lý lịch dạy', path: 'LichdayAdd' },
                    // { icon: 'history', text }
                    // { icon: 'content_copy', text: 'Quản lý thông tin ca' },
                    // {
                    //   icon: 'keyboard_arrow_up',
                    //   'icon-alt': 'keyboard_arrow_down',
                    //   text: 'Labels',
                    //   model: true,
                    //   children: [
                    //     { icon: 'add', text: 'Create label' }
                    //   ]
                    // },
                    // {
                    //   icon: 'keyboard_arrow_up',
                    //   'icon-alt': 'keyboard_arrow_down',
                    //   text: 'More',
                    //   model: false,
                    //   children: [
                    //     { text: 'Import' },
                    //     { text: 'Export' },
                    //     { text: 'Print' },
                    //     { text: 'Undo changes' },
                    //     { text: 'Other contacts' }
                    //   ]
                    // },
                    // { icon: 'settings', text: 'Settings' },
                    // { icon: 'chat_bubble', text: 'Send feedback' },
                    // { icon: 'help', text: 'Help' },
                    // { icon: 'phonelink', text: 'App downloads' },
                    // { icon: 'keyboard', text: 'Go to the old version' }
                ]
            }
        },
        methods: {
          onToggleSidebar(value) {
            this.drawer = !this.drawer;
          }
        },
        mounted() {
        }
    };
</script>