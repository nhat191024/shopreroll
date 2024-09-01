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
            }
        ],
    }
]

export default client;