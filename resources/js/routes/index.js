import {createRouter, createWebHistory} from 'vue-router';

import HomeView from "../views/HomeView.vue";
import AreaView from "../views/AreaView.vue";
import AdminView from "../views/admin/AdminView.vue";

const routes = [
    {path: '/', name: 'HomeView', component: HomeView},
    {path: '/area', name: 'AreaView', component: AreaView},
    {path: '/admin', name: 'AdminView', component: AdminView, meta: {layout: 'AdminLayout'}},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
