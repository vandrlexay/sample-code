/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { route } from "./routes.js";
import saveAs from "file-saver";
import axios from "axios";
import Vue from "vue";
window.Vue = Vue;

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
                  v-bind:fileTypes="fileTypes" 
                  />`,
    
    data : function () {
        return {
            fileTypes : [],
            countryList : [
                { "country" : "", "capital" : "" }
            ]
        };
    },
    
    created : function() {
        const app = this;
        axios.get(
            route('countryfile/listFormats')).then(
                (response) => app.fileTypes = response.data
            );
    },
    
    methods : {
        handleCountryListChange : function(value) {
            this.countryList = value;
        },
        handleFileUpload : function(formData) {
            const component = this;
            axios({
                method: 'POST',
                url: route('countryfile/upload'),
                data: formData,
                headers: {'Content-Type': 'multipart/form-data' }
            }).then(function (response) {
                if (response.data.error !== undefined) {
                    alert(response.data.error);
                    return;
                }
                
                component.countryList = response.data;
            });
        },

        handleFileDownload : function(format) {
            axios({
                method: 'POST',
                url: route('countryfile/download'),
                data: {
                    format : format,
                    countryList  : this.countryList
                },
                headers: {'Content-Type': 'multipart/form-data' }
            }).then(function (response) {
                const blob = new Blob([response.data.data], {type: response.data.mime});
                saveAs(blob, "countries." + format );
            });

        }
    }
});
