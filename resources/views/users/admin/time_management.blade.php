@extends('users.admin.layout')


@section('content')
<div class="container mt-4">
    <h1>Time Management</h1>
    <a href="{{ route('time-management.create') }}" class="btn btn-primary mb-3">Add Time Management</a>

    @if($timeManagement->isEmpty())
        <p>No time management entries found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Period (minutes)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($timeManagement as $entry)
                    <tr>
                        <td>{{ $entry->id }}</td>
                        <td>{{ $entry->date }}</td>
                        <td>{{ $entry->day }}</td>
                        <td>{{ $entry->start_time }}</td>
                        <td>{{ $entry->end_time }}</td>
                        <td>{{ $entry->period_minutes ?? 'N/A' }}</td>
                        
                        <td>
                            <a href="{{ route('time-management.show', $entry->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('time-management.edit', $entry->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('time-management.destroy', $entry->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
