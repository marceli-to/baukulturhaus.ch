<template>

  <template v-if="formSuccess">
    <success-alert>
      Vielen Dank für Ihre Anfrage!
    </success-alert>
  </template>
  
  <template v-if="formError">
    <error-alert>
      Bitte überprüfen Sie die eingegebenen Daten.
    </error-alert>
  </template>

  <form id="shareholder-private-form" @submit.prevent="submitForm">
    <div class="flex flex-col gap-y-20 md:grid md:grid-cols-2 md:gap-20">

      <form-group class="md:col-span-1">
        <form-text-field
          v-model="form.salutation"
          :error="errors.salutation"
          @update:error="errors.salutation = $event"
          :placeholder="errors.salutation || 'Anrede *'" />
      </form-group>

      <div class="space-y-20 md:space-y-0 md:col-span-full md:flex md:gap-x-20">
        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.firstname"
            :error="errors.firstname"
            @update:error="errors.firstname = $event"
            :placeholder="errors.firstname || 'Vorname *'" />
        </form-group>

        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.name"
            :error="errors.name"
            @update:error="errors.name = $event"
            :placeholder="errors.name || 'Name *'" />
        </form-group>
      </div>

      <form-group class="md:col-span-full">
        <form-text-field
          v-model="form.location"
          :error="errors.location"
          @update:error="errors.location = $event"
          :placeholder="errors.location || 'Strasse / Nr. *'" />
      </form-group> 

      <div class="space-y-20 md:space-y-0 md:col-span-full md:flex md:gap-x-20">
        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.zip"
            :error="errors.zip"
            @update:error="errors.zip = $event"
            :placeholder="errors.zip || 'PLZ *'" />
        </form-group>

        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.city"
            :error="errors.city"
            @update:error="errors.city = $event"
            :placeholder="errors.city || 'Ort *'" />
        </form-group>
      </div>

      <div class="space-y-20 md:space-y-0 md:col-span-full md:flex md:gap-x-20">
        <form-group class="md:flex-1">
          <form-text-field
            type="email"
            v-model="form.email"
            :error="errors.email"
            @update:error="errors.email = $event"
            :placeholder="errors.email || 'E-Mail *'" />
        </form-group>

        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.phone"
            :error="errors.phone"
            @update:error="errors.phone = $event"
            :placeholder="errors.phone || 'Telefon *'" />
        </form-group>
      </div>
      
      <form-group>
        <form-masked-text-field
          v-model="form.dob"
          :error="errors.dob"
          @update:error="errors.dob = $event"
          :placeholder="errors.dob || 'Geburtsdatum *'"
          mask="##.##.####" />
      </form-group>

      <div class="md:col-span-full md:mb-10 md:mt-20">
        <div class="mb-20">
         <heading-2>Upload Dokumente</heading-2>
        </div>
        <div class="flex flex-col gap-y-20">
          <form-group class="md:col-span-full">
            <file-upload
              v-model="form.identity_document"
              name="identity_document"
              label="Identitätsdokument *"
              :error="errors.identity_document"
              @update:error="errors.identity_document = $event" />
          </form-group>

          <form-group class="md:col-span-full">
            <file-upload
              v-model="form.power_of_attorney"
              name="power_of_attorney"
              label="Unterzeichnete Vollmacht *"
              :error="errors.power_of_attorney"
              @update:error="errors.power_of_attorney = $event" />
              <div class="mt-10 md:mt-15">
                <a 
                  href="/assets/downloads/vollmacht.pdf" 
                  target="_blank"
                  class="underline-offset-2 hover:underline flex items-center gap-x-7 md:gap-x-10">
                  <svg class="lg:w-12 lg:h-auto" width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.3594 1.89488V9.99999H2.26706L2.25427 8.61931H7.98155L0.566772 1.19175L1.56393 0.194595L8.9787 7.62215L8.96592 1.89488H10.3594Z" fill="currentColor"></path>
                  </svg>
                  Vollmacht herunterladen
                </a>
              </div>
          </form-group>
        </div>
      </div>

      <form-group>
        <form-button
          type="submit"
          :label="isSubmitting ? 'Wird gesendet...' : 'Absenden'"
          :disabled="isSubmitting"
        />
      </form-group>

    </div>
  </form>

</template>
<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Heading2 from '@/forms/components/headings/h2.vue';
import FormGroup from '@/forms/components/fields/group.vue';
import FormTextField from '@/forms/components/fields/text.vue';
import FormMaskedTextField from '@/forms/components/fields/masked-text.vue';
import FormButton from '@/forms/components/fields/button.vue';
import FileUpload from '@/forms/components/fields/file-upload.vue';
import SuccessAlert from '@/forms/components/alerts/success.vue';
import ErrorAlert from '@/forms/components/alerts/error.vue';
import { useFormScroll } from '@/composables/useFormScroll';

const { scrollToForm } = useFormScroll('#privatperson');

const isSubmitting = ref(false);
const formSuccess = ref(false);
const formError = ref(false);

const form = ref({
  salutation: '',
  firstname: '',
  name: '',
  location: '',
  zip: '',
  city: '',
  email: '',
  phone: '',
  dob: '',
  identity_document: [],
  power_of_attorney: []
});

const errors = ref({
  salutation: '',
  firstname: '',
  name: '',
  location: '',
  zip: '',
  city: '',
  email: '',
  phone: '',
  dob: '',
  identity_document: '',
  power_of_attorney: ''
});

async function submitForm() {
  isSubmitting.value = true;
  formSuccess.value = false;
  formError.value = false;

  try {
    const formData = new FormData();

    // Add all form fields
    formData.append('salutation', form.value.salutation || '');
    formData.append('firstname', form.value.firstname || '');
    formData.append('name', form.value.name || '');
    formData.append('location', form.value.location || '');
    formData.append('zip', form.value.zip || '');
    formData.append('city', form.value.city || '');
    formData.append('email', form.value.email || '');
    formData.append('phone', form.value.phone || '');
    formData.append('dob', form.value.dob || '');

    // Add identity document (single file)
    if (form.value.identity_document && form.value.identity_document.length > 0) {
      formData.append('identity_document', form.value.identity_document[0]);
    }

    // Add power of attorney (single file)
    if (form.value.power_of_attorney && form.value.power_of_attorney.length > 0) {
      formData.append('power_of_attorney', form.value.power_of_attorney[0]);
    }

    const response = await axios.post('/api/shareholder-private', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });
    handleSuccess();
  } catch (error) {
    handleError(error);
  }
}

function handleSuccess() {
  // Reset form
  form.value = {
    salutation: '',
    firstname: '',
    name: '',
    location: '',
    zip: '',
    city: '',
    email: '',
    phone: '',
    dob: '',
    identity_document: [],
    power_of_attorney: []
  };

  errors.value = {
    salutation: '',
    firstname: '',
    name: '',
    location: '',
    zip: '',
    city: '',
    email: '',
    phone: '',
    dob: '',
    identity_document: '',
    power_of_attorney: ''
  };

  isSubmitting.value = false;
  formSuccess.value = true;

  // Scroll to top to show success message after DOM updates
  setTimeout(() => {
    scrollToForm();
  }, 100);
}

function handleError(error) {
  isSubmitting.value = false;
  formError.value = true;
  if (error.response && error.response.data && typeof error.response.data.errors === 'object') {
    Object.keys(error.response.data.errors).forEach(key => {
      const errorValue = error.response.data.errors[key];
      errors.value[key] = Array.isArray(errorValue) ? errorValue[0] : errorValue;
    });
  }

  // Scroll to top to show error message after DOM updates
  setTimeout(() => {
    scrollToForm();
  }, 100);
}
</script>