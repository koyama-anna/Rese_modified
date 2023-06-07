
import { createRouter, createWebHashHistory } from 'vue-router';
import TheShopAll from "./components/TheShopAll.vue";
import TheShopInfo from "./components/TheShopInfo.vue";
import LoginForm from "./components/LoginForm.vue";
import ReserveDone from "./components/ReserveDone.vue";
import MyPage from "./components/MyPage.vue";
import TheMenu from "./components/TheMenu.vue";


const routes = [
{
    path: "/",
    name: "theshopall",
    component: TheShopAll,
},
{
    path:"/detail/:id",
    name:"theshopinfo",
    component: TheShopInfo,
},
{
    path:"/login",
    name:"loginform",
    component: LoginForm,
},
{
    path:"/done",
    name:"reservedone",
    component: ReserveDone,
},
{
    path:"/mypage",
    name:"mypage",
    component: MyPage,
},
{
    path:"/menu",
    name:"themenu",
    component: TheMenu,
}
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('token')
    if (to.name == 'loginform') {
        if (isAuthenticated) {
            next({ name: 'theshopall' })
        }
        next()
    }
    if (!isAuthenticated) {
        next({ name: 'loginform' })
    } else {
        next()
    }
})
export default router;