<template>
    <div>
        <v-app-bar clipped-left app flat>
            <img
                class="img-fluid"
                src="https://www.psicoalianza.com/build/img/logo-color-psicoalianza-pruebas-psicotecnicas.webp"
            />
            <v-spacer></v-spacer>

            <v-menu offset-y nudge-bottom='8'>
                <template v-slot:activator="{ on, attrs }">
                    <div class="d-flex flex-column mb-6 mt-6">
                        <h6 style="color: #304FFE;">{{ name }}</h6>
                        <h6 class="font-weight-regular">Administrador</h6>
                    </div>
                    
                    <v-btn
                        v-ripple="false"
                        plain
                        icon
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-list-item-avatar>
                            <v-img src="../assets/woman.png"></v-img>
                        </v-list-item-avatar>
                    </v-btn>    
                </template>
                
                <v-list class="menu">
                    <v-list-item
                        v-for="(item, index) in subList"
                        :key="index"
                        class="hover-item"
                        link
                    >
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item>
                    <v-list-item
                        class="hover-item"
                        link
                        @click="logout()"
                    >
                        <v-list-item-title>{{ close.title }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>

        </v-app-bar>

        <v-navigation-drawer
            app
            clipped
            color="indigo accent-4"
            dark
            v-model="drawer"
            :mini-variant.sync="mini"
            permanent
        >
            <v-list-item class="px-2">
                <v-app-bar-nav-icon @click.stop="mini = !mini"></v-app-bar-nav-icon>
            </v-list-item>
    
            <v-divider></v-divider>
            <v-list>
                <v-list-group
                    v-for="item in items"
                    :key="item.title"
                    link
                >
                    <v-list-item class="pa-0" slot='activator' :to="item.route">
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>
                        
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    
                    </v-list-item>

                    <v-list-item class="pl-8" v-for='sub in item.subLinks' :to="sub.route" :key="sub.title" link>
                        <v-list-item-icon>
                            <v-icon>{{ sub.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title >{{ sub.title }}</v-list-item-title>
                    </v-list-item>
                </v-list-group>
            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
import axios from "axios";
export default {
  name: 'VerticalBar',
  components: {
  
  },
  created() {
    axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
    this.getAuthenticatedUser()

  },

  data () {
      return {
        drawer: true,
        token: localStorage.getItem('token'),
        items: [
            { title: 'Home', icon: 'mdi-home' },
            { 
                title: 'Listas', 
                icon: 'mdi-playlist-plus',
                subLinks: [
                    { title: "Empleados", route: "/dashboard/employee", icon: 'mdi-account-group-outline'},
                    { title: "Cargos", route: "/dashboard/position", icon: 'mdi-briefcase-account-outline'}
                ]

            },
        ],
        subList: [
            { title: 'Perfil'},
            { title: 'Configuración' },
            { title: 'Soporte' },
           // { title: 'Salir', route: "/logout"},
        ],

        close: {
            title: "Salir"
        },
        mini: true,
        name: null,
      }
    },
    methods: {
        async logout() {
                
            try {
              
              await axios
                .post(this.$baseUrl + 'logout')
                .then((response) => {
                    console.log(response)
                    localStorage.removeItem('token')
                    this.$router.push("/"); 
            })
                
            } catch (error) {
                console.log(error)
            }
        },
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

.menu {
    background-color: #f5f5f5 !important;
}

.v-menu__content {
    box-shadow: none;
    width: 130px;
}
.v-application .primary--text {
    color: none;
    caret-color: #1976d2 !important;
}

/* .hover-item:hover {
    background-color: #304FFE !important;
    color: white;
} */
</style>


