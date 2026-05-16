@extends('users.admin.layout')

@section('title')
Update Student
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
.page-section { padding: 2rem 0; }

.form-card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
    overflow: hidden;
}

.form-card-header {
    padding: 2rem 2.5rem;
    background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
    color: #ffffff;
}

.form-card-body { padding: 2.5rem; }

.form-group { margin-bottom: 1.3rem; }

.form-group label {
    display: block;
    margin-bottom: 0.65rem;
    font-weight: 600;
}

.form-control {
    border-radius: 12px;
    padding: 0.95rem 1rem;
}
</style>
@endsection

@section('content')
<div class="page-section">
    <div class="container">
        <div class="form-card">

            <div class="form-card-header">
                <h2><i class="fas fa-user-edit me-2"></i>Update Student</h2>
            </div>

            <div class="form-card-body">
                 <p class="text-success">{{ session('success') }}</p>
                <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- STUDENT INFO --}}
                    <h4>Student Information</h4>

                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                   value="{{ old('first_name', $student->first_name) }}">
                            @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                   value="{{ old('last_name', $student->last_name) }}">
                            @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $student->email) }}">
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control"
                                   value="{{ old('date_of_birth', $student->date_of_birth) }}">
                            @error('date_of_birth') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"
                                   value="{{ old('address', $student->address) }}">
                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">

                            @if($student->image)
                                <img src="{{ asset('storage/'.$student->image) }}" width="80" class="mt-2">
                            @endif

                            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    {{-- FATHER INFO --}}
                    <h4>Father Information</h4>

                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input type="text" name="father_first_name" class="form-control"
                                   value="{{ old('father_first_name', $student->father_first_name) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input type="text" name="father_last_name" class="form-control"
                                   value="{{ old('father_last_name', $student->father_last_name) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input type="number" name="phone_no" class="form-control"
                                   value="{{ old('phone_no', $student->phone_no) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Occupation</label>
                            <input type="text" name="father_occupation" class="form-control"
                                   value="{{ old('father_occupation', $student->father_occupation) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="email" name="father_email" class="form-control"
                                   value="{{ old('father_email', $student->father_email) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Age</label>
                            <input type="number" name="father_age" class="form-control"
                                   value="{{ old('father_age', $student->father_age) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input type="text" name="father_address" class="form-control"
                                   value="{{ old('father_address', $student->father_address) }}">
                        </div>

                    </div>

                    {{-- MOTHER INFO --}}
                    <h4>Mother Information</h4>

                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input type="text" name="mother_first_name" class="form-control"
                                   value="{{ old('mother_first_name', $student->mother_first_name) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input type="text" name="mother_last_name" class="form-control"
                                   value="{{ old('mother_last_name', $student->mother_last_name) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input type="number" name="mother_phone_no" class="form-control"
                                   value="{{ old('mother_phone_no', $student->mother_phone_no) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Age</label>
                            <input type="number" name="mother_age" class="form-control"
                                   value="{{ old('mother_age', $student->mother_age) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="email" name="mother_email" class="form-control"
                                   value="{{ old('mother_email', $student->mother_email) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Occupation</label>
                            <input type="text" name="mother_occupation" class="form-control"
                                   value="{{ old('mother_occupation', $student->mother_occupation) }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input type="text" name="mother_address" class="form-control"
                                   value="{{ old('mother_address', $student->mother_address) }}">
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        Save Changes
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>
@endsection