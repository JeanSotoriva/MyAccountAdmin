import Pessoa from '@/pages/Pessoa.vue';
import Conta from '@/pages/Conta.vue';
import Movimentacao from '@/pages/Movimentacao.vue';

const routes = [
    {
        path: '/',
        redirect: '/pessoa',
        component: () => import('@/layouts/DefaultTemplate'),
            children: [
            {
                path: '/pessoa',
                component: Pessoa,
                name: 'pessoa',
            },
            {
                path: '/movimentacao',
                component: Movimentacao,
                name: 'movimentacao',
            },
            {
                path: '/conta',
                component: Conta,
                name: 'conta',
            },
        ]
    }
]

export default routes