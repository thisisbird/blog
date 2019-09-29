import VueRouter from 'vue-router'; //ES6 Module引入
let routes = [
    {
        path:'/home', //路徑
              component:require('./components/Home.vue').default//Component
    },
    {
        path:'/about',
        component:require('./components/About.vue').default
    }//之後新增路由皆可使用{path:'', component:''}
];
export default new VueRouter({
    mode :'history', //因為Vue router 會自動產生hashtag(#)，俗果你覺得礙事可以加入這行。
    routes //ES6語法，當key和value一樣時可省略key
});

