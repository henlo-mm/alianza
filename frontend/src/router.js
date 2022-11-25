import Vue from 'vue'
import Router from 'vue-router'
import ExampleTest from './components/Example.vue'
import DashboardMain from './components/Dashboard.vue'
import DashboardView from './components/DashboardView.vue'
import HelloWorld from './components/HelloWorld.vue'
import EmployeeList from './components/EmployeeList.vue'
import PositionEmployee from './components/Position.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: ExampleTest
    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: DashboardMain,
      children: [
        {
          path: '',
          name: 'DashboardView',
          component: DashboardView,
          children: [
            {
              path: '',
              name: 'Hello',
              component: HelloWorld

            }
          ]
        },
        {
          path: 'employee',
          component: EmployeeList
        },
        {
          path: 'position',
          component: PositionEmployee
        }
      ]
    },
    
  ]
})