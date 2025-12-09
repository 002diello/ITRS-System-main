{{-- <x-mail::message>
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
</x-mail::message> --}}

@component('mail::layout')
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
    @endcomponent
@endslot

# @if($status === 'new_request') New Request Requires Approval
@elseif($status === 'pending_approval') Pending IT HOD Approval
@elseif($status === 'approved') Request Approved
@elseif($status === 'new_assignment') New Assignment
@elseif($status === 'assigned') Request Assigned
@elseif($status === 'completed') Request Completed
@elseif($status === 'rejected') Request Rejected
@else Request Update
@endif

**Reference:** {{ $requestForm->reference_number }}  
**Form:** {{ $requestForm->form_title }}  
**Name:** {{ $requestForm->name }}  
@if($requestForm->department)
**Department:** {{ $requestForm->department }}  
@endif
@if(isset($requestForm->request_data['Position']) && $requestForm->request_data['Position'])
**Position:** {{ $requestForm->request_data['Position'] }}  
@endif
@if($requestForm->email)
**Email:** {{ $requestForm->email }}  
@endif
@if($requestForm->phone)
**Phone:** {{ $requestForm->phone }}  
@endif

@if($note)
> {!! nl2br(e($note)) !!}
@endif

@if($status === 'rejected' && isset($requestForm->rejection_reason))
> **Reason for Rejection:**  
> {{ $requestForm->rejection_reason }}
@endif

@if($status === 'completed' && isset($requestForm->completion_notes))
> **Completion Notes:**  
> {{ $requestForm->completion_notes }}
@endif

@component('mail::button', ['url' => url('/requests/' . $requestForm->id)])
View Request Details
@endcomponent

@if($status === 'new_request')
**Next Steps:**  
Please review this request and take appropriate action in the system.
@elseif($status === 'approved')
**Next Steps:**  
This request has been approved and will be processed shortly.
@elseif($status === 'assigned')
**Next Steps:**  
You can now start working on this request.
@endif

Thanks,  
{{ config('app.name') }}

@slot('footer')
    @component('mail::footer')
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @if(isset($requestForm->reference_number))
            | Reference: {{ $requestForm->reference_number }}
        @endif
    @endcomponent
@endslot
@endcomponent