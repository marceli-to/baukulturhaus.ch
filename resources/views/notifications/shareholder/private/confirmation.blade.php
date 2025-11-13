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
@if (isset($data['salutation']) && $data['salutation'])
<div class="text-base">
<strong>Anrede</strong><br>
{{ $data['salutation'] }}
</div>
<br>
@endif
@if ($data['firstname'])
<div class="text-base">
<strong>Vorname</strong><br>
{{ $data['firstname'] }}
</div>
<br>
@endif
@if ($data['name'])
<div class="text-base">
<strong>Name</strong><br>
{{ $data['name'] }}
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
@if ($data['email'])
<div class="text-base">
<strong>E-Mail</strong><br>
{{ $data['email'] }}
</div>
<br>
@endif
@if (isset($data['phone']) && $data['phone'])
<div class="text-base">
<strong>Telefon</strong><br>
{{ $data['phone'] }}
</div>
<br>
@endif
@if (isset($data['dob']) && $data['dob'])
<div class="text-base">
<strong>Geburtsdatum</strong><br>
{{ $data['dob'] }}
</div>
<br>
@endif
<div class="text-base">
<strong>Dokumente</strong><br>
@if (isset($data['identity_document_path']) && $data['identity_document_path'])
{{ basename($data['identity_document_path']) }}<br>
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
