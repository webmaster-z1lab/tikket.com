import Information from './components/view/Information'
import Payment from './components/view/Payment'
import Conclusion from './components/view/Conclusion'
import ErrorComponent from '../components/errorComponent'

const routes = [
    {path: '/', name: 'home', redirect: {name: 'information'}},
    {path: '/information', name: 'information', component: Information},
    {path: '/payment', name: 'payment', component: Payment},
    {path: '/conclusion', name: 'conclusion', component: Conclusion, meta: { layout: 'invoice', conclusionCart: true }},
    {path: '/error/:code/:title?/:message?', name: 'error', component: ErrorComponent, meta: {layout: 'error'}, props: true},
    {path: '*', name: 'page_not_found', component: ErrorComponent, meta: {layout: 'error'}, props: {code: '404'}}
];

export default routes
