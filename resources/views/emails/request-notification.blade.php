<x-mail::message>
# Request {{ ucfirst($status) }}

**Reference:** {{ $requestForm->reference_number }}  
**Form:** {{ $requestForm->form_code }} – {{ $requestForm->form_title }}  
**Name:** {{ $requestForm->name }}  
**Department:** {{ $requestForm->department }}  
**Email:** {{ $requestForm->email }}

@if($note)
> {{ $note }}
@endif

<x-mail::button :url="url('/requests/' . $requestForm->id)">
View Request
</x-mail::button>

Regards,<br>
{{ config('app.name') }}
</x-mail::message>