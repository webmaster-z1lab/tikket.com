import MyProfile from './view/MyProfile'
import EditProfile from './view/EditProfile'
import ChangePassword from './view/ChangePassword'
import Address from './view/Address'
import ErrorComponent from '../components/errorComponent'

const routes = [
    {path: '/', name: 'home', redirect: {name: 'my_profile'}},
    {path: '/perfil', name: 'my_profile', component: MyProfile},
    {path: '/editar-perfil', name: 'edit_profile', component: EditProfile},
    {path: '/trocar-senha', name: 'change_password', component: ChangePassword},
    {path: '/endereco', name: 'address', component: Address},
    {path: '*', name: 'page_not_found', component: ErrorComponent, meta: {layout: 'error'}, props: {code: '404'}}
];

export default routes
