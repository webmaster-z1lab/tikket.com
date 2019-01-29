import MyProfile from './view/MyProfile'
import EditProfile from './view/EditProfile'
import ChangePassword from './view/ChangePassword'
import MyCompanies from './view/MyCompanies'
import MySubscriptions from './view/MySubscriptions'
import Address from './view/Address'
import Vue404 from '../components/erros/404'

const routes = [
    {path: '/', name: 'home', redirect: {name: 'my_profile'}},
    {path: '/my-profile', name: 'my_profile', component: MyProfile},
    {path: '/edit-profile', name: 'edit_profile', component: EditProfile},
    {path: '/change-password', name: 'change_password', component: ChangePassword},
    {path: '/my-companies', name: 'my_companies', component: MyCompanies},
    {path: '/my-subscriptions', name: 'my_subscriptions', component: MySubscriptions},
    {path: '/address', name: 'address', component: Address},
    {path: '*', name: 'page_not_found', component: Vue404}
];

export default routes
