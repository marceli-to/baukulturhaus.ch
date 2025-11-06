<x-mail::message>
<div class="text-base">
Neue Aktionär:in Privat
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
@if (isset($data['zip_file']) && $data['zip_file'] && isset($data['entry_id']))
<div class="text-base">
  <a
    href="{{ route('shareholder.download-zip', $data['entry_id']) }}"
    class="btn">
    Dokumente herunterladen
  </a>
  <br><br>
  <a
    href="{{ route('shareholder.delete-zip', $data['entry_id']) }}"
    class="btn btn-danger">
    Dokumente löschen
  </a>
</div>
<br>
@endif

</x-mail::message>
