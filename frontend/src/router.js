import Vue from 'vue'
import Router from 'vue-router'
import LoginUser from './components/Login.vue'
import DashboardMain from './components/Dashboard.vue'
import DashboardView from './components/DashboardView.vue'
import HomeContent from './components/Home.vue'
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
      component: LoginUser
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
              component: HomeContent

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