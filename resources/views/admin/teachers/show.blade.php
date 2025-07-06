<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-card {
            background: white;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: #3b82f6;
        }

        .timetable-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        .day-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .day-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .day-header {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 1rem;
            font-weight: 600;
            text-align: center;
        }

        .time-slot {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.3s ease;
        }

        .time-slot:hover {
            background-color: #f8fafc;
        }

        .time-slot:last-child {
            border-bottom: none;
        }

        .subject-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .subject-math {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .subject-science {
            background-color: #dcfce7;
            color: #166534;
        }

        .subject-english {
            background-color: #fef3c7;
            color: #92400e;
        }

        .subject-history {
            background-color: #fce7f3;
            color: #be185d;
        }

        .subject-geography {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .subject-default {
            background-color: #f3f4f6;
            color: #374151;
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

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .avatar-placeholder {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            margin: 0 auto 1rem;
            border: 4px solid white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .profile-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #22c55e;
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            border: 3px solid white;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }

        @media (max-width: 768px) {
            .timetable-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="profile-header rounded-2xl p-8 mb-8 relative overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row items-center text-white">
                        <div class="relative mb-6 md:mb-0 md:mr-8">
                            <div class="avatar-placeholder">
                                @if ($teacher->teacherProfile->profile_image)
                                <img src="{{ asset('storage/' . $teacher->teacherProfile->profile_image) }}" alt="Profile Image" class="w-full h-auto rounded-full">
                                @else
                                <i class="fas fa-user-graduate"></i>
                                @endif
                            </div>
                            <div class="profile-badge">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="text-center md:text-left flex-1">
                            <h1 class="text-4xl font-bold mb-2" id="teacherName">{{ $teacher->name }}</h1>
                            <p class="text-xl opacity-90 mb-4" id="teacherEmail">{{ $teacher->email }}</p>
                            <div class="flex flex-wrap justify-center md:justify-start gap-4 text-sm">
                                <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                                    <i class="fas fa-id-card mr-2"></i>
                                    Teacher ID: <span id="teacherId">{{ $teacher->teacherProfile->employee_id ?? 'N/A' }}</span>
                                </div>
                                <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                                    <i class="fas fa-graduation-cap mr-2"></i>
                                    Subject: <span id="headerClass">{{ $teacher->teacherProfile->subject ?? 'N/A' }}</span>
                                </div>
                                <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Qualification: <span id="admissionDate">{{ $teacher->teacherProfile->qualification ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="text-3xl font-bold text-blue-600 mb-2"> <span id="teacherSubject">{{ $teacher->teacherProfile->subject ?? 'N/A' }}</span></div>
                    <div class="text-gray-600">Subject</div>
                </div>
                <div class="stat-card">
                    <div class="text-3xl font-bold text-green-600 mb-2"> <span id="teacherQualification">{{ $teacher->teacherProfile->qualification ?? 'N/A' }}</span></div>
                    <div class="text-gray-600">Qualification</div>
                </div>
                <div class="stat-card">
                    <div class="text-3xl font-bold text-purple-600 mb-2" id="totalSubjects">5</div>
                    <div class="text-gray-600">Total Subjects</div>
                </div>
                <div class="stat-card">
                    <div class="text-3xl font-bold text-orange-600 mb-2" id="weeklyHours">15</div>
                    <div class="text-gray-600">Weekly Hours</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn-warning flex-1 text-white px-6 py-3 rounded-lg font-semibold shadow-lg text-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Teacher
                </a>
                <a href="{{ route('admin.teachers.index') }}" class="btn-secondary flex-1 text-white px-6 py-3 rounded-lg font-semibold shadow-lg text-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to List
                </a>
            </div>

           
        </div>
    </div>
</x-app-layout>