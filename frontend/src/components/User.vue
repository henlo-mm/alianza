<template>
    <v-dialog v-model="show" max-width="800px">
      <v-card ref="form">
        <v-toolbar dark class="indigo" dense>
            <v-card-title>Nuevo empleado</v-card-title>
            <v-spacer></v-spacer>
            <v-btn
              icon
              @click.stop="show = false"
            >
                <v-icon>mdi-close-circle-outline</v-icon>
            </v-btn>
        </v-toolbar>
        
        <v-card-text>
        
         <v-row justify="center" class="mt-4">

            <v-col
                 cols="12"
                 sm="6"
                
            >
                <label for="" class="font-weight-medium">Nombres</label>
                 <v-text-field
                     v-model="form.name"
                     label="Ingresa los nombres de tu empleado"
                     solo
                     rounded
                     dense
                     required
                 ></v-text-field>
             
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
                <label for="" class="font-weight-medium">Apellidos</label>

                <v-text-field
                    v-model="form.lastName"
                    label="Ingresa los apellidos de tu empleado"
                    solo
                    rounded
                    dense
                    required
                ></v-text-field>
 
            </v-col>
            <v-col
                cols="12"
                sm="6"
            >
                <label for="" class="font-weight-medium">Identificación</label>
                <v-text-field
                    v-model="form.document"
                    label="Escribe un número de identificación"
                    solo
                    rounded
                    dense
                    required
                ></v-text-field>

            </v-col>
            <v-col
                cols="12"
                sm="6"
            >
                <label for="" class="font-weight-medium">Dirección</label>
                <v-text-field
                    v-model="form.address"
                    label="Escribe un número de teléfono"
                    solo
                    rounded
                    dense
                    required
                ></v-text-field>

            </v-col>
            <v-col
                cols="12"
                sm="12"
            >
                <label for="" class="font-weight-medium">Teléfono</label>
                <v-text-field
                    v-model="form.phone"
                    label="Escribe un número de teléfono"
                    solo
                    rounded
                    dense
                    required
                ></v-text-field>

            </v-col>
            <v-col
                cols="12"
                sm="6"
            >
                <label for=""  class="font-weight-medium">Departamento</label>
                <v-select
                    v-model="form.department"
                    label="Selecciona un departamento"
                    :items="states"
                    item-text="name"
                    item-value="id"
                    @change="getCities"
                    solo
                    rounded
                    dense
                    required
                ></v-select>

            </v-col>
            <v-col
                cols="12"
                sm="6"
            >
                <label for="city" class="font-weight-medium">Ciudad</label>
                <v-select
                    v-model="form.city"
                    label="Selecciona una ciudad"
                    :items="cities"
                    item-text="name"
                    item-value="id"
                    solo
                    rounded
                    dense
                    required
                ></v-select>
            </v-col>
            <v-col
                cols="12"
                sm="6"
                class="d-flex justify-md-space-around"
            >
                <v-btn
                    rounded
                    @click="show = false"
                >
                    Cancelar
                </v-btn>
                
                <v-btn
                    rounded
                    color="indigo"
                    dark
                    @click="storeEmployee"
                >
                    Guardar
                </v-btn>
            </v-col>
           
         </v-row>
        </v-card-text>
      </v-card>
    </v-dialog>
</template>
    
<script>
import axios from "axios";
export default {
    name: 'UserModal',
    props: ['visible'],
    data () {
        return {
            valid: true,
            form: {
                name: '',
                lastName: '',
                document: '',
                address: '',
                phone: '',
                department: null,
                city: null,
            },
            states: null,
            cities: null,
            token: localStorage.getItem('token'),
        }

    },
    created () {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.getStates()
        
    },
    computed: {
        show: {
            get () {
                return this.visible
            },
            set (value) {
                if (!value) {
                    this.$emit('close')
                }
            }
        },
   
    },
    methods: {
        storeEmployee () {
            try {
               
                axios
                .post(this.$baseUrl + 'employees', this.form)
                .then((response) => {
                    
                    if(response.status == 200) {
                        this.$emit('update', response.data)
            
                        this.show = false
                    
                    }/* else {
                        
                        this.$toast.error( "No se pudo crear el usuario. Por favor, intente mas tarde.");
                    } */
                })
                
            } catch (error) {

                console.log(error)
            }
        },
        async getStates () {
            try {
                
              await axios
                .get(this.$baseUrl + 'states')
                .then(response => (
                    this.states = response.data 
                     
                ))
                
            } catch (error) {
                console.log(error)
            }

        },
        getCities (id) {
            try {
              
                this.form.department = id
                axios
                .post(this.$baseUrl + 'cities', { state_id: this.form.department })
                .then(response => (
                    this.cities = response.data  
                ))
                
            } catch (error) {
                console.log(error)
            }

        }
    }
}
</script>