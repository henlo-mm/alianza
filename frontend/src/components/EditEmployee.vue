<template>
    <v-dialog v-model="show" max-width="800px">
      <v-card ref="form">
        <v-toolbar dark class="indigo" dense>
            <v-card-title>Editar empleado</v-card-title>
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
                     v-model="name"
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
                    v-model="lastName"
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
                    v-model="document"
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
                <label for="" class="font-weight-medium">Teléfono</label>
                <v-text-field
                    v-model="phone"
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
                    v-model="department"
                    label="Selecciona un departamento"
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
                    v-model="city"
                    label="Selecciona una ciudad"
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
export default {
    name: 'UserModal',
    props: ['visibleModal'],
    data () {
        return {
            valid: true,
            name: '',
            lastName: '',
            document: '',
            phone: '',
            department: null,
            city: null,
           
        }

    },
    computed: {
        show: {
            get () {
                return this.visibleModal
            },
            set (value) {
                if (!value) {
                    this.$emit('close')
                }
            }
        }
    }
}
</script>