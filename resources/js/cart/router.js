import Information from './view/Information'
import Payment from './view/Payment'
import Conclusion from './view/Conclusion'
import Vue404 from '../components/erros/404'

const withPrefix = (prefix, routes) =>
    routes.map( (route) => {
        route.path = prefix + route.path;
        return route;
    });

const routes = [
    {path: '/', name: 'home', redirect: 'information'},
    {path: '/information', name: 'information', component: Information},
    {path: '/payment', name: 'payment', component: Payment},
    {path: '/conclusion', name: 'conclusion', component: Conclusion},
    {path: '*', name: 'page_not_found', component: Vue404}
];

export default routes
