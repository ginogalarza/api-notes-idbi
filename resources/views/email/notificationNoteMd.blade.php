@component('mail::message')

<h1>Nueva Notificación</h1>
<p>Un integrante acaba de agregar una nueva nota al grupo {{ $group }}, con el titulo {{ $titleNote }}.</p>

@component('mail::button', ['url' => ''])
Ver nueva nota ({{ $titleNote }}).
@endcomponent
 
{{ config('app.name') }}
@endcomponent