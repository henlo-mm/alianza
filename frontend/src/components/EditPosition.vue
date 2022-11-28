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
                 <v-select
                    v-model="form.name"
                    label="Buscar un empleado"
                    :items="employees"
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
                <label for="" class="font-weight-medium">Área</label>

                <v-text-field
                    v-model="form.area"
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
                <v-select
                    v-model="form.position"
                    label="Ingrese el cargo"
                    :items="positions"
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
            >
                <label for=""  class="font-weight-medium">Rol</label>
                <v-select
                    v-model="form.role"
                    :items="roles"
                    item-text="name"
                    item-value="id"
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
                <v-select
                    v-model="form.chief"
                    label="Ingrese el nombre"
                    :items="employees"
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
                    @click="updatePositionEmployee"
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
    name: 'PositionModal',
    props: ['visibleModal', 'data', 'pos'],
    data () {
        return {
            valid: true,
            name: '',
            form: {
                id: this.pos,
                name: '',
                document: '',
                area: '',
                position: '',
                role: null,
                chief: null
            },
            positions: [],
            employees: [],
            roles: [], 
            position: [],
            token: localStorage.getItem('token'),
        }

    },
    computed: {
        show: {
            get () {
                this.getPositionEmployee()
                return this.visibleModal
            },
            set (value) {
                if (!value) {
                    this.$emit('close')
                }
            }
        },
   /*      employeesOptions () {
            this.data.forEach(element => {
                console.log(element.employee)
                
            });
            return this.data.employee.map(item => ({ value: item.id, text: item.name }));
        }, */
    },
    created () {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.getRoles()
        this.getEmployees()
        this.getPositions()
    },
    methods: {
        async getPositionEmployee () {
           
            const response = await axios.get('http://127.0.0.1:8000/api/positions_employee/' + this.pos);
      
            this.position = response.data; 
   
            this.setForm();
        },
        async getRoles () {
            try {
                
              await axios
                .get('http://127.0.0.1:8000/api/roles')
                .then(response => (
                    this.roles = response.data 
                     
                ))
                
            } catch (error) {
                console.log(error)
            }

        },
        async getEmployees () {
            try {
                
              await axios
                .get('http://127.0.0.1:8000/api/employees_position')
                .then(response => (
                    this.employees = response.data  
                ))
                
            } catch (error) {
                console.log(error)
            }

        },
        getPositions () {
            try {
              
                axios
                .get('http://127.0.0.1:8000/api/positions')
                .then(response => (
                    this.positions = response.data  
                ))
                
            } catch (error) {
                console.log(error)
            }

        },

        async updatePositionEmployee() {
            try {

                const response = await axios.post('http://127.0.0.1:8000/api/positions_employee/edit', this.form);
                if(response.status == 200) {
                    this.show = false
                    
                }

            } catch (error) {
                 console.log(error)
               
            }
        },
        setForm () {
            if (this.position) {
                this.form.name = this.position.employee_id;
                this.form.document = this.position.document;
                this.form.area = this.position.area;
                this.form.position_id = this.position.position_id;
                this.form.role = this.position.rol_id;
                this.form.chief = this.position.chief_id;

            } else {
                
                this.clearForm()
            }
        },
        clearForm () {

            this.employee = null
            this.form = {
                id: null,
                name: '',
                document: '',
                area: '',
                position: '',
                role: null,
                chief: null
            }
        }
    }
}
</script>