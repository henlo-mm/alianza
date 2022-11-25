<template>
    <v-app>
        <VerticalBar />

        <DashboardView />
    </v-app>
</template>

<script>

import VerticalBar from './Header.vue'
import DashboardView from './DashboardView.vue'

export default {
  name: 'MainDashboard',
  components: {
    
    VerticalBar,
    DashboardView
  },

  data () {
      return {
    
      }
    },
};

</script>