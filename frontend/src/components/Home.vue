<template>
  <v-container> 
    <v-row class="mt-16 ml-16">
      <div class="d-flex align-center  flex-column mb-6 mt-16">
          <h2 class="font-weight-light">¡Bienvenido/a, <span  class="font-weight-medium">{{ name }}</span>!</h2>
          
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
  position: absolute;
  bottom: 50px;
  font-size: 18px;
  right: 16px;
}
</style>
