<template>
  <v-container> 
    <v-row>
      <v-col cols="12" >
        <v-row :column="$vuetify.breakpoint.mdAndDown">
          
          <v-col cols="12">
            <div class="d-flex align-center  flex-column mb-6 mt-10">
              <h2 class="font-weight-light">¡Bienvenido/a, <span  class="font-weight-medium">{{ name }}</span>!</h2>
              
              <p class="mt-10">Añade los datos personales de tus empleados y después agrega su cargo en tu empresa</p>
              <v-btn
                  icon
                  color="indigo"
                  class="mt-6"
                  large
                  @click.stop="show=true"
              >
                <v-icon>mdi-account-plus-outline</v-icon>
              </v-btn>
              <p style="color: #808080; font-size: 12px;">Empieza aquí</p>
              <div>
                <img 
                  src="https://gcmsnotes.com/wp-content/uploads/new-gcms-report.png"
                  class="img"
                />
              </div>
            </div>
          </v-col>
        </v-row>
      </v-col>          
    </v-row>

    <UserModal :visible="show" @close="show=false" />
  </v-container>
</template>

<script>
import axios from "axios";

import UserModal from './User'
  export default {
    name: 'HomeContent',
    components: {
      UserModal
    },

    data () {
      return {
        show: false,
        token: localStorage.getItem('token'),
        name: null
      }
    },
    created () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      this.getAuthenticatedUser()
    },
    methods: {
      async getAuthenticatedUser () {
          try {
              await axios
                .get(this.$baseUrl + 'auth_user')
                .then((response) => {
                  console.log(response)
                  this.name = response.data.name + ' ' + response.data.last_name
          })
          } catch (error) {
                  console.log(error)
          }
      }
    }
  }
</script>

<style>
.img {
  max-width: 100%;
  height: auto;
}
</style>
