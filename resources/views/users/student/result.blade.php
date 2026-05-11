@extends('users.student.layout')

@section('title')
Result
@endsection

@section('css')
<link href="{{ asset('css/student/result.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="result-container">
    <header class="result-header">
        <div>
            <h1>Exam Results</h1>
            <p class="result-subtitle">Review your latest exam scores, grades, and exam dates in a clean report view.</p>
        </div>
    </header>

    <section class="result-card">
        <div class="result-summary">
            <div>
                <span>Total exams</span>
                <strong>{{ $marks->count() }}</strong>
            </div>
            <div>
                <span>Average score</span>
                <strong>{{ $marks->count() ? number_format($marks->avg('marks'), 2) : 'N/A' }}</strong>
            </div>
        </div>

        <div class="result-table-wrap">
            <table class="result-table">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Exam</th>
                        <th>Marks</th>
                        <th>Grade</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($marks as $mark)
                        <tr>
                            <td>{{ $mark->subjects->name ?? 'N/A' }}</td>
                            <td>{{ $mark->exam->name ?? 'N/A' }}</td>
                            <td>{{ $mark->marks }}</td>
                            <td>{{ $mark->grade ?? 'N/A' }}</td>
                            <td>{{ optional($mark->exam)->exam_date_time?->format('d M Y') ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="result-empty">No result records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection