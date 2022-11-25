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
         
            <v-spacer></v-spacer>
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
                :items="desserts"
                :search="search"
            >
              <!-- v-model="selected"
                :single-select="singleSelect"
                item-key="name"
                show-select -->
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon
                    
                    class="mr-2"
                    color="indigo"
                    @click.stop="showModalEdit = true"
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
        <v-dialog v-model="dialogDelete" max-width="300px">
          <v-card>
            <v-card-title class="text-h5">¿Quieres eliminar este registro?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1 text-center" text @click="closeDelete">Cancelar</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">Aceptar</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <PositionModal :visible="show" @close="show=false" />
        <EditPosition :visible-modal="showModalEdit" @close="showModalEdit=false" />
    </div>
</template>

<script>

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
        headers: [
          {
            text: 'Nombre',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Identificación', value: 'calories' },
          { text: 'Área', value: 'fat' },
          { text: 'Cargo', value: 'carbs' },
          { text: 'Rol', value: 'protein' },
          { text: 'Jefe', value: 'iron' },
          { text: 'Acciones', value: 'actions', sortable: false },
        ],
        desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%',
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%',
          },
          
        ],
      }
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