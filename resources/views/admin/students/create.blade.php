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
        
        .form-input:focus + .floating-label,
        .form-input:not(:placeholder-shown) + .floating-label {
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
            <form action="{{ route('admin.students.store') }}" method="POST" id="studentForm" enctype="multipart/form-data">
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
                        <input type="text" name="student_id" id="student_id" class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " required>
                        <label for="student_id" class="floating-label">Student ID</label>
                    </div>
                    
                    <div class="input-group">
                        <select name="class" id="class" class="form-input w-full px-4 py-3 rounded-lg" required>
                            <option value="">Select Class</option>
                            <option value="1">Class 1</option>
                            <option value="2">Class 2</option>
                            <option value="3">Class 3</option>
                            <option value="4">Class 4</option>
                            <option value="5">Class 5</option>
                            <option value="6">Class 6</option>
                            <option value="7">Class 7</option>
                            <option value="8">Class 8</option>
                            <option value="9">Class 9</option>
                            <option value="10">Class 10</option>
                            <option value="11">Class 11</option>
                            <option value="12">Class 12</option>
                        </select>
                        <label for="class" class="floating-label">Class</label>
                    </div>
                    
                    <div class="input-group">
                        <select name="section" id="section" class="form-input w-full px-4 py-3 rounded-lg" required>
                            <option value="">Select Section</option>
                            <option value="A">Section A</option>
                            <option value="B">Section B</option>
                            <option value="C">Section C</option>
                            <option value="D">Section D</option>
                            <option value="E">Section E</option>
                        </select>
                        <label for="section" class="floating-label">Section</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="date" name="admission_date" id="admission_date" class="form-input w-full px-4 py-3 rounded-lg" required>
                        <label for="admission_date" class="floating-label">Admission Date</label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn-primary flex-1 text-white px-6 py-3 rounded-lg font-semibold text-lg shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create Student
                </button>
                
                <a href="{{ route('admin.students.index') }}" class="btn-secondary flex-1 text-white px-6 py-3 rounded-lg font-semibold text-lg shadow-lg text-center">
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
</x-app-layout>
