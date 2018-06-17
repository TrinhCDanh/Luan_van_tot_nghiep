<template>
  <div style="overflow: hidden;">
    <v-app id="inspire">

      <!-- <LayoutSidebar></LayoutSidebar> -->
      <LayoutHeader></LayoutHeader>
      <!-- <transition name="fade"><router-view></router-view></transition> -->
      <!-- <LayoutFooter></LayoutFooter> -->
      <v-content>
        <v-container fluid>
          <transition name="fade"><router-view></router-view></transition>
        </v-container>
      </v-content>

    </v-app>
  </div>
</template>
<script>
  import LayoutHeader from "../components/Header"
  import LayoutFooter from "../components/Footer"
  import LayoutSidebar from "../components/Sidebar"
  import axios from 'axios'
  import Vuetify from 'vuetify'
  export default {
    components: {
      LayoutHeader,
      LayoutFooter,
      LayoutSidebar
    },
    methods:{
    },
    mounted(){
    }
  };
</script>
<style>
.fade-enter-active, .fade-leave-active {
  transition-property: opacity;
  transition-duration: .25s;
}

.fade-enter-active {
  transition-delay: .25s;
}

.fade-enter, .fade-leave-active {
  opacity: 0
}
* {
  font-family: 'Muli', sans-serif;
}
</style>