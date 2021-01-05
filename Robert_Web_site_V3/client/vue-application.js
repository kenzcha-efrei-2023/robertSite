const Home = window.httpVueLoader('./components/Home.vue')
const Register = window.httpVueLoader('./components/Register.vue')
const Login = window.httpVueLoader('./components/Login.vue')
const Profil = window.httpVueLoader('./components/Profil.vue')
const Etat = window.httpVueLoader('./components/Etat.vue')
const Conseil = window.httpVueLoader('./components/Conseil.vue')

const routes = [
    { path: '/', component: Home },
    { path: '/register', component: Register },
    { path: '/login', component: Login },
    { path: '/profil', component: Profil },
    { path: '/etat', component: Etat },
    { path: '/conseil', component: Conseil }

]

const router = new VueRouter({
    routes
})

var app = new Vue({
    router,
    el: '#app',
    data: {
        profil: {
            createdAt: null,
        }


    },
    async mounted() {
        const res2 = await axios.get('/api/profil')
        this.profil = res2.data
    },
    methods: {}
})