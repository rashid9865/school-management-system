@extends('users.student.layout')

@section('title')
Announcement
@endsection

@section('css')
<link href="{{ asset('css/student/announcement.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="announce-container">
    <header class="announce-header">
        <div>
            <h1>Announcements</h1>
            <p class="announce-subtitle">Latest notices and important updates from the school administration.</p>
        </div>
    </header>

    <section class="announce-card">
        <div class="announce-table-wrap">
            <table class="announce-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Announcement</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->id }}</td>
                            <td>{{ optional($announcement->created_at)->format('d M Y') }}</td>
                            <td>{{ $announcement->content ?? 'No announcement text available.' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="announce-empty">No announcements available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection