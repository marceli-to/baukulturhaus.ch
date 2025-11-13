<x-mail::message>
<div class="text-base">
Guten Tag
</div>
<br>
<div class="text-base">
Vielen Dank für Ihre Unterlagen
</div>
<br>
<div class="text-base">
Wir haben folgende Angaben gespeichert:
</div>
<br>
@if ($data['company_name'])
<div class="text-base">
<strong>Firmenname</strong><br>
{{ $data['company_name'] }}
</div>
<br>
@endif
@if (isset($data['location']) && $data['location'])
<div class="text-base">
<strong>Strasse / Nr.</strong><br>
{{ $data['location'] }}
</div>
<br>
@endif
@if (isset($data['zip']) && $data['zip'])
<div class="text-base">
<strong>PLZ</strong><br>
{{ $data['zip'] }}
</div>
<br>
@endif
@if (isset($data['city']) && $data['city'])
<div class="text-base">
<strong>Ort</strong><br>
{{ $data['city'] }}
</div>
<br>
@endif
<div class="text-base">
<strong>Administrativer Kontakt</strong>
</div>
<br>
@if (isset($data['salutation_admin']) && $data['salutation_admin'])
<div class="text-base">
<strong>Anrede</strong><br>
{{ $data['salutation_admin'] }}
</div>
<br>
@endif
@if ($data['firstname_admin'])
<div class="text-base">
<strong>Vorname</strong><br>
{{ $data['firstname_admin'] }}
</div>
<br>
@endif
@if ($data['name_admin'])
<div class="text-base">
<strong>Name</strong><br>
{{ $data['name_admin'] }}
</div>
<br>
@endif
@if ($data['email_admin'])
<div class="text-base">
<strong>E-Mail</strong><br>
{{ $data['email_admin'] }}
</div>
<br>
@endif
@if (isset($data['phone_admin']) && $data['phone_admin'])
<div class="text-base">
<strong>Telefon</strong><br>
{{ $data['phone_admin'] }}
</div>
<br>
@endif
<div class="text-base">
<strong>Angaben zeichnungsberechtigte Person</strong>
</div>
<br>
@if (isset($data['salutation_authorised_to_sign']) && $data['salutation_authorised_to_sign'])
<div class="text-base">
<strong>Anrede</strong><br>
{{ $data['salutation_authorised_to_sign'] }}
</div>
<br>
@endif
@if ($data['firstname_authorised_to_sign'])
<div class="text-base">
<strong>Vorname</strong><br>
{{ $data['firstname_authorised_to_sign'] }}
</div>
<br>
@endif
@if ($data['name_authorised_to_sign'])
<div class="text-base">
<strong>Name</strong><br>
{{ $data['name_authorised_to_sign'] }}
</div>
<br>
@endif
@if (isset($data['email_authorised_to_sign']) && $data['email_authorised_to_sign'])
<div class="text-base">
<strong>E-Mail</strong><br>
{{ $data['email_authorised_to_sign'] }}
</div>
<br>
@endif
@if (isset($data['phone_authorised_to_sign']) && $data['phone_authorised_to_sign'])
<div class="text-base">
<strong>Telefon</strong><br>
{{ $data['phone_authorised_to_sign'] }}
</div>
<br>
@endif
@if (isset($data['location_authorised_to_sign']) && $data['location_authorised_to_sign'])
<div class="text-base">
<strong>Adresse</strong><br>
{{ $data['location_authorised_to_sign'] }}
</div>
<br>
@endif
@if (isset($data['zip_authorised_to_sign']) && $data['zip_authorised_to_sign'])
<div class="text-base">
<strong>PLZ</strong><br>
{{ $data['zip_authorised_to_sign'] }}
</div>
<br>
@endif
@if (isset($data['city_authorised_to_sign']) && $data['city_authorised_to_sign'])
<div class="text-base">
<strong>Ort</strong><br>
{{ $data['city_authorised_to_sign'] }}
</div>
<br>
@endif
@if (isset($data['dob_authorised_to_sign']) && $data['dob_authorised_to_sign'])
<div class="text-base">
<strong>Geburtsdatum</strong><br>
{{ $data['dob_authorised_to_sign'] }}
</div>
<br>
@endif
<div class="text-base">
<strong>Dokumente</strong><br>
@if (isset($data['commercial_register_path']) && $data['commercial_register_path'])
{{ basename($data['commercial_register_path']) }}<br>
@endif
@if (isset($data['id_copy_path']) && $data['id_copy_path'])
{{ basename($data['id_copy_path']) }}<br>
@endif
@if (isset($data['power_of_attorney_path']) && $data['power_of_attorney_path'])
{{ basename($data['power_of_attorney_path']) }}<br>
@endif
</div>
<br>
<div class="text-base">
Bei Fragen wenden Sie sich an unsere Koordinationsstelle, Tel. 052 551 03 65 oder E-Mail hallo@baukulturhaus.ch
</div>
<br>
<div class="text-base">
Kernteam Baukulturhaus
</div>
</x-mail::message>
