<template>
    <div>
      <v-row no-gutters>
        <v-col md="8">
          <v-parallax
            id="parallax"
            class="parallax-h"
            :class="displayImage()"
            dark
          >
          <!-- <v-parallax
            class="parallax-h"
            dark
            src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
          > -->
            <v-row
              align="center"
              justify="center"
            >
              <v-col
                class="ml-5 col-lg-6  col-md-5 text-light d-none d-sm-none d-md-block"
                style="margin-top:28%"
                cols="12"
              >
                <h2 class="font-weight-thin mb-4">
                  Bienvenido a la mejor plataforma
                  <h3>
                    organizacional online
                  </h3>
                </h2>
                <h3 class="font-weight-thin mb-4">Gestión efectiva del talento humano</h3>
              </v-col>
            </v-row>
          </v-parallax>
        </v-col>
        <v-col md="4" xl="8">
          <div class="container">
            <v-img
              class="img-login"
              src="https://app.psicoalianza.com/images/login/psico.png"
            ></v-img>

            <v-form ref="form" class="mt-4">

              <label for="" class="mt-4">Usuario</label>

              <v-text-field
                class="mt-4"
                v-model="form.email"
                label="Ingresa tu nombre de usuario"
                solo
                rounded
                dense
              ></v-text-field>

              <label for="" >Contraseña</label>
              <v-text-field
                v-model="form.password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                class="mt-4"
                label="Ingresa tu contraseña"
                :type="show ? 'text' : 'password'"
                @click:append="show = !show"
                solo
                rounded
                dense
              ></v-text-field>

              <div class="d-flex justify-center">
                  <v-checkbox
                    v-model="checkbox"
                    label="Recordar cuenta"
                  ></v-checkbox>
              </div>
            
              <div class="text-center">
                <v-btn
                  block
                  color="indigo"
                  dark
                 
                  rounded
                  @click="login"
                  dense
                  >Iniciar sesión</v-btn>
              </div>
              
            </v-form>
            <div class="row col mt-2">
              <div class="col-md-6">
                <a href="" class="text-muted">¿Olvidaste tu usuario?</a>
              </div>
              <div class="col-md-6">
                <a href="" class="text-muted">¿Olvidaste tu contraseña?</a>
              </div>
            </div>
          </div>
        </v-col>
      </v-row> 
    </div>
</template>


<script>

import axios from "axios";
export default {
  name: 'LoginUser',

  components: {
   
  },

  data () {
    return {
      show: false,
      checkbox: false,
      form: {
        email: null,
        password: null
      }
    }
  },
  computed: {
   

  },
  created () {

  },
  methods: {

    displayImage() {
      if(window.innerWidth <= 600) {
        return "d-none"
      }else {
        return ""
      }
      
    },
    async login () {
      try {
              
        await axios
          .post(this.$baseUrl + 'login', this.form)
          .then((response) => {
            localStorage.setItem('token', response.data.access_token);
            this.$router.push("/dashboard"); 
        })
            
        } catch (error) {
            console.log(error)
        }

    }
    
  }
};
</script>

<style>
.centered-input {
  text-align: center;
}

.container {
  left: 0;
  width: 80%;
  z-index: 2;
}

.text-muted {
  font-size: 11px;
  color:#858796 !important;
  text-decoration: none;
}

.img-login {
  margin-top: 75px;
}

.parallax-h {
 height: 100vh !important;
 background-image:
    linear-gradient(to bottom, rgba(247, 247, 247, 0.52), rgba(2, 133, 255, 0.73)),
    url('https://www.autonomosyemprendedor.es/media/autonomosyemprendedor/images/2022/10/20/2022102016094283524.jpg');
    background-size: cover;
    color: white;
    padding: 20px;
}
</style>