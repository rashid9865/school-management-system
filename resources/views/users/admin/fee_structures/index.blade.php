@extends('users.admin.layout')

@section('title')
Fee Structure
@endsection

@section('css')
<style>
:root {
    color-scheme: light;
    --bg: #eaf5ff;
    --surface: #ffffff;
    --surface-soft: #f8fbff;
    --border: #cfe0ff;
    --text: #0f172a;
    --muted: #475569;
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --success: #16a34a;
    --danger: #dc2626;
}

.fee-page {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px 0 70px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: calc(100vh - 130px);
    background: linear-gradient(180deg, #eaf5ff 0%, #f9fbff 55%, #ffffff 100%);
    color: var(--text);
}

.fee-card {
    width: 100%;
    max-width: 1180px;
    background: var(--surface);
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 35px 90px rgba(15, 23, 42, 0.16);
    border: 1px solid rgba(59, 130, 246, 0.18);
}

.fee-card-header {
    padding: 36px 42px 28px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    gap: 24px;
    align-items: flex-start;
}

.fee-card-title {
    max-width: 72%;
}

.eyebrow {
    display: inline-block;
    margin-bottom: 16px;
    font-size: 0.85rem;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    opacity: 0.9;
}

.fee-card-header h1 {
    margin: 0;
    font-size: clamp(2rem, 2.5vw, 2.8rem);
    line-height: 1.05;
}

.fee-card-header p {
    margin: 18px 0 0;
    color: rgba(255, 255, 255, 0.88);
    line-height: 1.7;
}

.fee-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.18);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.92rem;
    white-space: nowrap;
}

.fee-card-body {
    padding: 36px 42px 42px;
    background: var(--surface-soft);
}

.alert {
    padding: 16px 18px;
    border-radius: 18px;
    margin-bottom: 24px;
    font-size: 0.95rem;
}

.alert-success {
    background: #ecfdf5;
    color: var(--success);
    border: 1px solid #bbf7d0;
}

.alert-error {
    background: #fee2e2;
    color: var(--danger);
    border: 1px solid #fecaca;
}

.form-card {
    margin-bottom: 2rem;
    padding: 2rem;
    background: var(--surface);
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
}

.form-grid {
    display: grid;
    gap: 22px;
}

.form-row {
    display: grid;
    gap: 10px;
}

.form-row label {
    color: var(--text);
    font-weight: 700;
}

.form-row input,
.form-row select,
.form-row textarea {
    width: 100%;
    padding: 15px 18px;
    border-radius: 18px;
    border: 1px solid var(--border);
    background: #ffffff;
    color: var(--text);
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-row input:focus,
.form-row select:focus,
.form-row textarea:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.16);
}

.form-row textarea {
    min-height: 110px;
    resize: vertical;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 1rem;
}

.button-primary {
    padding: 16px 32px;
    border: none;
    border-radius: 20px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.button-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 40px rgba(59, 130, 246, 0.18);
}

.data-table-container {
    background: var(--surface);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: 1rem 0.85rem;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.data-table th {
    color: var(--muted);
    font-size: 0.92rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    font-weight: 700;
}

.data-table tbody tr:hover {
    background: var(--surface-soft);
}

.data-table tbody tr:last-child td {
    border-bottom: none;
}

.no-data {
    text-align: center;
    padding: 3rem;
    color: var(--muted);
    font-style: italic;
}

@media (max-width: 720px) {
    .fee-card {
        margin: 0 18px;
    }

    .fee-card-header,
    .fee-card-body {
        padding-left: 24px;
        padding-right: 24px;
    }

    .fee-card-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .form-card {
        padding: 1.5rem;
    }

    .data-table-container {
        padding: 1.5rem;
    }
}

@media (max-width: 520px) {
    .fee-card-header h1 {
        font-size: 2rem;
    }
}
</style>
@endsection

@section('content')
<div class="fee-page">
    <div class="fee-card">
        <div class="fee-card-header">
            <div class="fee-card-title">
                <span class="eyebrow">Fee management</span>
                <h1>Fee Structure Settings</h1>
                <p>Create and manage fee rules by class and semester. Section-specific fee configuration has been removed.</p>
            </div>
            <span class="fee-badge">{{ $feeStructures->count() }} rules</span>
        </div>
        <div class="fee-card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
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

                    <div class="form-actions">
                        <button type="submit" class="button-primary">Save fee rule</button>
                    </div>
                </form>
            </div>

            <div class="data-table-container">
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
                            <td colspan="6">
                                <div class="no-data">No fee structures defined yet.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
