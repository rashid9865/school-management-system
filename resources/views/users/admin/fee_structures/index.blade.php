@extends('users.admin.layout')

@section('title')
Fee Structure
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
<style>
    .fee-page { max-width: 1180px; margin: 0 auto; }
    .fee-page .panel-card { padding: 2rem; background: #ffffff; border-radius: 24px; box-shadow: 0 20px 45px rgba(41, 50, 57, 0.08); }
    .fee-page .panel-header { display: flex; justify-content: space-between; gap: 1rem; align-items: flex-start; margin-bottom: 1.5rem; }
    .fee-page .panel-header h2 { margin: 0.25rem 0 0; color: #1f2937; }
    .fee-page .panel-header p.eyebrow { margin: 0; color: #6b7280; font-size: 0.95rem; letter-spacing: 0.04em; text-transform: uppercase; }
    .fee-page .panel-header .badge { padding: 0.75rem 1rem; background: #eef2ff; color: #4338ca; border-radius: 999px; font-weight: 600; }
    .fee-page .note-text { margin-top: 0.6rem; color: #4b5563; }
    .fee-page .alert { margin-bottom: 1.5rem; padding: 0.95rem 1rem; border-radius: 12px; background: #ecfdf5; color: #166534; border: 1px solid #d1fae5; }
    .fee-page .form-card { margin-bottom: 2rem; }
    .fee-page .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; }
    .fee-page .form-row { display: flex; flex-direction: column; gap: 0.5rem; }
    .fee-page .form-row label { font-weight: 600; color: #111827; }
    .fee-page .form-row input,
    .fee-page .form-row select,
    .fee-page .form-row textarea { width: 100%; border: 1px solid #d1d5db; border-radius: 14px; padding: 0.95rem 1rem; background: #f8fafc; color: #111827; font-size: 0.96rem; }
    .fee-page .form-row textarea { min-height: 110px; resize: vertical; }
    .fee-page .form-actions { display: flex; justify-content: flex-end; }
    .fee-page .button-primary { background: #4338ca; color: #ffffff; border: none; padding: 0.95rem 1.6rem; border-radius: 999px; cursor: pointer; transition: background 0.2s ease; }
    .fee-page .button-primary:hover { background: #3730a3; }
    .fee-page .data-table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
    .fee-page .data-table th,
    .fee-page .data-table td { padding: 1rem 0.85rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
    .fee-page .data-table th { color: #4b5563; font-size: 0.92rem; letter-spacing: 0.02em; text-transform: uppercase; }
    .fee-page .data-table tbody tr:hover { background: #f9fafb; }
    .fee-page .table-scroll { overflow-x: auto; }
</style>
@endsection

@section('content')
<div class="fee-page">
    <div class="panel-card">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Fee management</p>
                <h2>Fee structure settings</h2>
                <p class="note-text">Create and manage fee rules by class and semester. Section-specific fee configuration has been removed.</p>
            </div>
            <span class="badge">{{ $feeStructures->count() }} rules</span>
        </div>

        @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="form-card">
            <form action="{{ route('fee.fee-structures.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-row">
                        <label for="grade_id">Class</label>
                        <select name="grade_id" id="grade_id">
                            <option value="">All classes</option>
                            @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="semester">Semester</label>
                        <input type="text" name="semester" id="semester" value="{{ old('semester') }}" placeholder="e.g. Semester 1">
                    </div>

                    <div class="form-row">
                        <label for="type">Type</label>
                        <select name="type" id="type" required>
                            <option value="class">Class fee only</option>
                            <option value="semester">Semester fee</option>
                            <option value="class_semester">Class + semester fee</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" required>
                    </div>

                    <div class="form-row" style="grid-column: 1 / -1;">
                        <label for="description">Description</label>
                        <textarea name="description" id="description">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 1rem;">
                    <button type="submit" class="button button-primary">Save fee rule</button>
                </div>
            </form>
        </div>

        <div class="table-scroll">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Class</th>
                        <th>Semester</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feeStructures as $structure)
                    <tr>
                        <td>{{ $structure->id }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $structure->type)) }}</td>
                        <td>{{ $structure->grade?->name ?? 'All' }}</td>
                        <td>{{ $structure->semester ?: 'Any' }}</td>
                        <td>{{ number_format($structure->amount, 2) }}</td>
                        <td>{{ $structure->description }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">No fee structures defined yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
