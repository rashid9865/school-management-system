
                        <form action="{{ route('subjects.update', $subject->id) }}" method="POST" id="editSubjectForm">
                            @csrf
                            @method('PUT')

                            <div class="form-group-professional">
                                <label for="name" class="form-label-professional">
                                    Subject Name
                                </label>
                                <input
                                    type="text"
                                    value="{{ old('name', $subject->name) }}"
                                    required
                                    
                                >
                                <div class="form-help-text">
                                    Use a concise, descriptive subject name like "Mathematics" or "Chemistry".
                                </div>
                                @error('name')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-submit-professional">
                                    <i class="fas fa-save"></i>
                                    <span>Update Subject</span>
                                </button>
                                <a href="{{ route('subjects.index') }}" >
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Back to Subjects</span>
                                </a>
                            </div>
                        </form>
                   