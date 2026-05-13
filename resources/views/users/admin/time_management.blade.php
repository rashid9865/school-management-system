@extends('users.admin.layout')

@section('title')
Time Management
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
:root {
    --card-bg: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    --header-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --btn-primary: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --btn-success: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --btn-warning: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    --btn-danger: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.08);
    --shadow-medium: 0 4px 20px rgba(0, 0, 0, 0.12);
}

.page-container {
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    min-height: 100vh;
    padding: 2.5rem 0;
}

.page-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    max-width: 1200px;
    margin: 0 auto;
    overflow: hidden;
}

.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.page-header h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: -0.5px;
}

.page-header-actions {
    display: flex;
    gap: 1rem;
}

.page-body {
    padding: 2rem;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.data-table th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.25rem 1rem;
    text-align: left;
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.data-table td {
    padding: 1.25rem 1rem;
    border-bottom: 1px solid #f1f5f9;
}

.data-table tr:hover td {
    background: #f8fafc;
}

.data-table tr:last-child td {
    border-bottom: none;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-primary {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
}

.btn-warning {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    color: white;
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    color: white;
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
}

.no-records {
    text-align: center;
    padding: 3rem;
    color: #6b7280;
}

.no-records i {
    font-size: 3rem;
    opacity: 0.5;
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .page-header h1 {
        font-size: 1.5rem;
    }

    .page-body {
        padding: 1rem;
    }

    .data-table th,
    .data-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
    }

    .action-buttons {
        flex-direction: column;
    }
}
</style>
@endsection

@section('content')
<div class="page-container">
    <div class="page-card">
        <div class="page-header">
            <h1><i class="fas fa-clock me-3"></i>Time Management</h1>
            <div class="page-header-actions">
                <a href="{{ route('time-management.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>Add Time Slot
                </a>
            </div>
        </div>

        <div class="page-body">
            @if($timeManagement->isEmpty())
                <div class="no-records">
                    <i class="fas fa-clock"></i>
                    <p>No time management entries found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                <th><i class="fas fa-calendar me-1"></i>Date</th>
                                <th><i class="fas fa-sun me-1"></i>Day</th>
                                <th><i class="fas fa-play me-1"></i>Start Time</th>
                                <th><i class="fas fa-stop me-1"></i>End Time</th>
                                <th><i class="fas fa-hourglass me-1"></i>Period</th>
                                <th><i class="fas fa-cogs me-1"></i>Actions</th>
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
                                    <td>{{ $entry->period_minutes ?? 'N/A' }} min</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('time-management.show', $entry->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i>View
                                            </a>
                                            <a href="{{ route('time-management.edit', $entry->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>Edit
                                            </a>
                                            <form action="{{ route('time-management.destroy', $entry->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
