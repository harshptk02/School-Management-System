<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <style>
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .gradient-bg-1 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-bg-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-bg-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .gradient-bg-4 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        .number-animation {
            animation: countUp 1s ease-out;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .shimmer {
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.4),
                    transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }
    </style>


    <section>
        <div class="py-2">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Notifications Section -->
                <div class="mb-8">
                    @foreach($notifications as $notification)
                    <div class="notification-card bg-white rounded-lg shadow-md p-4 mb-4 transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center">
                                    @if($notification->user->role === 'teacher' && $notification->user->teacherProfile && $notification->user->teacherProfile->profile_image)
                                    <img src="{{ asset('storage/' . $notification->user->teacherProfile->profile_image) }}" alt="{{ $notification->user->name }}" class="w-10 h-10  border-2 border-zinc-400 rounded-full object-cover">
                                    @elseif($notification->user->role === 'student' && $notification->user->studentProfile && $notification->user->studentProfile->profile_image)
                                    <img src="{{ asset('storage/' . $notification->user->studentProfile->profile_image) }}" alt="{{ $notification->user->name }}" class="w-10 h-10 border-2 border-zinc-400 rounded-full object-cover">
                                    @else
                                    <div class="@if($notification->type === 'admin') bg-blue-100 text-blue-600 @elseif($notification->type === 'teacher') bg-yellow-100 text-yellow-600 @else bg-purple-100 text-purple-600 @endif p-2 rounded-full">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-gray-800 font-medium">{{ $notification->message }}</p>
                                    <p class="text-gray-500 text-sm">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Users Card -->
                    <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden relative group">
                        <div class="absolute inset-0 gradient-bg-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-blue-100 rounded-full group-hover:bg-white/20 transition-colors duration-300">
                                    <svg class="w-8 h-8 text-blue-600 group-hover:text-white icon-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs text-gray-500 group-hover:text-white/80 font-medium uppercase tracking-wide">Growth</div>
                                    <div class="text-sm font-semibold text-green-600 group-hover:text-green-300">+12.5%</div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="text-3xl font-bold text-blue-600 group-hover:text-white number-animation">{{ $totalUsers ?? '1,234' }}</div>
                                <div class="text-gray-600 group-hover:text-white/80 font-medium">Total Users</div>
                            </div>
                            <div class="w-full bg-blue-100 rounded-full h-2 group-hover:bg-white/20">
                                <div class="bg-blue-600 h-2 rounded-full group-hover:bg-white transition-all duration-300" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full -translate-y-8 translate-x-8 group-hover:scale-110 transition-transform duration-300"></div>
                    </div>


                    <!-- Admins Card -->
                    <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden relative group">
                        <div class="absolute inset-0 gradient-bg-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-green-100 rounded-full group-hover:bg-white/20 transition-colors duration-300">
                                    <svg class="w-8 h-8 text-green-600 group-hover:text-white icon-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs text-gray-500 group-hover:text-white/80 font-medium uppercase tracking-wide">Active</div>
                                    <div class="text-sm font-semibold text-green-600 group-hover:text-green-300">{{ ($totalAdmins ?? 5) - 1 }}/{{ $totalAdmins ?? 5 }}</div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="text-3xl font-bold text-green-600 group-hover:text-white number-animation">{{ $totalAdmins ?? '5' }}</div>
                                <div class="text-gray-600 group-hover:text-white/80 font-medium">Admins</div>
                            </div>
                            <div class="w-full bg-green-100 rounded-full h-2 group-hover:bg-white/20">
                                <div class="bg-green-600 h-2 rounded-full group-hover:bg-white transition-all duration-300" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400/20 to-teal-400/20 rounded-full -translate-y-8 translate-x-8 group-hover:scale-110 transition-transform duration-300"></div>
                    </div>

                    <!-- Teachers Card -->
                    <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden relative group">
                        <div class="absolute inset-0 gradient-bg-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-yellow-100 rounded-full group-hover:bg-white/20 transition-colors duration-300">
                                    <svg class="w-8 h-8 text-yellow-600 group-hover:text-white icon-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs text-gray-500 group-hover:text-white/80 font-medium uppercase tracking-wide">Online</div>
                                    <div class="text-sm font-semibold text-green-600 group-hover:text-green-300">{{ floor(($totalTeachers ?? 45) * 0.8) }}</div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="text-3xl font-bold text-yellow-600 group-hover:text-white number-animation">{{ $totalTeachers ?? '45' }}</div>
                                <div class="text-gray-600 group-hover:text-white/80 font-medium">Teachers</div>
                            </div>
                            <div class="w-full bg-yellow-100 rounded-full h-2 group-hover:bg-white/20">
                                <div class="bg-yellow-600 h-2 rounded-full group-hover:bg-white transition-all duration-300" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-400/20 to-orange-400/20 rounded-full -translate-y-8 translate-x-8 group-hover:scale-110 transition-transform duration-300"></div>
                    </div>

                    <!-- Students Card -->
                    <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden relative group">
                        <div class="absolute inset-0 gradient-bg-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-purple-100 rounded-full group-hover:bg-white/20 transition-colors duration-300">
                                    <svg class="w-8 h-8 text-purple-600 group-hover:text-white icon-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs text-gray-500 group-hover:text-white/80 font-medium uppercase tracking-wide">Active</div>
                                    <div class="text-sm font-semibold text-green-600 group-hover:text-green-300">{{ floor(($totalStudents ?? 892) * 0.95) }}</div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="text-3xl font-bold text-purple-600 group-hover:text-white number-animation">{{ $totalStudents ?? '892' }}</div>
                                <div class="text-gray-600 group-hover:text-white/80 font-medium">Students</div>
                            </div>
                            <div class="w-full bg-purple-100 rounded-full h-2 group-hover:bg-white/20">
                                <div class="bg-purple-600 h-2 rounded-full group-hover:bg-white transition-all duration-300" style="width: 95%"></div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full -translate-y-8 translate-x-8 group-hover:scale-110 transition-transform duration-300"></div>
                    </div>
                </div>


                <!-- Add Chart Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Users Chart -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">User Statistics</h3>
                        <div id="usersChart">{!! $usersChart->renderHtml() !!}</div>
                    </div>

                    <!-- Teachers vs Students Chart -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Teachers vs Students</h3>
                        <div class="chart-container" id="roleChart">{!! $roleChart->renderHtml() !!}</div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <script>
        // Add number counting animation
        function animateNumbers() {
            const numberElements = document.querySelectorAll('.number-animation');

            numberElements.forEach(element => {
                const finalNumber = parseInt(element.textContent.replace(/,/g, ''));
                let currentNumber = 0;
                const increment = finalNumber / 50;

                const timer = setInterval(() => {
                    currentNumber += increment;
                    if (currentNumber >= finalNumber) {
                        element.textContent = finalNumber.toLocaleString();
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(currentNumber).toLocaleString();
                    }
                }, 30);
            });
        }

        // Trigger animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(animateNumbers, 500);
        });

        // Add shimmer effect on hover
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const shimmer = document.createElement('div');
                shimmer.className = 'absolute inset-0 shimmer opacity-30 pointer-events-none';
                this.appendChild(shimmer);

                setTimeout(() => {
                    shimmer.remove();
                }, 2000);
            });
        });
    </script>


    {!! $usersChart->renderChartJsLibrary() !!}
    {!! $usersChart->renderJs() !!}
    {!! $roleChart->renderJs() !!}

</x-app-layout>