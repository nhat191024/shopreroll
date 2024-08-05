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
        ]
    }
]

export default client;