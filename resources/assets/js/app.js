

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Axios from '../../../node_modules/axios';

Vue.use(VueRouter)

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('custom-vue-avatar', require('./components/vue-avatar.vue'));
let myheader = require('./components/header.vue');
let saveimage = require('./components/saveimage.vue');
let myfooter = require('./components/footer.vue');
let myhome = require('./components/home.vue');
let myabout = require('./components/about.vue');
let uploadForm1=require('./components/uploadform1.vue');

const routes = [
    { path: '/myhome', component: myhome },
    { path: '/myabout', component: myabout }
]

const router = new VueRouter({
    routes,// short for `routes: routes`
    // mode:'history',
})
const app = new Vue({
    el: '#app',
    router,

    components: {
        saveimage,
        myheader,
        myfooter,
        uploadForm1,

    },

    created() {
        console.log('7777');

    },

    data() {

        return {

            list: {
                name: '',
                email: '',
                phone: '',
                image:''

            },
            person:
            {
                name: '',
                email: '',
                phone: '',
                url:''
            },
            personupdate:
            {
                name: '',
                email: '',
                phone: '',
            },
            PB: [],
            errors: {
                name: '',
                email: '',
                phone: '',
            }
            ,
            temp: ''
            ,
            lastadd: '',
            loading: true,
            searchquiry: '',
            imageurl: ''
        }

    }

    ,

    mounted() {
        this.loading = true;

        axios

            .post('getdata')
            .then(response => {

                this.PB = this.temp = response.data
                this.loading = false

            })
            .catch(error => {
                console.log(error)
                // this.errors =error.response.data
            })
            .finally(() => this.loading = false)
    },
    watch: {
        searchquiry() {

            if (this.searchquiry.length > 0) {
                // this.temp = this.PB.filter((item) => {
                //     return item.name.indexOf(this.searchquiry) > -1

                // });
                var x = this.searchquiry

                this.temp = this.PB.filter(function (el) {
                    var phone = String(el.phone)
                    return el.name.includes(x) || el.email.includes(x) || phone.includes(x);
                });

                console.log(this.temp);

            }

            else {
                this.temp = this.PB;
            }

        }

    },
    methods: {

        getimage(e) {

            let image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.imageurl = e.target.result;

                this.list['image'] = this.imageurl;
               // console.log(this.list['image'])
            }

        },

        upload() {

            axios
            .post('/upload',{'image':this.imageurl} )
          
        }
        ,
        save() {
            this.loading = true
           
            axios
                .post('/phoneBook',this.$data.list )
                .then(response => {

                    this.PB.push(response.data);
                    this.PB.sort(function (a, b) {
                        if (a.name >= b.name) {
                            return 1;
                        }
                        else if (a.name < b.name) {
                            return -1;
                        }

                    })
                    this.lastadd = this.list.name
                    this.list.name = "",
                        this.list.email = '',
                        this.list.phone = '',
                        this.loading = false
                    this.errors = {}

                    console.log(response.data);

                })
                .catch(error => {
                    console.log(error)
                    this.errors = error.response.data.errors
                })
                .finally(() => this.loading = false)
        },

        showdata(key) {

            this.person = this.temp[key];
            this.personupdate = this.temp[key];
            // console.log(this.list);
        }
        , saveedit() {
            this.loading = true;
            axios
                .patch('/phoneBook/38', this.$data.personupdate)
                .then(response => {

                    this.errors = {}
                    this.loading = false;
                    this.PB.sort(function (a, b) {
                        if (a.name >= b.name) {
                            return 1;
                        }
                        else if (a.name < b.name) {
                            return -1;
                        }

                    })

                })
                .catch(error => {
                    console.log(error)
                    this.errors = error.response.data.errors
                })
                .finally(() => this.loading = false)
        },

        del(key, id) {

            if (confirm("are you syre to delet it")) {

                this.loading = true;
                axios
                    .delete(`/phoneBook/${id}`)
                    .then(response => {

                        this.temp.splice(key, 1)
                        this.loading = false

                    })
                    .catch(error => {
                        console.log(error)
                        // this.errors = error.response.data.errors
                    })
                    .finally(() => this.loading = false)
            }

        }

    }

});
