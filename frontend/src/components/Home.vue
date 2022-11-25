<template>
  <v-container> 
    <v-row class="mt-6">
      <div class="d-flex align-center  flex-column mb-6 mt-6">
          <h2 class="font-weight-light">¡Bienvenido/a!</h2>
          <h2 class="font-weight-light">¡Usuario Usuario!</h2>
          <p class="mt-16">Añade los datos personales de tus empleados y después agrega su cargo en tu empresa</p>
          <v-btn
              icon
              color="indigo"
              class="mt-10"
              large
              @click.stop="show=true"
          >
            <v-icon>mdi-account-plus-outline</v-icon>
          </v-btn>
          <p style="color: #808080; font-size: 12px;">Empieza aquí</p>
      </div>
        
    </v-row>

    <div style="text-align: right;">
      <img
        class="img"
        src="https://gcmsnotes.com/wp-content/uploads/new-gcms-report.png"
      />
    </div>
    <UserModal :visible="show" @close="show=false" />
  </v-container>
</template>

<script>

import UserModal from './User'
  export default {
    name: 'HomeContent',
    components: {
      UserModal

    },

    data () {
      return {
        show: false
      }
    }
  }
</script>

<style>
.img {
  position: absolute;
  bottom: 50px;
  font-size: 18px;
  right: 16px;
}
</style>
