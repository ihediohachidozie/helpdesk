import VueRouter from 'vue-router';
import Home from './components/home';
import Profile from './components/profile';
import Department from './components/department';
import Software from './components/software';
import Device from './components/device';
import IssueCategory from './components/issueCategory';
import Customer from './components/customer';
import Ticket from './components/ticket';
import Search from './components/search';
import OpenTickets from './components/openTickets';
import WIPTickets from './components/wiptickets';
import ClosedTickets from './components/closedtickets';
import Survey from './components/survey';

let routes = [
    { path: '/home', component: Home },
    { path: '/storage/profile', component: Profile },
    { path: '/home/department', component: Department },
    { path: '/home/software', component: Software },
    { path: '/home/customer', component: Customer },
    { path: '/home/device', component: Device },
    { path: '/home/search', component: Search },
    { path: '/home/issueCategory', component: IssueCategory },
    { path: '/home/ticket', component: Ticket },
    { path: '/home/wiptickets', component: WIPTickets },
    { path: '/home/openTickets', component: OpenTickets },
    { path: '/home/closedtickets', component: ClosedTickets },
    { path: '/home/survey', component: Survey }

]
export default new VueRouter({
    routes,
    mode: 'history'
});