/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import moment from "moment";

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.DateMNS = {
    getDatePassMonth: function() {
        moment.locale("ru");
        return moment().add(1, 'month').format("L LT");
    },

    getCurrentAloha: function (){
        let current_hour = moment().hours();
        if(current_hour >= 6 && current_hour < 12){
            return "Доброе утро, ";
        }
        else if(current_hour >= 12 && current_hour < 18){
            return "Добрый день, ";
        }
        else if(current_hour >= 18 && current_hour < 21){
            return "Добрый вечер, ";
        }
        else {
            return "Доброй ночи, ";
        }
    }
}

