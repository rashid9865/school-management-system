@extends('users.admin.layout')

@section('title')
    All Grades
@endsection

@section('csrf_token')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    --shadow-heavy: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.grades-index-container {
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    min-height: 100vh;
    padding: 2.5rem 0;
}

.professional-card {
    background: white;
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    margin: 0 auto;
    max-width: 1200px;
}

.professional-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
}

.card-header-professional {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 65%, #5a4d8f 100%);
    color: white;
    border: none;
    padding: 3rem 2.5rem;
    position: relative;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.card-header-professional::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
}

.card-header-professional h1 {
    position: relative;
    z-index: 1;
    margin: 0;
    font-weight: 800;
    font-size: 2rem;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.5px;
}

.card-header-professional p {
    position: relative;
    z-index: 1;
    margin: 0.5rem 0 0;
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
}

.card-header-professional .btn-new-grade {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    border: none;
    background: var(--btn-success);
    color: white;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(67, 233, 123, 0.3);
}

.card-header-professional .btn-new-grade:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(67, 233, 123, 0.4);
}

.card-body-professional {
    padding: 3rem;
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
    transition: background-color 0.2s ease;
}

.data-table tr:hover td {
    background: #f8fafc;
}

.data-table tr:last-child td {
    border-bottom: none;
}

.grade-description {
    color: #64748b;
    font-size: 0.92rem;
    font-style: italic;
}

.empty-state {
    padding: 4rem 2rem;
    text-align: center;
    color: #6b7280;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border: 2px dashed #e2e8f0;
    border-radius: 16px;
    margin-top: 1rem;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    opacity: 0.3;
}

.empty-state p {
    font-size: 1.2rem;
    margin: 0;
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
    background: var(--btn-primary);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
}

.btn-warning {
    background: var(--btn-warning);
    color: white;
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4);
}

.btn-danger {
    background: var(--btn-danger);
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

.status-btn {
        width: 64px;
        height: 34px;
        padding: 0;
        border-radius: 999px;
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: flex-start;
        border: none;
        cursor: pointer;
        transition: background 0.25s ease, box-shadow 0.25s ease;
    }

    .status-btn::before {
        content: '';
        position: absolute;
        inset: 4px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.18);
    }

    .status-btn .toggle-thumb {
        position: absolute;
        left: 4px;
        top: 4px;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.18);
        transition: left 0.2s ease;
    }

    .status-btn.active {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        box-shadow: 0 8px 22px rgba(34, 197, 94, 0.22);
    }

    .status-btn.active .toggle-thumb {
        left: calc(100% - 30px);
    }

    .status-btn.inactive {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        box-shadow: 0 8px 22px rgba(239, 68, 68, 0.22);
    }

    .status-btn.inactive .toggle-thumb {
        left: 4px;
    }
/* Responsive Design */
@media (max-width: 768px) {
    .grades-index-container {
        padding: 1rem 0;
    }

    .card-header-professional {
        flex-direction: column;
        align-items: flex-start;
        padding: 2rem 1.5rem;
    }

    .card-header-professional h1 {
        font-size: 1.5rem;
    }

    .card-body-professional {
        padding: 2rem 1.5rem;
    }

    .data-table th,
    .data-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
    }

    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }

    .btn {
        padding: 0.5rem;
        font-size: 0.75rem;
    }
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.professional-card {
    animation: fadeInUp 0.6s ease-out;
}
</style>
@endsection

@section('content')
<div class="grades-index-container">
    <div class="container-fluid">
        <div class="professional-card">
            <div class="card-header-professional">
                <div>
                    <h1><i class="fas fa-graduation-cap me-3"></i>All Grades</h1>
                    <p>Grade list with optional description for every entry.</p>
                </div>
            
                <a href="{{ route('grades.create') }}" class="btn-new-grade">
                    <i class="fas fa-plus"></i>
                    Create Grade
                </a>
            </div>
            <div class="success-message" style="padding: 1rem 2.5rem;">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            <div class="card-body-professional">
                @if($grades->count())
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-1"></i>#</th>
                                    <th><i class="fas fa-graduation-cap me-1"></i>Grade Name</th>
                                    <th><i class="fas fa-align-left me-1"></i>Description</th>
                                    <th><i class="fas fa-toggle-on me-1"></i>Status</th>
                                    <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grades as $index => $grade)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $grade->name }}</td>
                                        <td class="grade-description">
                                            {{ $grade->description ? $grade->description : 'No description provided' }}
                                        </td>
                                        <td>
                                            <button type="button" class="status-btn btn {{ $grade->status ? 'active' : 'inactive' }}" data-id="{{ $grade->id }}" data-status="{{ $grade->status }}" aria-label="Toggle grade status">
                                                <span class="toggle-thumb"></span>
                                            </button>
                                        </td>
                                        <td> 
                                            <div class="action-buttons">
                                                <a href="{{ route('grades.show', $grade->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i>View
                                                </a>
                                                <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>Edit
                                                </a>
                                                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" ">
                                                        <i class="fas fa-trash-alt"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-graduation-cap"></i>
                        <p><strong>No grades found yet.</strong> Click "Create Grade" to add the first grade.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.status-btn');
        const url = '{{ route('grades.toggle') }}';
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const gradeId = this.dataset.id;
                const status = Number(this.dataset.status);
                const buttonEl = this;

                buttonEl.disabled = true;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ id: gradeId, status: status })
                })
                .then(response => response.json().then(data => ({ status: response.status, body: data })))
                .then(({ status, body }) => {
                    buttonEl.disabled = false;

                    if (status !== 200) {
                        console.error('Grade toggle error:', body);
                        return;
                    }

                    const newStatus = Number(body.status);
                    buttonEl.dataset.status = newStatus;
                    buttonEl.classList.toggle('active', newStatus === 1);
                    buttonEl.classList.toggle('inactive', newStatus === 0);
                    buttonEl.innerHTML = `<span class="toggle-thumb"></span>`;
                })
                .catch(error => {
                    console.error('Grade toggle failed:', error);
                    buttonEl.disabled = false;
                });
            });
        });
    });
</script>
@endsection 