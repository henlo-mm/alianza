<template>
    
    <div>
        <div class="d-flex align-start mb-6  ml-4">
            <v-btn icon class="mt-2" color="indigo">
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
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon
                    
                    class="mr-2"
                    color="indigo"
                    @click="editItem(item)"
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
        <UserModal :visible="show" @close="show=false" />
    </div>
</template>

<script>

import UserModal from './User'

  export default {
    name: "EmployeeList",
    components: {
        UserModal

    },
    data () {
      return {
        search: '',
        show: false,
       /*  singleSelect: false,
        selected: [], */
        headers: [
          
          {
            text: 'Nombre',
           
            sortable: false,
            value: 'name',
          },
          { text: 'Identificación', value: 'calories' },
          { text: 'Dirección', value: 'fat' },
          { text: 'Teléfono', value: 'carbs' },
          { text: 'Departamento', value: 'protein' },
          { text: 'Ciudad', value: 'iron' },
          { text: 'Acciones', value: 'actions', sortable: false},
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
          {
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%',
          },
          {
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%',
          },
          {
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%',
          },
          {
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%',
          },
          {
            name: 'Lollipop',
            calories: 392,
            fat: 0.2,
            carbs: 98,
            protein: 0,
            iron: '2%',
          },
          {
            name: 'Honeycomb',
            calories: 408,
            fat: 3.2,
            carbs: 87,
            protein: 6.5,
            iron: '45%',
          },
          {
            name: 'Donut',
            calories: 452,
            fat: 25.0,
            carbs: 51,
            protein: 4.9,
            iron: '22%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%',
          },
        ],
      }
    },
  }
</script>