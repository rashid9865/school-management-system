@extends('users.admin.layout')

@section('title', 'Search Results')

@section('css')
    <style>
        .search-header {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 28px;
        }

        .search-header h1 {
            font-size: 1.85rem;
            margin: 0;
            color: #0f172a;
        }

        .search-header p {
            margin: 0;
            color: #475569;
            font-size: 0.98rem;
        }

        .search-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
        }

        .search-card {
            background: #ffffff;
            border: 1px solid rgba(148, 163, 184, 0.24);
            border-radius: 18px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
            padding: 24px;
        }

        .search-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .search-card-header h2 {
            margin: 0;
            font-size: 1.1rem;
            color: #111827;
        }

        .search-card-header span {
            color: #64748b;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .table-scroll {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 320px;
        }

        .data-table th,
        .data-table td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(148, 163, 184, 0.18);
            text-align: left;
            color: #1e293b;
        }

        .data-table th {
            background: #f8fafc;
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        .data-table tbody tr:hover {
            background: #f8fafc;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty-state {
            padding: 36px 0;
            color: #475569;
            font-weight: 600;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="search-header">
        <p>Showing results for</p>
        <h1>"{{ request('query') }}"</h1>
    </div>

    <div class="search-grid">
        <div class="search-card">
            <div class="search-card-header">
                <h2>Subjects</h2>
                <span>{{ count($subjects ?? []) }} result{{ count($subjects ?? []) === 1 ? '' : 's' }}</span>
            </div>

            @if(empty($subjects))
                <div class="empty-state">No subjects found.</div>
            @else
                <div class="table-scroll">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>
                                        <span class="status-pill {{ $subject->status ? 'status-active' : 'status-inactive' }}">
                                            {{ $subject->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="search-card">
            <div class="search-card-header">
                <h2>Users</h2>
                <span>{{ count($users ?? []) }} result{{ count($users ?? []) === 1 ? '' : 's' }}</span>
            </div>

            @if(empty($users))
                <div class="empty-state">No users found.</div>
            @else
                <div class="table-scroll">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="search-card">
            <div class="search-card-header">
                <h2>Grades</h2>
                <span>{{ count($grades ?? []) }} result{{ count($grades ?? []) === 1 ? '' : 's' }}</span>
            </div>

            @if(empty($grades))
                <div class="empty-state">No grades found.</div>
            @else
                <div class="table-scroll">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->section->name ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection