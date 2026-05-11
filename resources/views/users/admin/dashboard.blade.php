@extends('users.admin.layout')

@section('title')
Admin Dashboard
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

.dashboard-container {
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
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
    padding: 0.5rem 0;
}

.stat-card {
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
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.2);
}

.stat-card h2 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0.5rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-card p {
    font-size: 1.1rem;
    font-weight: 600;
    color: #6b7280;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-card .stat-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    opacity: 0.8;
}

.dashboard-tabs {
    display: flex;
    gap: 0;
    border-bottom: 2px solid #e5e7eb;
    margin-bottom: 2rem;
    background: #f8fafc;
    border-radius: 12px 12px 0 0;
    overflow: hidden;
}

.dashboard-tabs button {
    flex: 1;
    padding: 1.25rem 2rem;
    background: white;
    border: none;
    cursor: pointer;
    font-weight: 600;
    color: #6b7280;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    position: relative;
}

.dashboard-tabs button.active {
    color: #667eea;
    border-bottom-color: #667eea;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
}

.dashboard-tabs button:hover {
    background: #f1f5f9;
}

.tab-content {
    display: none;
    padding: 2rem;
}

.tab-content.active {
    display: block;
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

.btn-success {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    color: white;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(67, 233, 123, 0.4);
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

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem 0;
    }

    .card-header-professional {
        padding: 2rem 1.5rem;
    }

    .card-header-professional h1 {
        font-size: 1.5rem;
    }

    .stats-section {
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        padding: 1.5rem;
    }

    .stat-card h2 {
        font-size: 2.5rem;
    }

    .dashboard-tabs {
        flex-direction: column;
    }

    .dashboard-tabs button {
        padding: 1rem;
        font-size: 0.9rem;
    }

    .tab-content {
        padding: 1rem;
    }

    .data-table {
        font-size: 0.875rem;
    }

    .data-table th,
    .data-table td {
        padding: 0.75rem 0.5rem;
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

@media (max-width: 480px) {
    .card-header-professional h1 {
        font-size: 1.25rem;
    }

    .stat-card h2 {
        font-size: 2rem;
    }

    .data-table th,
    .data-table td {
        padding: 0.5rem 0.25rem;
        font-size: 0.8rem;
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

.stat-card {
    animation: fadeInUp 0.6s ease-out;
    animation-delay: 0.2s;
    animation-fill-mode: both;
}
</style>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            tabButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            button.classList.add('active');

            // Hide all tab contents
            tabContents.forEach(content => content.classList.remove('active'));

            // Show corresponding tab content
            const tabId = button.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.add('active');
        });
    });

    // AJAX Delete Handler
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
            e.preventDefault();
            const btn = e.target.closest('.delete-btn');
            const id = btn.getAttribute('data-id');
            const type = btn.getAttribute('data-type');

            if (confirm('Are you sure you want to delete this ' + type + '?')) {
                fetch('/api/' + type + '/delete/' + id, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the row from the table
                        const row = btn.closest('tr');
                        row.style.opacity = '0';
                        setTimeout(() => {
                            row.remove();
                            // Show success message
                            showAlert('success', data.message);
                            // Reload page after 1.5 seconds
                            setTimeout(() => location.reload(), 1500);
                        }, 300);
                    } else {
                        showAlert('error', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'An error occurred while deleting the record.');
                });
            }
        }
    });

    // Alert function
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-' + type;
        alertDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
        `;
        alertDiv.textContent = message;
        document.body.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    }

    // Add slide animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection

@section('content')
<div class="dashboard-container">
    <div class="container-fluid">
        <div class="professional-card">
            <div class="card-header-professional">
                <h1><i class="fas fa-tachometer-alt me-3"></i>Admin Dashboard</h1>
            </div>

            <div class="stats-section">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h2>{{ $students->count() }}</h2>
                    <p>Total Students</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h2>{{ $teachers->count() }}</h2>
                    <p>Total Teachers</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h2>12</h2>
                    <p>Active Subjects</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h2>85%</h2>
                    <p>Attendance Rate</p>
                </div>
            </div>

            <div class="dashboard-tabs">
                <button class="tab-button active" data-tab="students">
                    <i class="fas fa-user-graduate me-2"></i>Students
                </button>
                <button class="tab-button" data-tab="teachers">
                    <i class="fas fa-chalkboard-teacher me-2"></i>Teachers
                </button>
            </div>

            <!-- Students Tab -->
            <div id="students-tab" class="tab-content active">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0"><i class="fas fa-users me-2"></i>Student Management</h3>
                    <a href="{{ route('student.register') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Add Student
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-1"></i>Name</th>
                                <th><i class="fas fa-envelope me-1"></i>Email</th>
                                <th><i class="fas fa-user-friends me-1"></i>Father Name</th>
                                <th><i class="fas fa-map-marker-alt me-1"></i>Address</th>
                                <th><i class="fas fa-birthday-cake me-1"></i>Age</th>
                                <th><i class="fas fa-cogs me-1"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($students->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                    <p class="text-muted">No students found.</p>
                                </td>
                            </tr>
                            @else
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->father_name ?? 'N/A' }}</td>
                                <td>{{ $student->address ?? 'N/A' }}</td>
                                <td>{{ $student->age ?? 'N/A' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('student.show', $student->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>View
                                        </a>
                                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>Edit
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $student->id }}" data-type="student">
                                            <i class="fas fa-trash"></i>Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Teachers Tab -->
            <div id="teachers-tab" class="tab-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>Teacher Management</h3>
                    <a href="{{ route('teacher.register') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Add Teacher
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-1"></i>Name</th>
                                <th><i class="fas fa-envelope me-1"></i>Email</th>
                                <th><i class="fas fa-calendar me-1"></i>Hire Date</th>
                                <th><i class="fas fa-graduation-cap me-1"></i>Qualification</th>
                                <th><i class="fas fa-phone me-1"></i>Phone</th>
                                <th><i class="fas fa-cogs me-1"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($teachers->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-muted mb-2"></i>
                                    <p class="text-muted">No teachers found.</p>
                                </td>
                            </tr>
                            @else
                            @foreach($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->hire_date ? \Carbon\Carbon::parse($teacher->hire_date)->format('M d, Y') : 'N/A' }}</td>
                                <td>{{ $teacher->qualification ?? 'N/A' }}</td>
                                <td>{{ $teacher->phone ?? 'N/A' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('teacher.show', $teacher->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>View
                                        </a>
                                        <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>Edit
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $teacher->id }}" data-type="teacher">
                                            <i class="fas fa-trash"></i>Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection