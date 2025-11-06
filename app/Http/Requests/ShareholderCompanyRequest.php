<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShareholderCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'required|string',
            'location' => 'required|string',
            'zip' => 'required|string|max:20',
            'city' => 'required|string',
            'salutation_admin' => 'required|string',
            'firstname_admin' => 'required|string',
            'name_admin' => 'required|string',
            'email_admin' => 'required|email|regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
            'phone_admin' => 'required|string',
            'salutation_authorised_to_sign' => 'required|string',
            'firstname_authorised_to_sign' => 'required|string',
            'name_authorised_to_sign' => 'required|string',
            'email_authorised_to_sign' => 'required|email|regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
            'phone_authorised_to_sign' => 'required|string',
            'location_authorised_to_sign' => 'required|string',
            'zip_authorised_to_sign' => 'required|string|max:20',
            'city_authorised_to_sign' => 'required|string',
            'dob_authorised_to_sign' => 'required|string',
            'commercial_register' => 'required|file|mimes:png,jpg,jpeg,pdf|max:20480',
            'id_copy' => 'required|file|mimes:png,jpg,jpeg,pdf|max:20480',
            'power_of_attorney' => 'required|file|mimes:png,jpg,jpeg,pdf|max:20480',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'company_name.required' => 'Firmenname ist erforderlich',
            'location.required' => 'Strasse / Nr. ist erforderlich',
            'zip.required' => 'PLZ ist erforderlich',
            'city.required' => 'Ort ist erforderlich',
            'salutation_admin.required' => 'Anrede ist erforderlich',
            'firstname_admin.required' => 'Vorname ist erforderlich',
            'name_admin.required' => 'Name ist erforderlich',
            'email_admin.required' => 'E-Mail ist erforderlich',
            'email_admin.email' => 'E-Mail muss gültig sein',
            'email_admin.regex' => 'E-Mail muss gültig sein',
            'phone_admin.required' => 'Telefon ist erforderlich',
            'salutation_authorised_to_sign.required' => 'Anrede ist erforderlich',
            'firstname_authorised_to_sign.required' => 'Vorname ist erforderlich',
            'name_authorised_to_sign.required' => 'Name ist erforderlich',
            'email_authorised_to_sign.required' => 'E-Mail ist erforderlich',
            'email_authorised_to_sign.email' => 'E-Mail muss gültig sein',
            'email_authorised_to_sign.regex' => 'E-Mail muss gültig sein',
            'phone_authorised_to_sign.required' => 'Telefon ist erforderlich',
            'location_authorised_to_sign.required' => 'Adresse ist erforderlich',
            'zip_authorised_to_sign.required' => 'PLZ ist erforderlich',
            'city_authorised_to_sign.required' => 'Ort ist erforderlich',
            'dob_authorised_to_sign.required' => 'Geburtsdatum ist erforderlich',
            'commercial_register.required' => 'Auszug Handelsregister ist erforderlich',
            'commercial_register.file' => 'Auszug Handelsregister muss eine Datei sein',
            'commercial_register.mimes' => 'Auszug Handelsregister muss eine PNG, JPG, JPEG oder PDF Datei sein',
            'commercial_register.max' => 'Auszug Handelsregister darf maximal 20 MB groß sein',
            'id_copy.required' => 'Kopie ID ist erforderlich',
            'id_copy.file' => 'Kopie ID muss eine Datei sein',
            'id_copy.mimes' => 'Kopie ID muss eine PNG, JPG, JPEG oder PDF Datei sein',
            'id_copy.max' => 'Kopie ID darf maximal 20 MB groß sein',
            'power_of_attorney.required' => 'Unterzeichnete Vollmacht ist erforderlich',
            'power_of_attorney.file' => 'Unterzeichnete Vollmacht muss eine Datei sein',
            'power_of_attorney.mimes' => 'Unterzeichnete Vollmacht muss eine PNG, JPG, JPEG oder PDF Datei sein',
            'power_of_attorney.max' => 'Unterzeichnete Vollmacht darf maximal 20 MB groß sein',
        ];
    }
}
