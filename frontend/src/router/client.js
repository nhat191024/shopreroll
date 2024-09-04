const client = [
    {
        path: '/',
        component: () => import('@/layouts/Client.vue'),
        children: [
            {
                path: '',
                component: () => import('@/views/client/Home.vue'),
                name: 'home',
                meta: {
                    title: 'Home'
                }
            },
            {
                path: 'login',
                component: () => import('@/views/client/Login.vue'),
                name: 'login',
                meta: {
                    title: 'Login'
                }
            },
            {
                path: 'register',
                component: () => import('@/views/client/Register.vue'),
                name: 'register',
                meta: {
                    title: 'Register'
                }
            },
            {
                path: 'top-up',
                component: () => import('@/views/client/TopUp.vue'),
                children: [
                    {
                        path: 'bank',
                        component: () => import('@/components/client/home/TopUp-bank.vue'),
                        name: 'top-up-bank',
                        meta: {
                            title: 'Top Up Bank'
                        }
                    },
                    {
                        path: 'card',
                        component: () => import('@/components/client/home/TopUp-card.vue'),
                        name: 'top-up-card',
                        meta: {
                            title: 'Top Up Card'
                        }
                    }
                ]
            }
        ],
    }
]

export default client;