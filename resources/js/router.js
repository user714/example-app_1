import { createRouter, createWebHistory } from "vue-router";


const  router = createRouter({
    routes:[
        {
            path: "/",
            component: () => import('./components/Home.vue'),
            name: "journal_list"

        },
        {
            path: "/users",
            component: () => import('./components/Users.vue'),
            name: "users_list"

        },
        {
            path: "/operators",
            component: () => import('./components/Operators.vue'),
            name: "operators_list"

        },
        {
            path: "/all_time_user_stats",
            component: () => import('./components/All_time_user_stats.vue'),
            name: "all_time_user_stats"

        },
        {
            path: "/journal_create_element",
            component: () => import('./components/Journal_create_element.vue'),
            name: "journal_create_element"

        },
        {
            path: "/user_create",
            component: () => import('./components/User_create.vue'),
            name: "user_create"

        },
        {
            path: "/operator_create",
            component: () => import('./components/Operator_create.vue'),
            name: "operator_create"

        },
        {
            path: "/operator/:id/phone_numbers_list",
            component: () => import('./components/Operator_phone_numbers_list.vue'),
            name: "operator_phone_numbers_list"

        },
        {
            path: "/operator/:id/price_list",
            component: () => import('./components/Operator_price_list.vue'),
            name: "operator_price_list"

        },
        {
            path: "/operator/:id/create_number_phone",
            component: () => import('./components/Operator_number_phone_create.vue'),
            name: "operator_create_number_phone"

        },


    ],
    history:  createWebHistory(),
})


export default router
