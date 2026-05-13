@extends('users.admin.layout');

@section('title')
Subjects
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

* {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.subjects-container {
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

.stats-section {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 3rem;
    padding: 0.5rem 0;
}

.stat-card {
    flex: 1;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.1);
    text-align: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(102, 126, 234, 0.1);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(102, 126, 234, 0.05) 0%, transparent 70%);
    border-radius: 50%;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 35px rgba(102, 126, 234, 0.2);
    border-color: rgba(102, 126, 234, 0.3);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 900;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.75rem;
    position: relative;
    z-index: 1;
}

.stat-label {
    color: #64748b;
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    z-index: 1;
}

.card-body {
    padding: 2.5rem;
}

.stats-divider {
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, rgba(102, 126, 234, 0.15) 50%, transparent 100%);
    margin: 2.5rem 0;
}

.add-btn-professional {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    border: none;
    border-radius: 14px;
    padding: 14px 32px;
    font-weight: 700;
    color: white;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 6px 20px rgba(67, 233, 123, 0.35);
    font-size: 1rem;
    letter-spacing: 0.3px;
}

.add-btn-professional:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(67, 233, 123, 0.5);
    color: white;
}

.add-btn-professional i {
    font-size: 1.2rem;
}

.table-wrapper {
    border-radius: 12px;
    overflow: hidden;
    background: white;
}

.table-professional {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    margin-bottom: 0;
    width: 100%;
    table-layout: fixed;
    margin-top: 1.5rem;
}

.table-professional thead {
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border: none;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table-professional thead th {
    font-weight: 800;
    color :var(--header-gradient);
    padding: 1.75rem 1.25rem;
    border: none;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
}

.table-professional thead th:nth-child(1) {
    width: 6%;
}

.table-professional thead th:nth-child(2) {
    width: 30%;
}

.table-professional thead th:nth-child(3) {
    width: 15%;
}

.table-professional thead th:nth-child(4) {
    width: 20%;
}

.table-professional thead th:nth-child(5) {
    width: 29%;
}

.table-professional tbody tr {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-bottom: 1px solid #f0f1f3;
    position: relative;
}

.table-professional tbody tr::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, #f0f1f3 50%, transparent 100%);
}

.table-professional tbody tr:hover {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.05) 100%);
    box-shadow: inset 0 4px 12px rgba(102, 126, 234, 0.1);
}

.table-professional tbody tr:last-child {
    border-bottom: none;
}

.table-professional td {
    padding: 1.5rem 1.25rem;
    vertical-align: middle;
    border: none;
    word-break: break-word;
}

.action-btn {
    border: none;
    border-radius: 10px;
    padding: 10px 16px;
    font-weight: 700;
    font-size: 0.8rem;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    margin-right: 6px;
    cursor: pointer;
    white-space: nowrap;
    letter-spacing: 0.3px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.action-buttons-group {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

.btn-edit {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    color: white;
}

.btn-edit:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(250, 112, 154, 0.4);
    color: white;
}

.btn-delete {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    color: white;
}

.btn-delete:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
    color: white;
}

.empty-state-professional {
    padding: 5rem 2rem;
    text-align: center;
    color: #94a3b8;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border-radius: 16px;
    margin: 2rem 0;
    border: 2px dashed rgba(102, 126, 234, 0.2);
}

.empty-state-professional i {
    font-size: 4.5rem;
    margin-bottom: 1.5rem;
    opacity: 0.6;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.empty-state-professional p {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    font-weight: 500;
}

.empty-state-professional a {
    color: #667eea;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
    border-bottom: 2px solid rgba(102, 126, 234, 0.3);
}

.empty-state-professional a:hover {
    text-decoration: underline;
    color: #764ba2;
}

@media (max-width: 768px) {
    .stats-section {
        flex-direction: column;
        gap: 1rem;
    }
    
    .professional-card {
        margin: 1rem;
        border-radius: 16px;
    }
    
    .card-header-professional {
        padding: 2rem 1.5rem;
    }
    
    .card-header-professional h1 {
        font-size: 1.5rem;
    }
    
    .table-professional {
        font-size: 0.85rem;
        table-layout: auto;
    }
    
    .table-professional thead th {
        padding: 1.25rem 0.8rem;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .table-professional td {
        padding: 1rem 0.8rem;
    }
    
    .action-btn {
        padding: 8px 12px;
        font-size: 0.75rem;
    }
    
    .action-buttons-group {
        flex-direction: column;
        gap: 8px;
        width: 100%;
    }
    
    .action-btn {
        width: 100%;
        justify-content: center;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .stat-label {
        font-size: 0.85rem;
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-professional tbody tr {
    animation: slideIn 0.5s ease;
}

.modal-overlay {
    opacity: 0;
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.55);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
    padding: 1.5rem;
}

.modal-card {
    width: min(540px, 100%);
    background: #ffffff;
    border-radius: 28px;
    box-shadow: 0 35px 80px rgba(15, 23, 42, 0.17);
    border: 1px solid rgba(15, 23, 42, 0.08);
    overflow: hidden;
    position: relative;
    transform: translateY(-50%);
    animation: slideIn 0.4s ease forwards;

}

.modal-card .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 1.5rem 0.9rem;
    border-bottom: 1px solid rgba(148, 163, 184, 0.18);
}

.modal-card .modal-title {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 800;
    color: #0f172a;
}

.modal-close {
    border: none;
    background: transparent;
    color: #64748b;
    font-size: 1.55rem;
    line-height: 1;
    cursor: pointer;
    transition: transform 0.2s ease, color 0.2s ease;
}

.modal-close:hover {
    transform: scale(1.05);
    color: #111827;
}

.modal-card .modal-body {
    padding: 1.5rem;
}

.form-group-professional {
    margin-bottom: 1.25rem;
}

.form-group-professional label {
    display: block;
    margin-bottom: 0.75rem;
    font-weight: 700;
    color: #334155;
    letter-spacing: 0.2px;
}

.form-group-professional input {
    width: 100%;
    padding: 0.95rem 1rem;
    border-radius: 16px;
    border: 1px solid #d1d5db;
    background: #f8fafc;
    color: #0f172a;
    font-size: 1rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
}

.form-group-professional input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 0.24rem rgba(37, 99, 235, 0.16);
    background: #ffffff;
}

.btn-submit-professional.updateBtn {
    width: 100%;
    justify-content: center;
    background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
    color: #ffffff;
    padding: 0.95rem 1rem;
    border-radius: 16px;
    border: none;
    box-shadow: 0 14px 40px rgba(37, 99, 235, 0.18);
}

.btn-submit-professional.updateBtn:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #4338ca 100%);
}

.error-message {
    margin-top: 0.8rem;
    color: #dc2626;
    font-size: 0.92rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.modal-footer {
    padding: 0 1.5rem 1.5rem;
    display: flex;
    justify-content: flex-end;
}

@media (max-width: 576px) {
    .modal-card {
        width: 100%;
        border-radius: 22px;
    }
}
.modal-overlay {
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.modal-overlay.active {
    opacity: 1;
    visibility: visible;
}
</style>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
<div class="subjects-container">
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-12">
                <div class="professional-card mx-3">
                    <div class="card-header-professional">
                        <h1><i class="fas fa-graduation-cap me-3"></i>Subjects Management Dashboard</h1>
                    </div>
                    <div id="#success">

                    </div>
                    <div class="card-body p-4">
                        <div class="stats-section">
                            <div class="stat-card">
                                <div class="stat-number">{{ $subjects->count() }}</div>
                                <div class="stat-label">Total Subjects</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ $subjects->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                                <div class="stat-label">This Week</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ $subjects->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                                <div class="stat-label">This Month</div>
                            </div>
                        </div>
                        
                        <div class="stats-divider"></div>
                        
                        <a href="{{ route('subjects.create') }}" class="add-btn-professional">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add New Subject</span>
                        </a>
                        
                        <div class="table-responsive mt-4">
                            <table class="table table-professional w-100">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag me-2"></i>ID</th>
                                        <th><i class="fas fa-book me-2"></i>Subject Name</th>
                                        <th><i class="fas fa-calendar me-2"></i>Created</th>
                                        <th><i class="fas fa-cogs me-2"></i>Status</th>
                                        <th><i class="fas fa-cogs me-2"></i>Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subjects as $index => $subject)
                                    <tr data-subject-id="{{ $subject->id }}">
                                        <td><span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 8px 12px; border-radius: 8px; font-weight: 800; display: inline-block; min-width: 40px; text-align: center; font-size: 0.9rem; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.25);">{{ $index + 1 }}</span></td>
                                        <td class="subject-name"><strong style="color: #1e293b; font-size: 1rem;">{{ $subject->name }}</strong></td>
                                        <td><span style="background: linear-gradient(135deg, rgba(79, 172, 254, 0.12) 0%, rgba(0, 242, 254, 0.08) 100%); color: #1e40af; padding: 8px 12px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; border-left: 3px solid #4facfe;">{{ $subject->created_at->format('M d, Y') }}</span></td>
                                        <td>
                                           
                                                <button type ="button"   class="toggle-status-btn action-btn" data-id="{{ $subject->id }}"
        data-status="{{ $subject->status }}">{{ $subject->status ? 'Active' : 'Inactive' }}</button>
                                         
        
                                        </td>
                                        <td>
                                            <div class="action-buttons-group">
                                                <button type="button" class="action-btn btn-edit" data-id="{{ $subject->id }}" >
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </button>
                                                <button type="button" class="action-btn btn-delete" data-id="{{ $subject->id }}">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="empty-state-professional">
                                        <i class="fas fa-book-open"></i>
                                        <p>No subjects have been added yet.</p>
                                        <p><a href="{{ route('subjects.create') }}">Create your first subject</a> to get started.</p>
                                    </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Mode code ..... --}}

<div class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h2 class="modal-title"><i class="fas fa-book-open me-2"></i>Edit Subject</h2>
            <button type="button" class="modal-close" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <form action="#" method="POST" id="editSubjectForm">
                @csrf
                @method('PUT')
                <div class="form-group-professional">
                    <label for="name" class="name-labelE">
                        Subject Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value=""
                        placeholder="e.g. Mathematics"
                        required
                    >

                    @error('name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-submit-professional updateBtn">
                        <i class="fas fa-save"></i>
                        <span>Update Subject</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('Ajax')
    <script>
    function closeEditModal() {
        $('.modal-overlay').removeClass('active');
        $('#editSubjectForm')[0].reset();
        $('#editSubjectForm').attr('action', '#');
    }

    function showEditModal(subjectId) {
        console.log('showEditModal()', subjectId);
       
        const token = $('meta[name="csrf-token"]').attr('content');
        $('#editSubjectForm').attr('action', `/subjects/${subjectId}`);
        $('#name').prop('disabled', true).val('Loading...');
        $('.modal-overlay').addClass('active');

        $.ajax({
            url: `/subjects/${subjectId}/edit`,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                $('#name').prop('disabled', false).val(response.name);
            },
            error: function(xhr, status, error) {
                console.error("AJAX ERROR STATUS:", status);
                console.error("HTTP STATUS CODE:", xhr.status);
                console.error("RESPONSE TEXT:", xhr.responseText);
                alert("Failed to load subject data. Please try again.");
                closeEditModal();
            }
        });
    }

    function deleteSubject(subjectId) {
        const token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: `/subjects/${subjectId}`,
            type: 'POST',
            data: {
                _token: token,
                _method: 'DELETE'
            },
            success: function(response) {
                $(`tr[data-subject-id="${subjectId}"]`).fadeOut(300, function() {
                    $(this).remove();
                });
                alert(response.message || 'Subject deleted successfully.');
            },
            error: function(xhr, status, error) {
                console.error("AJAX ERROR STATUS:", status);
                console.error("HTTP STATUS CODE:", xhr.status);
                console.error("RESPONSE TEXT:", xhr.responseText);
                if (xhr.status === 404) {
                    alert('Subject not found.');
                } else {
                    alert('Failed to delete subject. Please try again.');
                }
            }
        });
    }

    window.showEditModal = showEditModal;
    window.closeEditModal = closeEditModal;

    
    $(function () {    
        console.log('Subjects AJAX script loaded');
        console.log('jQuery version:', typeof $ === 'function' ? $.fn.jquery : 'jQuery not loaded');
        $(document).on('click', '.toggle-status-btn', function () {
            let button = $(this);
            let id = button.data('id');
            let status = button.data('status');
            $.ajax({
                url: "{{ route('subject.toggle') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: status
                },
                success: function (response) {
                    if (response.status == 1) {
                        button.text('Active');
                        button.data('status', 1);
                    } else {
                        button.text('Inactive');
                        button.data('status', 0);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX ERROR STATUS:", status);
                    console.log("HTTP STATUS CODE:", xhr.status);
                    console.log("RESPONSE TEXT:", xhr.responseText);
                    alert("Error Code: " + xhr.status);
                }
            });
        });

        $(document).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            const subjectId = $(this).attr('data-id') || $(this).data('id');
            
            console.log('btn-edit clicked', subjectId);
            if (!subjectId) {
                console.warn('Edit button clicked without subject ID');
                return;
            }
            showEditModal(subjectId);
        });

        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            const subjectId = $(this).attr('data-id') || $(this).data('id');
            if (!confirm('Are you sure you want to delete this subject? This action cannot be undone.')) {
                return;
            }
            deleteSubject(subjectId);
        });

        $(document).on('click', '.modal-close', function () {
            closeEditModal();
        });

        $('.modal-overlay').on('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        $('#editSubjectForm').on('submit', function (e) {
            e.preventDefault();
            const actionUrl = $(this).attr('action');
            const subjectId = actionUrl.split('/').pop();
            const token = $('meta[name="csrf-token"]').attr('content');
            const subjectName = $('#name').val();

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: {
                    _token: token,
                    _method: 'PUT',
                    name: subjectName
                },
                success: function(response) {
                    closeEditModal();
                    const row = $(`tr[data-subject-id="${subjectId}"]`);
                    row.find('.subject-name strong').text(response.subject.name);
                   
                },
                error: function(xhr, status, error) {
                    console.error("AJAX ERROR STATUS:", status);
                    console.error("HTTP STATUS CODE:", xhr.status);
                    console.error("RESPONSE TEXT:", xhr.responseText);
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        const errorMessage = xhr.responseJSON.errors.name ? xhr.responseJSON.errors.name[0] : 'Invalid input.';
                        alert(errorMessage);
                    } else {
                        alert('Failed to update subject. Please try again.');
                    }
                }
            });
        });
    });
</script>

@endsection
