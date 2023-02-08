import MainLayout from '../layouts/MainLayout.vue'
import LoginPage from '../pages/LoginPage.vue'
import RegisterPage from '../pages/RegisterPage.vue'
import FriendPage from '../pages/FriendPage.vue'
import DataPage from '../pages/DataPage.vue'


const routes = [
  {
    path: '/mainlayout',
    component: MainLayout,
    children: [
      {
        path: '/friendpage',
        component: FriendPage
      },
      {
        path: '/datapage',
        component: DataPage
      }
    ]
  },
  {
    path: '/',
    component: LoginPage
  },
  {
    path: '/registerpage',
    component: RegisterPage
  },
]

export default routes
