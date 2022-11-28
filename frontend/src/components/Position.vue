<template>
    
    <div>
        <div class="d-flex align-start mb-6 ml-4">
            <v-btn icon class="mt-2" color="indigo" href="/dashboard">
                <v-icon> mdi-arrow-left</v-icon>
            </v-btn>
            <h1 class="font-weight-regular">Cargos</h1>
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

            <v-btn rounded outlined class="mr-8" style="text-transform: none;" color="indigo"  @click.stop="show=true">
                <v-icon class="mr-1">mdi-briefcase-account-outline</v-icon>
                Agregar
            </v-btn>

        </div>
       
        <v-card class="mr-8 ml-8 mb-8">
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
                :items="position_employee"
                :search="search"
            >
             
              <template v-slot:[`item.rol_id`]="{ item }">
                {{ item.rol.name}}
              </template>

              <template v-slot:[`item.position_id`]="{ item }"> 
                {{ item.position.name}}
              </template>

              <template v-slot:[`item.employee_id`]="{ item }"> 
                {{ item.employee.name}}
              </template>
              <template v-slot:[`item.chief_id`]="{ item }"> 
                {{ item.employee.name}}
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
                    
                      <h2 class="font-weight-medium mt-4">Borrar cargo</h2>
                      <h5 class="font-weight-regular mt-6">¿Está seguro de borrar el cargo de <span class="font-weight-medium">{{ position_item.name}}</span>?</h5>
                      
                      <v-card-actions class="mt-4">
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

              <template v-slot:[`item.actions`]="{ item }">
                  <v-icon
                      class="mr-2"
                      color="indigo"
                      @click="editPositionEmployee(item)"
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
             
            </v-data-table>
        </v-card>
        
        <PositionModal :visible="show" @close="show=false" @update="updateList" />
        <EditPosition 
          :visible-modal="showModalEdit" 
          v-if="position && position_employee"  
          :pos="position" 
          :data="position_employee"
          @update="updateData"
          @close="showModalEdit=false" 
        />
    </div>
</template>

<script>
import axios from "axios";
import EditPosition from './EditPosition'
import PositionModal from './PositionModal'
  export default {
    name: "PositionEmployee",
    components: {
        PositionModal,
        EditPosition
    },
    data () {
      return {
        search: '',
       /*  singleSelect: false,
        selected: [], */
        show: false,
        showModalEdit: false,
        dialog: false,
        dialogDelete: false,
        position_employee: [],
        position: null,
        index: null,
        position_item: {},
        token: localStorage.getItem('token'),
        headers: [
          {
            text: 'Nombre',
            align: 'start',
            sortable: false,
            value: 'employee_id',
          },
          { text: 'Identificación', value: 'document' },
          { text: 'Área', value: 'area' },
          { text: 'Cargo', value: 'position_id' },
          { text: 'Rol', value: 'rol_id' },
          { text: 'Jefe', value: 'chief_id' },
          { text: 'Acciones', value: 'actions', sortable: false },
        ],
        
      }
    },
    created () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      this.getPositionEmployee()

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
      updateList() {
        this.getPositionEmployee()
      },
      updateData () {
        this.getPositionEmployee()
      },
      async getPositionEmployee () {
          try {
              
            await axios
              .get('http://127.0.0.1:8000/api/positions_employee')
              .then((response) => {
              this.position_employee = response.data 
                      
          })
              
          } catch (error) {
              console.log(error)
          }

      },
      editPositionEmployee(item)
      {
        this.showModalEdit = true
        this.position = item.id 

      },
      deleteItem (item) {
        
        this.index = item.id
        this.position_item = item.position

        this.dialogDelete = true
      },
      deleteItemConfirm () {
       
        axios
          .delete('http://127.0.0.1:8000/api/positions_employee/delete/'+ this.index )
            .then((response) => {
              console.log(response)
        })
        this.closeDelete()
      },
      closeDelete () {
        this.dialogDelete = false
        this.getPositionEmployee()
      },
    }
  }
</script>