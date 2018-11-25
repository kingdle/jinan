import VueRouter from 'vue-router'
import Store from './store/index'
import jwtToken from './helpers/jwt'

let routes = [
    {
        path: '/',
        name: 'home',
        component: (resolve)=>require(['./components/pages/Home'],resolve),
        meta: {}
    },
    {
        path: '/about',
        component: (resolve)=>require(['./components/pages/About'],resolve),
        meta: {}
    },
    {
        path: '/shops/:id',
        name: 'shops',
        component: (resolve)=>require(['./components/shops/Shop'],resolve),
        meta: {requiresAuth: true}
    },
    {
        path: '/register',
        name: 'register',
        component: (resolve)=>require(['./components/register/Register'],resolve),
        meta: {requiresGuest: true}
    },
    {
        path: '/login',
        name: 'login',
        component: (resolve)=>require(['./components/login/Login'],resolve),
        meta: {requiresGuest: true}
    },
    {
        path: '/profile',
        component: (resolve)=>require(['./components/profiles/ProfileWrapper'],resolve),
        children: [
            {
                path: '/confirm',
                name: 'confirm',
                component: (resolve)=>require(['./components/confirm/Email'],resolve),
                meta: {requiresGuest: true}
            },
            {
                path: '',
                name: 'profile',
                component: (resolve)=>require(['./components/buyers/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-profile',
                name: 'profile.editProfile',
                component: (resolve)=>require(['./components/user/EditProfile'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-password',
                name: 'profile.editPassword',
                component: (resolve)=>require(['./components/password/EditPassword'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/receptions',
                name: 'profile.Reception',
                component: (resolve)=>require(['./components/receptions/Receptions'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-shop',
                name: 'profile.editShop',
                component: (resolve)=>require(['./components/shops/EditShop'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/gifts',
                name: 'profile.Orders',
                component: (resolve)=>require(['./components/buyers/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/works',
                name: 'profile.News',
                component: (resolve)=>require(['./components/news/News'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/addnews',
                name: 'AddNews',
                component: (resolve)=>require(['./components/news/AddNews'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/dynamic',
                name: 'Dynamic',
                component: (resolve)=>require(['./components/news/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/home',
                name: 'profile.Home',
                component: (resolve)=>require(['./components/home/Home'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/seed',
                name: 'profile.Seed',
                component: (resolve)=>require(['./components/seeds/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/seed/:id',
                name: 'profile.editSeed',
                component: (resolve)=>require(['./components/seeds/Seed'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/hotel',
                name: 'profile.Seller',
                component: (resolve)=>require(['./components/buyers/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/config',
                name: 'profile.Buyer',
                component: (resolve)=>require(['./components/buyers/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/fees',
                name: 'profile.Fees',
                component: (resolve)=>require(['./components/fees/Fees'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/customers',
                name: 'profile.Customers',
                component: (resolve)=>require(['./components/customers/Customers'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/agreements',
                name: 'profile.Agreements',
                component: (resolve)=>require(['./components/agreements/Agreements'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/positions',
                name: 'profile.Positions',
                component: (resolve)=>require(['./components/positions/Positions'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/users',
                name: 'profile.Users',
                component: (resolve)=>require(['./components/users/Users'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/inletplan',
                name: 'profile.Inletplan',
                component: (resolve)=>require(['./components/inletplan/Inletplan'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/inlet',
                name: 'profile.Inlet',
                component: (resolve)=>require(['./components/inlet/Inlet'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/outletplan',
                name: 'profile.Outletplan',
                component: (resolve)=>require(['./components/outletplan/Outletplan'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/outlet',
                name: 'profile.Outlet',
                component: (resolve)=>require(['./components/outlet/Outlet'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/transfers',
                name: 'profile.Transfers',
                component: (resolve)=>require(['./components/transfers/Transfers'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/changes',
                name: 'profile.Changes',
                component: (resolve)=>require(['./components/changes/Changes'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/charges',
                name: 'profile.Charges',
                component: (resolve)=>require(['./components/charges/Charges'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/charges-customer',
                name: 'profile.Charges-customer',
                component: (resolve)=>require(['./components/charges-customer/Charges-customer'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/payments',
                name: 'profile.Payments',
                component: (resolve)=>require(['./components/payments/Payments'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/statistics',
                name: 'profile.Statistics',
                component: (resolve)=>require(['./components/statistics/Statistics'],resolve),
                meta: {requiresAuth: true}
            },
        ],
        meta: {requiresAuth: true}
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
    if (Store.state.AuthUser.authenticated || jwtToken.getToken()) {
        return next()
    } else {
        return next({'name': 'login'})
    }
}
if (to.meta.requiresGuest) {
    if (Store.state.AuthUser.authenticated || jwtToken.getToken()) {
        return next({'name': 'home'})
    } else {
        return next()
    }
}
next()
})

export default router
