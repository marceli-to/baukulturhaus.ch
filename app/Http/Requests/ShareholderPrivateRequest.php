<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ShareholderPrivateRequest extends FormRequest
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
      'salutation' => 'required|string',
      'firstname' => 'required|string',
      'name' => 'required|string',
      'location' => 'required|string',
      'zip' => 'required|string|max:20',
      'city' => 'required|string',
      'email' => 'required|email|regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
      'phone' => 'required|string',
      'dob' => 'required|string',
      'identity_document' => 'required|file|mimes:png,jpg,jpeg,pdf|max:20480',
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
      'salutation.required' => 'Anrede ist erforderlich',
      'firstname.required' => 'Vorname ist erforderlich',
      'name.required' => 'Name ist erforderlich',
      'location.required' => 'Strasse / Nr. ist erforderlich',
      'zip.required' => 'PLZ ist erforderlich',
      'city.required' => 'Ort ist erforderlich',
      'email.required' => 'E-Mail ist erforderlich',
      'email.email' => 'E-Mail muss gültig sein',
      'email.regex' => 'E-Mail muss gültig sein',
      'phone.required' => 'Telefon ist erforderlich',
      'dob.required' => 'Geburtsdatum ist erforderlich',
      'identity_document.required' => 'Kopie ID ist erforderlich',
      'identity_document.file' => 'Kopie ID muss eine Datei sein',
      'identity_document.mimes' => 'Kopie ID muss eine PNG, JPG, JPEG oder PDF Datei sein',
      'identity_document.max' => 'Kopie ID darf maximal 20 MB groß sein',
      'power_of_attorney.required' => 'Unterzeichnete Vollmacht ist erforderlich',
      'power_of_attorney.file' => 'Unterzeichnete Vollmacht muss eine Datei sein',
      'power_of_attorney.mimes' => 'Unterzeichnete Vollmacht muss eine PNG, JPG, JPEG oder PDF Datei sein',
      'power_of_attorney.max' => 'Unterzeichnete Vollmacht darf maximal 20 MB groß sein',
    ];
  }
}
