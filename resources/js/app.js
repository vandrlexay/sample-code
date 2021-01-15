/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { route as _route } from "./routes.js";

const route = function(url) { return "/index.php" + _route(url); };

window.Vue = require('vue').default;

Vue.component('Grid', require('./components/Grid.vue').default);
Vue.component('Toolbar', require('./components/Toolbar.vue').default);
Vue.component('Container', require('./components/Container.vue').default);

const app = new Vue({
    el: '#app',
    template : `<Container 
                  v-on:countryListChange="handleCountryListChange" 
                  v-on:fileUpload="handleFileUpload"
                  v-on:fileDownload="handleFileDownload"
                  v-bind:countryList="countryList" 
                  v-bind:route="route"/>`,
    data : function () {
        return {
            route: route,
            countryList : [
                { "country" : "aaa", "capital" : "AAA" }
            ]
        };
    },
    methods : {
        handleCountryListChange : function(value) {
            this.countryList = value;
        },
        handleFileUpload : function(formData) {
            const component = this;
            axios({
                method: 'POST',
                url: this.route('countryfile/upload'),
                data: formData,
                headers: {'Content-Type': 'multipart/form-data' }
            }).then(function (response) {
                component.countryList = response.data;
            });
        },

        handleFileDownload : function(format) {
            axios({
                method: 'POST',
                url: this.route('countryfile/download'),
                data: {
                    format : format,
                    countryList  : this.countryList
                },
                headers: {'Content-Type': 'multipart/form-data' }
            }).then(function (response) {
                
            });

        }
    }
});
