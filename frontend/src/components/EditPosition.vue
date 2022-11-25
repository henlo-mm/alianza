<template>
    <v-dialog v-model="show" max-width="800px">
      <v-card ref="form">
        <v-toolbar dark class="indigo" dense>
            <v-card-title>Editar cargo</v-card-title>
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
                     label="Buscar un enmpleado"
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
                <label for="" class="font-weight-medium">Área</label>

                <v-text-field
                    v-model="area"
                    label="Ingrese el área"
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
                <label for="" class="font-weight-medium">Cargo</label>
                <v-text-field
                    v-model="position"
                    label="Ingrese el cargo"
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
                <label for=""  class="font-weight-medium">Rol</label>
                <v-select
                    v-model="role"
                    label="Seleccione el rol del empleado"
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
                <label for="chief" class="font-weight-medium">Jefe</label>
                <v-text-field
                    v-model="chief"
                    label="Ingrese el nombre"
                    solo
                    rounded
                    dense
                    required
                ></v-text-field>
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
    name: 'PositionModal',
    props: ['visibleModal'],
    data () {
        return {
            valid: true,
            name: '',
            document: '',
            area: '',
            position: '',
            role: null,
            chief: null,
           
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