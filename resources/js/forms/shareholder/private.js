import { createApp } from 'vue';
import ShareholderPrivateForm from './Private.vue';
const app = createApp({});
app.component('shareholder-private-form', ShareholderPrivateForm);
if (document.getElementById('shareholder-private-form')) {
  app.mount('#shareholder-private-form');
}