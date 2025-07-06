

<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <style>
        .form-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-group {
            position: relative;
        }

        .floating-label {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            background: white;
            padding: 0 8px;
            font-size: 14px;
            color: #6b7280;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-input:focus+.floating-label,
        .form-input:not(:placeholder-shown)+.floating-label {
            top: 0;
            font-size: 12px;
            color: #3b82f6;
            font-weight: 500;
        }

        .form-input {
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(107, 114, 128, 0.3);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            color: #1f2937;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <h3 class="section-title text-xl flex items-center">
                            <i class="fas fa-user mr-2 text-blue-500"></i>
                            Personal Information
                        </h3>

                        <div class="form-grid">
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-input w-full px-4 py-3 rounded-lg" 
                                       placeholder=" " value="{{ $teacher->name }}" required>
                                <label for="name" class="floating-label">Full Name</label>
                            </div>

                            <div class="input-group">
                                <input type="email" name="email" id="email" class="form-input w-full px-4 py-3 rounded-lg" 
                                       placeholder=" " value="{{ $teacher->email }}" required>
                                <label for="email" class="floating-label">Email Address</label>
                            </div>
                        </div>

                        <!-- Profile Image Upload Section -->
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-camera mr-2 text-indigo-500"></i>
                                Profile Picture
                            </h4>
                            
                            <div class="flex flex-col md:flex-row items-start gap-6">
                                <!-- Image Preview -->
                                <div class="relative group">
                                    <div class="w-32 h-32 rounded-full border-4 border-gray-300 bg-gray-100 flex items-center justify-center overflow-hidden shadow-lg">
                                        <img id="imagePreview" 
                                             src="{{ $teacher->teacherProfile && $teacher->teacherProfile->profile_image ? asset('storage/' . $teacher->teacherProfile->profile_image) : '' }}" 
                                             alt="Profile Preview" 
                                             class="w-full h-full object-cover {{ $teacher->teacherProfile && $teacher->teacherProfile->profile_image ? '' : 'hidden' }}">
                                        <div id="defaultAvatar" class="text-gray-400 text-center {{ $teacher->teacherProfile && $teacher->teacherProfile->profile_image ? 'hidden' : '' }}">
                                            <i class="fas fa-user-circle text-5xl"></i>
                                            <p class="text-xs mt-1">No Image</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Remove Image Button -->
                                    <button type="button" 
                                            id="removeImage" 
                                            class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full shadow-lg hover:bg-red-600 transition-colors duration-200 {{ $teacher->teacherProfile && $teacher->teacherProfile->profile_image ? '' : 'hidden' }}">
                                        <i class="fas fa-times text-sm"></i>
                                    </button>
                                </div>

                                <!-- Upload Button -->
                                <div class="flex-1">
                                    <label class="block">
                                        <span class="sr-only">Choose profile photo</span>
                                        <input type="file" name="profile_image" id="profile_image" 
                                               class="block w-full text-sm text-gray-500
                                                      file:mr-4 file:py-2 file:px-4
                                                      file:rounded-full file:border-0
                                                      file:text-sm file:font-semibold
                                                      file:bg-blue-50 file:text-blue-700
                                                      hover:file:bg-blue-100
                                                      cursor-pointer"
                                               accept="image/*">
                                    </label>
                                    <p class="text-sm text-gray-500 mt-2">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information Section -->
                    <div class="form-section">
                        <h3 class="section-title text-xl flex items-center">
                            <i class="fas fa-graduation-cap mr-2 text-blue-500"></i>
                            Academic Information
                        </h3>

                        <div class="form-grid">
                            <div class="input-group">
                                <input type="text" name="employee_id" id="employee_id" 
                                       class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " 
                                       value="{{ $teacher->teacherProfile->employee_id ?? '' }}" required>
                                <label for="employee_id" class="floating-label">Employee ID</label>
                            </div>

                            <div class="input-group">
                                <input type="text" name="subject" id="subject" 
                                       class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " 
                                       value="{{ $teacher->teacherProfile->subject ?? '' }}" required>
                                <label for="subject" class="floating-label">Subject</label>
                            </div>

                            <div class="input-group">
                                <input type="text" name="qualification" id="qualification" 
                                       class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " 
                                       value="{{ $teacher->teacherProfile->qualification ?? '' }}" required>
                                <label for="qualification" class="floating-label">Qualification</label>
                            </div>

                           
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 mt-6">
                        <a href="{{ route('admin.teachers.index') }}" 
                           class="btn-secondary px-6 py-3 rounded-lg text-white font-semibold">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="btn-primary px-6 py-3 rounded-lg text-white font-semibold">
                            Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('profile_image');
            const imagePreview = document.getElementById('imagePreview');
            const defaultAvatar = document.getElementById('defaultAvatar');
            const removeButton = document.getElementById('removeImage');

            // Handle image preview
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        defaultAvatar.classList.add('hidden');
                        removeButton.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Handle image removal
            removeButton.addEventListener('click', function() {
                imageInput.value = '';
                imagePreview.src = '';
                imagePreview.classList.add('hidden');
                defaultAvatar.classList.remove('hidden');
                removeButton.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
