@extends('users.admin.layout')

@section('title', 'Assign Subjects to Grades')

@section('css')
    <style>
        .assign-card {
            max-width: 1000px;
            margin: 20px auto;
            padding: 28px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            box-shadow: 0 18px 60px rgba(15, 23, 42, 0.09);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.5rem;
            color: #0f172a;
        }

        .form-group {
            display: grid;
            gap: 8px;
            margin-bottom: 18px;
        }

        .form-label {
            font-weight: 600;
            color: #0f172a;
        }

        .form-select {
            width: 100%;
            min-height: 46px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            background: #f8fbff;
            color: #0f172a;
            font-size: 0.98rem;
        }

        .form-select:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.16);
        }

        .btn-assign {
            background: #0ea5e9;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-assign:hover {
            background: #0369a1;
        }

        .assignments-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        .assignments-table th {
            background: #f1f5f9;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #0f172a;
            border-bottom: 2px solid #cbd5e1;
        }

        .assignments-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .assignments-table tr:hover {
            background: #f8fbff;
        }

        .btn-remove {
            background: #ef4444;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .btn-remove:hover {
            background: #dc2626;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-info {
            background: #cffafe;
            color: #164e63;
            border: 1px solid #a5f3fc;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #64748b;
        }
    </style>
@endsection

@section('content')
    <div class="assign-card">
        <div class="card-header">
            <h2>Assign Subjects to Grades</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert" style="background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('storeSubjectAssignment') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="grade_id" class="form-label">Select Grade</label>
                <select name="grade_id" id="grade_id" class="form-select" required>
                    <option value="">-- Select a grade --</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
                @error('grade_id')
                    <span style="color: #dc2626; font-size: 0.92rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="subject_id" class="form-label">Select Subject</label>
                <select name="subject_id" id="subject_id" class="form-select" required>
                    <option value="">-- Select a subject --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id')
                    <span style="color: #dc2626; font-size: 0.92rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-assign">Assign Subject to Grade</button>
        </form>

        {{-- Display Current Assignments --}}
        <div style="margin-top: 40px;">
            <h3 style="color: #0f172a; margin-bottom: 16px;">Current Assignments</h3>
            
            @php
                $hasAssignments = false;
                foreach($grades as $grade) {
                    if($grade->subjects()->count() > 0) {
                        $hasAssignments = true;
                        break;
                    }
                }
            @endphp

            @if($hasAssignments)
                <table class="assignments-table">
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grades as $grade)
                            @foreach($grade->subjects as $subject)
                                <tr>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('removeSubjectAssignment', [$grade->id, $subject->id]) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-remove" onclick="return confirm('Are you sure?')">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <p>No subjects assigned to any grade yet.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
