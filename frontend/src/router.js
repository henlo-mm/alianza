import Vue from 'vue'
import Router from 'vue-router'
import LoginUser from './components/Login.vue'
import DashboardMain from './components/Dashboard.vue'
import DashboardView from './components/DashboardView.vue'
import HomeContent from './components/Home.vue'
import EmployeeList from './components/EmployeeList.vue'
import PositionEmployee from './components/Position.vue'

Vue.use(Router)


function guardMyroute(to, from, next)
{
    let isAuthenticated = false;

    if(localStorage.getItem('token'))
      isAuthenticated = true;
    else
      isAuthenticated = false;

    if(isAuthenticated) 
    {
      next();
    } 
    else
    {
      next('/');
    }
}
Vue.prototype.$baseUrl = 'http://127.0.0.1:8000/api/';

//Vue.prototype.$baseUrl = 'https://shrouded-mesa-45544.herokuapp.com/api/';

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      name: "home",
      component: LoginUser,
      meta: {title: 'Home'},

    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      beforeEnter : guardMyroute,
      meta: {title: 'Dashboard'},
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
