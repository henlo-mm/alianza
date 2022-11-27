<template>
    <v-dialog v-model="show" max-width="800px">
      <v-card>
        <v-form @submit.prevent="updateEmployee" @reset.prevent="setForm">
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

                <v-col cols="12" sm="6">
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

                <v-col cols="12" sm="6">
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
                <v-col cols="12" sm="6">
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
                <v-col cols="12" sm="6">
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
                <v-col cols="12" sm="12">
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
                <v-col cols="12" sm="6">
                    <label for=""  class="font-weight-medium">Departamento</label>
                    <v-select
                        v-model="form.department"
                        label="Selecciona un departamento"
                        solo
                        rounded
                        dense
                        required
                    ></v-select>

                </v-col>
                <v-col cols="12" sm="6">
                    <label for="city" class="font-weight-medium">Ciudad</label>
                    <v-select
                        v-model="form.city"
                        label="Selecciona una ciudad"
                        solo
                        rounded
                        dense
                        required
                    ></v-select>
                </v-col>
                <v-col cols="12" sm="6" class="d-flex justify-md-space-around">
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

        </v-form>
      </v-card>
    </v-dialog>
</template>
    
<script>
import axios from "axios";

export default {
    name: 'UserModal',
    props: ['visibleModal', 'data'],
    data () {
        return {
            valid: true,
            form: {
                name: this.data,
                lastName: '',
                document: '',
                address: '',
                phone: '',
                department: null,
                city: null,
            },
            employee: []
        }

    },
    created () {
        
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
    },
    methods: {
        async getEmployee () {
            
            const response = await axios.get('http://127.0.0.1:8000/api/employees/' + this.data);

            this.employee = response.data;
           
            this.setForm();
        },

        async updateEmployee() {
            try {

                await axios.put('http://127.0.0.1:8000/api/employees', this.form);
                //  console.log(response)

            } catch (error) {
                 console.log(error)
               
            }
        },
        setForm () {
            if (this.employee) {
                this.form.document = this.employee.document;
                this.form.name = this.employee.name;
                this.form.lastName = this.employee.lastName;
                this.form.address = this.employee.address;
                this.form.phone = this.employee.phone;
                this.form.city = this.employee.city;
                this.form.department = this.employee.department;

               
            } else {
                console.log("asas")
            }
        },
    }
}
</script>