<template>
    <div>
        <div class="d-flex align-start mb-6  ml-4">
            <v-btn icon class="mt-2" color="indigo" href="/dashboard">
                <v-icon> mdi-arrow-left</v-icon>
            </v-btn>
            <h1 class="font-weight-regular">Empleados</h1>
        </div>
    
        <div class="d-flex align-start mb-6 ml-8">
          <v-row>
            <v-col cols="12" md="6" >
              <v-row :column="$vuetify.breakpoint.mdAndDown">
                <v-col cols="12" md="6">
                  <v-btn rounded text color="indigo" style="text-transform: none;">
                    <v-icon> mdi-delete-outline</v-icon>
                    Borrar selección
                </v-btn>
                </v-col>
                <v-col cols="12" md="6">
                  <v-btn rounded text color="indigo" style="text-transform: none;">
                    <v-icon> mdi-file-download-outline</v-icon>
                    Descargar datos
                </v-btn>
               
                </v-col>
              </v-row>
            </v-col>
            
            <v-col cols="12" lg="6" :class="alignBtn()">
              <v-btn rounded outlined color="indigo"  class="mr-8 ml-4" style="text-transform: none;" @click.stop="show=true">
                <v-icon class="mr-1"> mdi-account-plus-outline</v-icon>
                Agregar
            </v-btn>
            </v-col>
          </v-row>
        </div>
       
        <v-card class="ml-8 mr-8 mb-6">
          <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Buscar"
                single-line
                hide-details
            ></v-text-field>
          </v-card-title>
          <v-data-table
              :headers="headers"
              :items="employees"
              :search="search"
          >
       
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon
                  class="mr-2"
                  color="indigo"
                  @click="editEmployee(item)"
                >
                  mdi-pencil-outline
                </v-icon>
                <v-icon
                  color="indigo"
                  @click="deleteItem(item)"
                >
                  mdi-delete-outline
                </v-icon>
            </template>

            <template v-slot:[`item.states_id`]="{ item }">
              {{ item.state.name }}
            </template>

            <template v-slot:[`item.city_id`]="{ item }" > 
              {{ item.city.name }}
            </template>
            <template v-slot:top>

              <v-dialog v-model="dialogDelete" max-width="350px">
                <v-card class="text-center">
                    <v-icon
                      class="mt-6"
                      color="indigo"
                      large
                    >
                        mdi-delete-outline
                    </v-icon>
                  
                    <h2 class="font-weight-medium mt-2">Borrar empleado</h2>
                    <h5 class="font-weight-regular mt-6">¿Está seguro de borrar a <span class="font-weight-medium">{{ data.name}}</span>?</h5>
                    
                    <v-card-actions>
                      <v-spacer></v-spacer>
                     
                        <v-btn rounded  @click="closeDelete" small>
                            Cancelar
                        </v-btn>
                        
                        <v-btn rounded color="indigo" dark @click="deleteItemConfirm" small>
                            Aceptar
                        </v-btn>
                     
                      <v-spacer></v-spacer>
                    
                    </v-card-actions>
                </v-card>
              </v-dialog>
            </template>
        
          </v-data-table>
        </v-card>
        
        <UserModal :visible="show" @close="show=false" @update="updateList" />
        
        <EditEmployee 
          :visible-modal="showModalEdit" 
          v-if="employee" 
          :states="states" 
          :data="employee" 
          @close="showModalEdit = false"
          @update="updateData"
        />
        
     
    </div>
</template>

<script>
import axios from "axios";

import EditEmployee from './EditEmployee.vue';
import UserModal from './User'

  export default {
    name: "EmployeeList",
    components: {
      UserModal,
      EditEmployee
    },
   
    data () {
      return {
        search: '',
        show: false,
        showModalEdit: false,
        dialog: false,
        dialogDelete: false,
        data: {},
        employees: [],
        employee: null,
        states: [],
        editedIndex: null,
        token: localStorage.getItem('token'),
        id: null,
       /*  singleSelect: false,
        selected: [], */
        headers: [
          
          {
            text: 'Nombre',
           
            sortable: false,
            value: 'name',
          },
          { text: 'Identificación', value: 'document' },
          { text: 'Dirección', value: 'address' },
          { text: 'Teléfono', value: 'phone' },
          { text: 'Departamento', value: 'states_id' },
          { text: 'Ciudad', value: 'city_id' },
          { text: 'Acciones', value: 'actions', sortable: false},
        ],
       
      }
    },
    created () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      this.getStates()
      this.getEmployees()
    },
    mounted() {
      
    },
    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },
    methods: {
      alignBtn() {
        if(window.innerWidth <= 600  ) {
         
          return 'none'
        }else {
          
          return 'text-right'
        }

      },
      updateList () {
        this.getEmployees()  
      },
      updateData () {
        this.getEmployees()
      },

      async getEmployees () {
          try {
              
            await axios
              .get(this.$baseUrl + 'employees')
              .then((response) => {
        
                this.employees = response.data 
                      
          })
              
          } catch (error) {
            if (error.response.status === 401) {
                 localStorage.removeItem('token')
                 this.$router.push({ name: 'Login'})
            }
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
      editEmployee(item)
      {
        this.showModalEdit = true
        this.employee = item.id 

      },
      deleteItem (item) {
        
        this.index = item.id
        this.data = item

        this.dialogDelete = true
      },
      deleteItemConfirm () {
       
        axios
          .delete(this.$baseUrl + 'delete/' + this.index )
            .then((response) => {
              this.getEmployees()
              console.log(response)
        })
        this.closeDelete()
      },
      closeDelete () {
        this.dialogDelete = false
        
      },
    }
  }
</script>

<style>
::v-deep .v-data-table-header {
  background-color: #DCDCDC;
}
</style>