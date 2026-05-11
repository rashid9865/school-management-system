@extends('users.student.layout')

@section('title')
Messages
@endsection

@section('css')
<link href="{{ asset('css/student/message.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="message-container">
    <header class="message-header">
        <div>
            <h1>Your messages</h1>
            <p class="message-subtitle">Read your latest communication from teachers and school staff.</p>
        </div>
    </header>

    <section class="message-card">
        <ul class="message-list">
            @forelse($messages as $message)
                <li class="message-item">
                    <div class="message-item-top">
                        <span class="message-sender">{{ $message->sender ?? 'System' }}</span>
                        <span class="message-time">{{ optional($message->created_at)->format('d M Y H:i') }}</span>
                    </div>
                    <p class="message-text">{{ $message->content ?? 'No message text available.' }}</p>
                </li>
            @empty
                <li class="message-empty">No messages found.</li>
            @endforelse
        </ul>
    </section>
</div>
@endsection