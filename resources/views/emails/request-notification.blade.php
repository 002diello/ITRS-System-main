<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject ?? 'ITRS Notification' }}</title>
</head>
<body>
    <h1>{{ ucfirst($status) }}: {{ $request->form_code }} - {{ $request->form_title }}</h1>
    
    <p><strong>Request ID:</strong> #{{ $request->id }}</p>
    <p><strong>Submitted By:</strong> {{ $request->name }}</p>
    <p><strong>Department:</strong> {{ $request->department }}</p>
    <p><strong>Status:</strong> {{ ucfirst($status) }}</p>

    @if($status === 'rejected' && $message)
    <h3>Reason for Rejection:</h3>
    <p>{{ $message }}</p>
    @endif

    @if($status === 'completed' && $message)
    <h3>Completion Notes:</h3>
    <p>{{ $message }}</p>
    @endif

    <p>
        <a href="{{ url("/requests/{$request->id}") }}" 
           style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
            View Request
        </a>
    </p>

    <p>Thanks,<br>{{ config('app.name') }}</p>

    <footer style="margin-top: 20px; padding-top: 10px; border-top: 1px solid #eee; font-size: 12px; color: #777;">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>
</body>
</html>