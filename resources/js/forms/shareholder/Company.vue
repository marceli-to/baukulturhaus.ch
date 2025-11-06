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

  <form id="shareholder-company-form" @submit.prevent="submitForm">
    <div class="flex flex-col gap-y-20 md:grid md:grid-cols-2 md:gap-20">

      <form-group class="md:col-span-full">
        <form-text-field
          v-model="form.company_name"
          :error="errors.company_name"
          @update:error="errors.company_name = $event"
          :placeholder="errors.company_name || 'Offizieller Name Unternehmen *'" />
      </form-group>

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

      <div class="md:col-span-full md:mb-0 md:mt-20">
        <heading-2>Administrativer Kontakt</heading-2>
      </div>

      <form-group class="md:col-span-1">
        <form-text-field
          v-model="form.salutation_admin"
          :error="errors.salutation_admin"
          @update:error="errors.salutation_admin = $event"
          :placeholder="errors.salutation_admin || 'Anrede *'" />
      </form-group>

      <div class="space-y-20 md:space-y-0 md:col-span-full md:flex md:gap-x-20">
        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.firstname_admin"
            :error="errors.firstname_admin"
            @update:error="errors.firstname_admin = $event"
            :placeholder="errors.firstname_admin || 'Vorname *'" />
        </form-group>

        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.name_admin"
            :error="errors.name_admin"
            @update:error="errors.name_admin = $event"
            :placeholder="errors.name_admin || 'Nachname *'" />
        </form-group>
      </div>

      <div class="space-y-20 md:space-y-0 md:col-span-full md:flex md:gap-x-20">
        <form-group class="md:flex-1">
          <form-text-field
            type="email"
            v-model="form.email_admin"
            :error="errors.email_admin"
            @update:error="errors.email_admin = $event"
            :placeholder="errors.email_admin || 'E-Mail *'" />
        </form-group>

        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.phone_admin"
            :error="errors.phone_admin"
            @update:error="errors.phone_admin = $event"
            :placeholder="errors.phone_admin || 'Telefon *'" />
        </form-group>
      </div>

      <div class="md:col-span-full md:mt-20">
        <heading-2>Angaben zeichnungsberechtigte Person</heading-2>
      </div>

      <form-group class="md:col-span-1">
        <form-text-field
          v-model="form.salutation_authorised_to_sign"
          :error="errors.salutation_authorised_to_sign"
          @update:error="errors.salutation_authorised_to_sign = $event"
          :placeholder="errors.salutation_authorised_to_sign || 'Anrede *'" />
      </form-group>

      <div class="space-y-20 md:space-y-0 md:col-span-full md:flex md:gap-x-20">
        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.firstname_authorised_to_sign"
            :error="errors.firstname_authorised_to_sign"
            @update:error="errors.firstname_authorised_to_sign = $event"
            :placeholder="errors.firstname_authorised_to_sign || 'Vorname *'" />
        </form-group>

        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.name_authorised_to_sign"
            :error="errors.name_authorised_to_sign"
            @update:error="errors.name_authorised_to_sign = $event"
            :placeholder="errors.name_authorised_to_sign || 'Nachname *'" />
        </form-group>
      </div>

      <div class="space-y-20 md:space-y-0 md:col-span-full md:flex md:gap-x-20">
        <form-group class="md:flex-1">
          <form-text-field
            type="email"
            v-model="form.email_authorised_to_sign"
            :error="errors.email_authorised_to_sign"
            @update:error="errors.email_authorised_to_sign = $event"
            :placeholder="errors.email_authorised_to_sign || 'E-Mail *'" />
        </form-group>

        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.phone_authorised_to_sign"
            :error="errors.phone_authorised_to_sign"
            @update:error="errors.phone_authorised_to_sign = $event"
            :placeholder="errors.phone_authorised_to_sign || 'Telefon *'" />
        </form-group>
      </div>

      <form-group class="md:col-span-full">
        <form-text-field
          v-model="form.location_authorised_to_sign"
          :error="errors.location_authorised_to_sign"
          @update:error="errors.location_authorised_to_sign = $event"
          :placeholder="errors.location_authorised_to_sign || 'Adresse *'" />
      </form-group>

      <div class="space-y-20 md:space-y-0 md:col-span-full md:flex md:gap-x-20">
        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.zip_authorised_to_sign"
            :error="errors.zip_authorised_to_sign"
            @update:error="errors.zip_authorised_to_sign = $event"
            :placeholder="errors.zip_authorised_to_sign || 'PLZ *'" />
        </form-group>

        <form-group class="md:flex-1">
          <form-text-field
            v-model="form.city_authorised_to_sign"
            :error="errors.city_authorised_to_sign"
            @update:error="errors.city_authorised_to_sign = $event"
            :placeholder="errors.city_authorised_to_sign || 'Ort *'" />
        </form-group>
      </div>

      <form-group>
        <form-masked-text-field
          v-model="form.dob_authorised_to_sign"
          :error="errors.dob_authorised_to_sign"
          @update:error="errors.dob_authorised_to_sign = $event"
          :placeholder="errors.dob_authorised_to_sign || 'Geburtsdatum *'"
          mask="##.##.####" />
      </form-group>

      <div class="md:col-span-full md:mb-10 md:mt-20">
        <div class="mb-20">
          <heading-2>Upload Dokumente</heading-2>
        </div>
        <div class="flex flex-col gap-y-20">
          <form-group class="md:col-span-full">
            <file-upload
              v-model="form.commercial_register"
              name="company_commercial_register"
              label="Auszug Handelsregister *"
              :error="errors.commercial_register"
              @update:error="errors.commercial_register = $event" />
          </form-group>

          <form-group class="md:col-span-full">
            <file-upload
              v-model="form.id_copy"
              name="company_id_copy"
              label="Kopie ID *"
              :error="errors.id_copy"
              @update:error="errors.id_copy = $event" />
          </form-group>

          <form-group class="md:col-span-full">
            <file-upload
              v-model="form.power_of_attorney"
              name="company_power_of_attorney"
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

const { scrollToForm } = useFormScroll('#unternehmen');

const isSubmitting = ref(false);
const formSuccess = ref(false);
const formError = ref(false);

const form = ref({
  company_name: '',
  location: '',
  zip: '',
  city: '',
  salutation_admin: '',
  firstname_admin: '',
  name_admin: '',
  email_admin: '',
  phone_admin: '',
  salutation_authorised_to_sign: '',
  firstname_authorised_to_sign: '',
  name_authorised_to_sign: '',
  email_authorised_to_sign: '',
  phone_authorised_to_sign: '',
  location_authorised_to_sign: '',
  zip_authorised_to_sign: '',
  city_authorised_to_sign: '',
  dob_authorised_to_sign: '',
  commercial_register: [],
  id_copy: [],
  power_of_attorney: []
});

const errors = ref({
  company_name: '',
  location: '',
  zip: '',
  city: '',
  salutation_admin: '',
  firstname_admin: '',
  name_admin: '',
  email_admin: '',
  phone_admin: '',
  salutation_authorised_to_sign: '',
  firstname_authorised_to_sign: '',
  name_authorised_to_sign: '',
  email_authorised_to_sign: '',
  phone_authorised_to_sign: '',
  location_authorised_to_sign: '',
  zip_authorised_to_sign: '',
  city_authorised_to_sign: '',
  dob_authorised_to_sign: '',
  commercial_register: '',
  id_copy: '',
  power_of_attorney: ''
});

async function submitForm() {
  isSubmitting.value = true;
  formSuccess.value = false;
  formError.value = false;

  try {
    const formData = new FormData();

    // Add all form fields
    formData.append('company_name', form.value.company_name || '');
    formData.append('location', form.value.location || '');
    formData.append('zip', form.value.zip || '');
    formData.append('city', form.value.city || '');
    formData.append('salutation_admin', form.value.salutation_admin || '');
    formData.append('firstname_admin', form.value.firstname_admin || '');
    formData.append('name_admin', form.value.name_admin || '');
    formData.append('email_admin', form.value.email_admin || '');
    formData.append('phone_admin', form.value.phone_admin || '');
    formData.append('salutation_authorised_to_sign', form.value.salutation_authorised_to_sign || '');
    formData.append('firstname_authorised_to_sign', form.value.firstname_authorised_to_sign || '');
    formData.append('name_authorised_to_sign', form.value.name_authorised_to_sign || '');
    formData.append('email_authorised_to_sign', form.value.email_authorised_to_sign || '');
    formData.append('phone_authorised_to_sign', form.value.phone_authorised_to_sign || '');
    formData.append('location_authorised_to_sign', form.value.location_authorised_to_sign || '');
    formData.append('zip_authorised_to_sign', form.value.zip_authorised_to_sign || '');
    formData.append('city_authorised_to_sign', form.value.city_authorised_to_sign || '');
    formData.append('dob_authorised_to_sign', form.value.dob_authorised_to_sign || '');

    // Add commercial register (single file)
    if (form.value.commercial_register && form.value.commercial_register.length > 0) {
      formData.append('commercial_register', form.value.commercial_register[0]);
    }

    // Add ID copy (single file)
    if (form.value.id_copy && form.value.id_copy.length > 0) {
      formData.append('id_copy', form.value.id_copy[0]);
    }

    // Add power of attorney (single file)
    if (form.value.power_of_attorney && form.value.power_of_attorney.length > 0) {
      formData.append('power_of_attorney', form.value.power_of_attorney[0]);
    }

    const response = await axios.post('/api/shareholder-company', formData, {
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
    company_name: '',
    location: '',
    zip: '',
    city: '',
    salutation_admin: '',
    firstname_admin: '',
    name_admin: '',
    email_admin: '',
    phone_admin: '',
    salutation_authorised_to_sign: '',
    firstname_authorised_to_sign: '',
    name_authorised_to_sign: '',
    email_authorised_to_sign: '',
    phone_authorised_to_sign: '',
    location_authorised_to_sign: '',
    zip_authorised_to_sign: '',
    city_authorised_to_sign: '',
    dob_authorised_to_sign: '',
    commercial_register: [],
    id_copy: [],
    power_of_attorney: []
  };

  errors.value = {
    company_name: '',
    location: '',
    zip: '',
    city: '',
    salutation_admin: '',
    firstname_admin: '',
    name_admin: '',
    email_admin: '',
    phone_admin: '',
    salutation_authorised_to_sign: '',
    firstname_authorised_to_sign: '',
    name_authorised_to_sign: '',
    email_authorised_to_sign: '',
    phone_authorised_to_sign: '',
    location_authorised_to_sign: '',
    zip_authorised_to_sign: '',
    city_authorised_to_sign: '',
    dob_authorised_to_sign: '',
    commercial_register: '',
    id_copy: '',
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
