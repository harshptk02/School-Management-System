<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Time Table Entry') }}
        </h2>
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
        .form-input:not(:placeholder-shown)+.floating-label,
        .form-input:valid+.floating-label {
            top: 0;
            font-size: 12px;
            color: #3b82f6;
            font-weight: 500;
        }

        .form-select:focus+.floating-label,
        .form-select:valid+.floating-label {
            top: 0;
            font-size: 12px;
            color: #3b82f6;
            font-weight: 500;
        }

        .form-input, .form-select {
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .form-input:invalid, .form-select:invalid {
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

        .day-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .day-option {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .day-option:hover {
            border-color: #3b82f6;
            background: #f8fafc;
        }

        .day-option.selected {
            border-color: #3b82f6;
            background: #dbeafe;
        }

        .day-option input[type="radio"] {
            margin-right: 0.5rem;
        }

        .time-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        @media (max-width: 640px) {
            .time-grid {
                grid-template-columns: 1fr;
            }
        }

        .animate-pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('admin.timetables.update', $timetable) }}" method="POST" id="timetableForm">
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

                    <!-- Class Information Section -->
                    <div class="form-section">
                        <h3 class="section-title text-xl flex items-center">
                            <i class="fas fa-graduation-cap mr-2 text-blue-500"></i>
                            Class Information
                        </h3>

                        <div class="form-grid">
                            <div class="input-group">
                                <select name="class" id="class" class="form-select w-full px-4 py-3 rounded-lg" required>
                                    <option value="">Select Class</option>
                                    <option value="1st" @if($timetable->class == '1st') selected @endif>Class 1</option>
                                    <option value="2nd" @if($timetable->class == '2nd') selected @endif>Class 2</option>
                                    <option value="3rd" @if($timetable->class == '3rd') selected @endif>Class 3</option>
                                    <option value="4th" @if($timetable->class == '4th') selected @endif>Class 4</option>
                                    <option value="5th" @if($timetable->class == '5th') selected @endif>Class 5</option>
                                    <option value="6th" @if($timetable->class == '6th') selected @endif>Class 6</option>
                                    <option value="7th" @if($timetable->class == '7th') selected @endif>Class 7</option>
                                    <option value="8th" @if($timetable->class == '8th') selected @endif>Class 8</option>
                                    <option value="9th" @if($timetable->class == '9th') selected @endif>Class 9</option>
                                    <option value="10th" @if($timetable->class == '10th') selected @endif>Class 10</option>
                                    <option value="11th" @if($timetable->class == '11th') selected @endif>Class 11</option>
                                    <option value="12th" @if($timetable->class == '12th') selected @endif>Class 12</option>
                                </select>
                           
                            </div>

                            <div class="input-group">
                                <select name="section" id="section" class="form-select w-full px-4 py-3 rounded-lg" required>
                                    <option value="">Select Section</option>
                                    <option value="A" @if($timetable->section == 'A') selected @endif>Section A</option>
                                    <option value="B" @if($timetable->section == 'B') selected @endif>Section B</option>
                                    <option value="C" @if($timetable->section == 'C') selected @endif>Section C</option>
                                    <option value="D" @if($timetable->section == 'D') selected @endif>Section D</option>
                                    <option value="E" @if($timetable->section == 'E') selected @endif>Section E</option>
                                </select>
                             
                            </div>
                        </div>
                    </div>

                    <!-- Subject and Teacher Section -->
                    <div class="form-section">
                        <h3 class="section-title text-xl flex items-center">
                            <i class="fas fa-book mr-2 text-green-500"></i>
                            Subject & Teacher
                        </h3>

                        <div class="form-grid">
                            <div class="input-group">
                                <input type="text" name="subject" id="subject" value="{{ $timetable->subject }}" class="form-input w-full px-4 py-3 rounded-lg" placeholder=" " required>
                                <label for="subject" class="floating-label">Subject</label>
                            </div>

                            <div class="input-group">
                                <select name="teacher_id" id="teacher_id" class="form-select w-full px-4 py-3 rounded-lg" required>
                                    <option value="">Select Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @if($timetable->teacher_id == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                <label for="teacher_id" class="floating-label">Teacher</label>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Section -->
                    <div class="form-section">
                        <h3 class="section-title text-xl flex items-center">
                            <i class="fas fa-calendar-alt mr-2 text-purple-500"></i>
                            Schedule
                        </h3>

                        <!-- Day Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Select Day</label>
                            <div class="day-selector">
                                <label class="day-option" for="monday">
                                    <input type="radio" name="day" id="monday" value="Monday" @if($timetable->day == 'Monday') checked @endif required>
                                    <span class="text-sm font-medium">Monday</span>
                                </label>
                                <label class="day-option" for="tuesday">
                                    <input type="radio" name="day" id="tuesday" value="Tuesday" @if($timetable->day == 'Tuesday') checked @endif required>
                                    <span class="text-sm font-medium">Tuesday</span>
                                </label>
                                <label class="day-option" for="wednesday">
                                    <input type="radio" name="day" id="wednesday" value="Wednesday" @if($timetable->day == 'Wednesday') checked @endif required>
                                    <span class="text-sm font-medium">Wednesday</span>
                                </label>
                                <label class="day-option" for="thursday">
                                    <input type="radio" name="day" id="thursday" value="Thursday" @if($timetable->day == 'Thursday') checked @endif required>
                                    <span class="text-sm font-medium">Thursday</span>
                                </label>
                                <label class="day-option" for="friday">
                                    <input type="radio" name="day" id="friday" value="Friday" @if($timetable->day == 'Friday') checked @endif required>
                                    <span class="text-sm font-medium">Friday</span>
                                </label>
                                <label class="day-option" for="saturday">
                                    <input type="radio" name="day" id="saturday" value="Saturday" @if($timetable->day == 'Saturday') checked @endif required>
                                    <span class="text-sm font-medium">Saturday</span>
                                </label>
                            </div>
                        </div>

                        <!-- Time Selection -->
                        <div class="time-grid">
                            <div class="input-group">
                                <input type="time" name="start_time" id="start_time" value="{{ $timetable->start_time }}" class="form-input w-full px-4 py-3 rounded-lg" required>
                                <label for="start_time" class="floating-label">Start Time</label>
                            </div>

                            <div class="input-group">
                                <input type="time" name="end_time" id="end_time" value="{{ $timetable->end_time }}" class="form-input w-full px-4 py-3 rounded-lg" required>
                                <label for="end_time" class="floating-label">End Time</label>
                            </div>
                        </div>

                        <!-- Duration Display -->
                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Duration:</span>
                                <span id="duration" class="text-sm font-medium text-gray-800">--</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="btn-primary flex-1 text-white px-6 py-3 rounded-lg font-semibold text-lg shadow-lg">
                            <i class="fas fa-edit mr-2"></i>
                            Update Entry
                        </button>

                        <a href="{{ route('admin.timetables.index') }}" class="btn-secondary flex-1 text-white px-6 py-3 rounded-lg font-semibold text-lg shadow-lg text-center">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Day selection functionality - Set initial selected state
            const dayOptions = document.querySelectorAll('.day-option');
            dayOptions.forEach(option => {
                const radio = option.querySelector('input[type="radio"]');
                if (radio.checked) {
                    option.classList.add('selected');
                }
                
                option.addEventListener('click', function() {
                    dayOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });

            // Duration calculator
            const startTimeInput = document.getElementById('start_time');
            const endTimeInput = document.getElementById('end_time');
            const durationDisplay = document.getElementById('duration');

            function calculateDuration() {
                const startTime = startTimeInput.value;
                const endTime = endTimeInput.value;

                if (startTime && endTime) {
                    const start = new Date(`2000-01-01T${startTime}:00`);
                    const end = new Date(`2000-01-01T${endTime}:00`);
                    
                    if (end > start) {
                        const diffMs = end - start;
                        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
                        const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
                        
                        let durationText = '';
                        if (diffHours > 0) {
                            durationText += `${diffHours}h `;
                        }
                        if (diffMinutes > 0) {
                            durationText += `${diffMinutes}m`;
                        }
                        
                        durationDisplay.textContent = durationText || '0m';
                    } else {
                        durationDisplay.textContent = 'Invalid time range';
                    }
                } else {
                    durationDisplay.textContent = '--';
                }
            }

            startTimeInput.addEventListener('change', calculateDuration);
            endTimeInput.addEventListener('change', calculateDuration);

            // Calculate duration on page load
            calculateDuration();

            // Form validation
            document.getElementById('timetableForm').addEventListener('submit', function(e) {
                const startTime = startTimeInput.value;
                const endTime = endTimeInput.value;

                if (startTime && endTime) {
                    const start = new Date(`2000-01-01T${startTime}:00`);
                    const end = new Date(`2000-01-01T${endTime}:00`);
                    
                    if (end <= start) {
                        e.preventDefault();
                        alert('End time must be after start time!');
                        return;
                    }
                }
            });
        });
    </script>
</x-app-layout>