import Information from './components/view/Information'
import Payment from './components/view/Payment'
import Conclusion from './components/view/Conclusion'
import ErrorComponent from '../components/errorComponent'

const routes = [
    {path: '/', name: 'home', redirect: {name: 'information'}},
    {path: '/information', name: 'information', component: Information, meta: {title: 'Titularidade dos ingressos'}},
    {path: '/payment', name: 'payment', component: Payment, meta: {title: 'Formas de pagamento'}},
    {path: '/conclusion', name: 'conclusion', component: Conclusion, meta: {layout: 'invoice', conclusionCart: true, title: 'Pedido concluído'}},
    {path: '/error/:code/:title?/:message?', name: 'error', component: ErrorComponent, meta: {layout: 'error'}, props: true},
    {path: '*', name: 'page_not_found', component: ErrorComponent, meta: {layout: 'error'}, props: {code: '404'}}
];

export default routes
