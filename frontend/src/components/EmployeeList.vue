<template>
    <div>
        <div class="d-flex align-start mb-6  ml-4">
            <v-btn icon class="mt-2" color="indigo" href="/dashboard">
                <v-icon> mdi-arrow-left</v-icon>
            </v-btn>
            <h1 class="font-weight-regular">Empleados</h1>
        </div>
        <div class="d-flex align-start mb-6 ml-8">
            <v-btn rounded text color="indigo" style="text-transform: none;">
                <v-icon> mdi-delete-outline</v-icon>
                Borrar selección
            </v-btn>
            <v-btn rounded text color="indigo" style="text-transform: none;">
                <v-icon> mdi-file-download-outline</v-icon>
                Descargar datos
            </v-btn>

            <v-spacer></v-spacer>

            <v-btn rounded outlined color="indigo"  class="mr-8" style="text-transform: none;" @click.stop="show=true">
                <v-icon class="mr-1"> mdi-account-plus-outline</v-icon>
                Agregar
            </v-btn>

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
              {{ item.state.name}}
            </template>

            <template v-slot:[`item.city_id`]="{ item }"> 
              {{ item.city.name}}
            </template>
        
          </v-data-table>
        </v-card>
        <v-dialog v-model="dialogDelete" max-width="400px">
          <v-card class="text-center">
              <v-icon
                class="mt-10"
                color="indigo"
                large
              >
                  mdi-delete-outline
              </v-icon>
              <h2 class="font-weight-medium mt-4">Borrar empleado</h2>
              <h5 class="mt-6">¿Está seguro de borrar a ?</h5>
              
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
        
        <UserModal :visible="show" @close="show=false" />

        <template v-if="ready">
          <EditEmployee :visible-modal="showModalEdit" :data="employee" @close="showModalEdit = false" />
        </template>
     
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
        employees: [],
        ready: false,
        employee: null,
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
      this.getEmployees()
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

      async getEmployees () {
          try {
              
            await axios
              .get('http://127.0.0.1:8000/api/employees')
              .then((response) => {
                this.employees = response.data 
                this.ready = true
                      
          })
              
          } catch (error) {
              console.log(error)
          }

      },
      editEmployee(item)
      {
        this.showModalEdit = true
        this.employee = item.id 
        this.ready = true

      },
      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },
      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
        this.closeDelete()
      },
      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },
    }
  }
</script>

<style>
::v-deep .v-data-table-header {
  background-color: #DCDCDC;
}
</style>