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

        .form-input:invalid {
            border-color: #ef4444;
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

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #3b82f6;
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

        .strength-meter {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .animate-pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
            <form action="{{ route('admin.teachers.store') }}" method="POST" id="teacherForm" enctype="multipart/form-data">
    @csrf
    @method('POST')

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
                <input type="text" name="name" id="name" class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " required>
                <label for="name" class="floating-label">Full Name</label>
            </div>

            <div class="input-group">
                <input type="email" name="email" id="email" class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " required>
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
                             src="" 
                             alt="Profile Preview" 
                             class="w-full h-full object-cover hidden">
                        <div id="defaultAvatar" class="text-gray-400 text-center">
                            <i class="fas fa-user-circle text-5xl"></i>
                            <p class="text-xs mt-1">No Image</p>
                        </div>
                    </div>
                    
                    <!-- Remove Image Button -->
                    <button type="button" 
                            id="removeImage" 
                            class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full shadow-lg hover:bg-red-600 transition-colors duration-200 hidden">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>

                <!-- Upload Controls -->
                <div class="flex-1">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition-colors duration-200">
                        <input type="file" 
                               name="profile_image" 
                               id="profileImage" 
                               accept="image/*" 
                               class="hidden">
                        
                        <div class="mb-4">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                        </div>
                        
                        <label for="profileImage" class="cursor-pointer">
                            <span class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition-colors duration-200 inline-block">
                                <i class="fas fa-upload mr-2"></i>
                                Choose Image
                            </span>
                        </label>
                        
                        <p class="text-gray-500 text-sm mt-2">
                            Drag and drop or click to select
                        </p>
                        <p class="text-gray-400 text-xs mt-1">
                            PNG, JPG, GIF up to 5MB
                        </p>
                    </div>
                    
                    <!-- Image Info -->
                    <div id="imageInfo" class="mt-3 text-sm text-gray-600 hidden">
                        <div class="flex items-center justify-between">
                            <span id="fileName"></span>
                            <span id="fileSize" class="text-gray-500"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Security Section -->
    <div class="form-section">
        <h3 class="section-title text-xl flex items-center">
            <i class="fas fa-lock mr-2 text-green-500"></i>
            Security Information
        </h3>

        <div class="form-grid">
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-input w-full px-4 py-3 pr-12 rounded-lg" placeholder=" " required>
                <label for="password" class="floating-label">Password</label>
                <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                <div class="strength-meter">
                    <div class="strength-fill" id="strengthFill"></div>
                </div>
                <small class="text-gray-500 text-sm mt-1 block">Password strength: <span id="strengthText">Weak</span></small>
            </div>

            <div class="input-group">
                <input type="password" name="password_confirmation" id="confirmPassword" class="form-input w-full px-4 py-3 pr-12 rounded-lg" placeholder=" " required>
                <label for="confirmPassword" class="floating-label">Confirm Password</label>
                <i class="fas fa-eye password-toggle" onclick="togglePassword('confirmPassword')"></i>
                <div class="mt-2">
                    <small class="text-gray-500 text-sm" id="passwordMatch"></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Academic Information Section -->
    <div class="form-section">
        <h3 class="section-title text-xl flex items-center">
            <i class="fas fa-graduation-cap mr-2 text-purple-500"></i>
            Academic Information
        </h3>

        <div class="form-grid">
            <div class="input-group">
                <input type="text" name="employee_id" id="employee_id" class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " required>
                <label for="employee_id" class="floating-label">Teacher ID</label>
            </div>

            <div class="input-group">
                <select name="subject" id="subject" class="form-input w-full px-4 py-3 rounded-lg" required>
                    <option value="">Select Subject</option>
                    <option value="Hindi">Hindi</option>
                    <option value="English">English</option>
                    <option value="Maths">Maths</option>
                    <option value="Science">Science</option>
                    <option value="SST">SST</option>
                </select>
                <label for="subject" class="floating-label">Subject</label>
            </div>

            <div class="input-group">
                <input type="text" name="qualification" id="qualification" class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " required>
                <label for="qualification" class="floating-label">Qualification</label>
            </div>

        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
        <button type="submit" class="btn-primary flex-1 text-white px-6 py-3 rounded-lg font-semibold text-lg shadow-lg">
            <i class="fas fa-user-plus mr-2"></i>
            Create Teacher
        </button>

        <a href="{{ route('admin.teachers.index') }}" class="btn-secondary flex-1 text-white px-6 py-3 rounded-lg font-semibold text-lg shadow-lg text-center">
            <i class="fas fa-times mr-2"></i>
            Cancel
        </a>
    </div>
</form>
            </div>
        </div>
    </div>

    <script>
        // Password visibility toggle
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.nextElementSibling;

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            const checks = [
                /.{8,}/, // At least 8 characters
                /[a-z]/, // Lowercase letter
                /[A-Z]/, // Uppercase letter
                /[0-9]/, // Number
                /[^A-Za-z0-9]/ // Special character
            ];

            checks.forEach(check => {
                if (check.test(password)) strength++;
            });

            return strength;
        }

        // Update password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');

            const colors = ['#ef4444', '#f59e0b', '#eab308', '#22c55e', '#16a34a'];
            const texts = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];

            strengthFill.style.width = `${(strength / 5) * 100}%`;
            strengthFill.style.backgroundColor = colors[strength - 1] || '#e5e7eb';
            strengthText.textContent = texts[strength - 1] || 'Very Weak';
        });

        // Password confirmation checker
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const matchText = document.getElementById('passwordMatch');

            if (confirmPassword === '') {
                matchText.textContent = '';
                return;
            }

            if (password === confirmPassword) {
                matchText.textContent = '✓ Passwords match';
                matchText.className = 'text-green-600 text-sm';
            } else {
                matchText.textContent = '✗ Passwords do not match';
                matchText.className = 'text-red-600 text-sm';
            }
        });

        // Set default admission date to today
        document.getElementById('admission_date').valueAsDate = new Date();

        // Auto-generate student ID based on class and current year
        document.getElementById('class').addEventListener('change', function() {
            const classValue = this.value;
            if (classValue) {
                const year = new Date().getFullYear();
                const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
                const studentId = `${year}${classValue.padStart(2, '0')}${random}`;
                document.getElementById('student_id').value = studentId;
            }
        });

        // Form validation
        document.getElementById('studentForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return;
            }

            if (checkPasswordStrength(password) < 3) {
                e.preventDefault();
                alert('Password is too weak! Please use at least 8 characters with a mix of letters, numbers, and special characters.');
                return;
            }
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('profileImage');
    const imagePreview = document.getElementById('imagePreview');
    const defaultAvatar = document.getElementById('defaultAvatar');
    const removeImageBtn = document.getElementById('removeImage');
    const imageInfo = document.getElementById('imageInfo');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const uploadArea = fileInput.closest('.border-dashed');

    // Handle file selection
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            handleFileUpload(file);
        }
    });

    // Handle drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('border-indigo-400', 'bg-indigo-50');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('border-indigo-400', 'bg-indigo-50');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('border-indigo-400', 'bg-indigo-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                fileInput.files = files;
                handleFileUpload(file);
            }
        }
    });

    // Remove image
    removeImageBtn.addEventListener('click', function() {
        fileInput.value = '';
        imagePreview.src = '';
        imagePreview.classList.add('hidden');
        defaultAvatar.classList.remove('hidden');
        removeImageBtn.classList.add('hidden');
        imageInfo.classList.add('hidden');
    });

    function handleFileUpload(file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            return;
        }

        // Validate file size (5MB limit)
        if (file.size > 5 * 1024 * 1024) {
            alert('File size should not exceed 5MB.');
            return;
        }

        // Create file reader
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('hidden');
            defaultAvatar.classList.add('hidden');
            removeImageBtn.classList.remove('hidden');
            
            // Show file info
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            imageInfo.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
</script>
</x-app-layout>