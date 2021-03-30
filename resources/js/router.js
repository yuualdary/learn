import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

//Define Router
const router = new Router({
    mode :'history',
    routes:[
        {
            path:'/',
            name: 'home',
            alias:'/home',
            component:()=>import('./views/Home.vue')
        },
        {
            path:'/donations',
            name:'donations',
            component:()=>import('./views/Donations.vue')
        },
        {
            path:'/blogs',
            name:'blog',
            component:()=>import('./views/Blogs.vue')
        },
        {
            path:'/campaigns',
            name:'campaign',
            component:()=>import('./views/Campaign.vue')
        },
        {
            path:'/campaigns/:id',
            name:'campaign',
            component:()=>import('./views/CampaignDetail.vue')
        },
        {
            path:'*',
            redirect:'/'
        }
    ]
});

export default router