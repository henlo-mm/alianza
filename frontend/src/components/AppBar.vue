<template>
  <v-app-bar>
      <img
          class="img-fluid"
          src="https://www.psicoalianza.com/build/img/logo-color-psicoalianza-pruebas-psicotecnicas.webp"
      />
      <v-spacer></v-spacer>

        
      <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
      </v-list-item-avatar>

  </v-app-bar>
</template>

<script>


export default {
  name: 'AppBar',

  components: {
   
  },

  data () {
    return {
     
    }
  },
};
</script>

<style>

.img-fluid {
    max-width: 100% !important;
    height: auto !important;
    vertical-align: middle;
}
</style>