<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        
        <!-- Sidebar CSS -->
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
            
            <!-- Sidebar Component - Determine role based on auth user -->
            @auth
                @php
                    $userRole = auth()->user()->role;
                @endphp
                <x-sidebar :role="$userRole" />
            @endauth

            <div class="@auth home @endauth">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Breadcrumbs -->
                @auth
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                        @php
                            $breadcrumbs = [];
                            $currentUrl = url()->current();
                            $routeName = Route::currentRouteName();
                            
                            if (str_contains($routeName, 'admin.')) {
                                $breadcrumbs[] = ['label' => 'Admin', 'url' => route('admin.dashboard')];
                                
                                if ($routeName === 'admin.dashboard') {
                                    $breadcrumbs[] = ['label' => 'Dashboard'];
                                } elseif (str_contains($routeName, 'admin.teachers')) {
                                    $breadcrumbs[] = ['label' => 'Teachers', 'url' => route('admin.teachers.index')];
                                    
                                    if ($routeName === 'admin.teachers.create') {
                                        $breadcrumbs[] = ['label' => 'Create'];
                                    } elseif ($routeName === 'admin.teachers.edit') {
                                        $breadcrumbs[] = ['label' => 'Edit'];
                                    } elseif ($routeName === 'admin.teachers.show') {
                                        $breadcrumbs[] = ['label' => 'View'];
                                    }
                                } elseif (str_contains($routeName, 'admin.students')) {
                                    $breadcrumbs[] = ['label' => 'Students', 'url' => route('admin.students.index')];
                                    
                                    if ($routeName === 'admin.students.create') {
                                        $breadcrumbs[] = ['label' => 'Create'];
                                    } elseif ($routeName === 'admin.students.edit') {
                                        $breadcrumbs[] = ['label' => 'Edit'];
                                    } elseif ($routeName === 'admin.students.show') {
                                        $breadcrumbs[] = ['label' => 'View'];
                                    }
                                } elseif (str_contains($routeName, 'admin.timetables')) {
                                    $breadcrumbs[] = ['label' => 'Time Tables', 'url' => route('admin.timetables.index')];
                                    
                                    if ($routeName === 'admin.timetables.create') {
                                        $breadcrumbs[] = ['label' => 'Create'];
                                    } elseif ($routeName === 'admin.timetables.edit') {
                                        $breadcrumbs[] = ['label' => 'Edit'];
                                    }
                                }
                            } elseif (str_contains($routeName, 'teacher.')) {
                                $breadcrumbs[] = ['label' => 'Teacher', 'url' => route('teacher.dashboard')];
                                
                                if ($routeName === 'teacher.dashboard') {
                                    $breadcrumbs[] = ['label' => 'Dashboard'];
                                }
                            } elseif (str_contains($routeName, 'student.')) {
                                $breadcrumbs[] = ['label' => 'Student', 'url' => route('student.dashboard')];
                                
                                if ($routeName === 'student.dashboard') {
                                    $breadcrumbs[] = ['label' => 'Dashboard'];
                                }
                            }
                        @endphp
                        
                        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
                    </div>
                @endauth

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        
        <!-- Sidebar JS -->
        <script src="{{ asset('js/sidebar.js') }}"></script>
    </body>
</html>