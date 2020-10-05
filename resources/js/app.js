/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

import { responseTemplate } from './responseTemplate.js';

class AppForm {
    onLoad() {
        this.listenAddCustomerForm();
        this.listenGetCustomerQuoteForm();
    }
    listenGetCustomerQuoteForm() {
        const form = document.querySelector('.submit-customer-quote');
        if (form) {
            form.addEventListener('click', this.submitGetCustomerQuoteForm.bind(this));
        }
    }
    submitGetCustomerQuoteForm(event) {
        event.preventDefault();
        const formData = {
            email: (document.querySelector('.input-email')).value,
            api_token: (document.querySelector('meta[name="auth-token"]')).content,
            _token: (document.querySelector('meta[name="csrf-token"]')).content
        };
        $.ajax({
            type: 'POST',
            url: 'api/get-customer-quote',
            data: formData,
            headers: {
                'api_token': formData.api_token,
                'X-CSRF-TOKEN':formData._token
            },
            success: function(response) {
                const template = new responseTemplate(document.querySelector('.quote-response-list'));
                template.render(response, 'success-get-quote');
            },
            error: function(response) {
                const template = new responseTemplate(document.querySelector('.response-list'));
                template.render(response.responseJSON.error, 'error-validation');
            }
        });
    }
    listenAddCustomerForm() {
        const form = document.querySelector('.submit-add-customer');
        if (form) {
            form.addEventListener('click', this.submitAddCustomerForm.bind(this));
        }
    }
    submitAddCustomerForm(event) {
        event.preventDefault();
        const formData = {
            name: (document.querySelector('.input-name')).value,
            email: (document.querySelector('.input-email')).value,
            premium_price: (document.querySelector('.input-premium-price')).value,
            api_token: (document.querySelector('meta[name="auth-token"]')).content,
            _token: (document.querySelector('meta[name="csrf-token"]')).content
        };
        $.ajax({
            type: 'POST',
            url: 'api/store-customer',
            data: formData,
            headers: {
                'api_token': formData.api_token,
                'X-CSRF-TOKEN':formData._token
            },
            success: function(response) {
                const template = new responseTemplate(document.querySelector('.response-list'));
                template.render(response);
                document.querySelector('.input-name').value = '';
                document.querySelector('.input-email').value = '';
                document.querySelector('.input-premium-price').value = '';
            },
            error: function(response) {
                const template = new responseTemplate(document.querySelector('.response-list'));
                template.render(response.responseJSON.error, 'error-validation');
            }
        });
    }
}

const appForm = new AppForm();
appForm.onLoad();