import { createApp } from 'vue';
import ShareholderCompanyForm from './Company.vue';
const app = createApp({});
app.component('shareholder-company-form', ShareholderCompanyForm);
if (document.getElementById('shareholder-company-form')) {
  app.mount('#shareholder-company-form');
}