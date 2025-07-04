<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</div>
                    <div class="text-gray-600">Total Users</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-green-600">{{ $totalAdmins }}</div>
                    <div class="text-gray-600">Admins</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-yellow-600">{{ $totalTeachers }}</div>
                    <div class="text-gray-600">Teachers</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-purple-600">{{ $totalStudents }}</div>
                    <div class="text-gray-600">Students</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl font-semibold text-gray-900">
                        Welcome, Admin!
                    </div>
                    <div class="mt-6 text-gray-500">
                        Manage your school system from here.
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Teacher Management</h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.teachers.index') }}" class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                    View All Teachers
                                </a>
                                <a href="{{ route('admin.teachers.create') }}" class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded-lg hover:bg-green-700 transition">
                                    Add New Teacher
                                </a>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Student Management</h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.students.index') }}" class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                    View All Students
                                </a>
                                <a href="{{ route('admin.students.create') }}" class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded-lg hover:bg-green-700 transition">
                                    Add New Student
                                </a>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Time Table Management</h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.timetables.index') }}" class="block w-full bg-purple-600 text-white text-center py-2 px-4 rounded-lg hover:bg-purple-700 transition">
                                    Manage Time Tables
                                </a>
                                <a href="{{ route('admin.timetables.create') }}" class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded-lg hover:bg-green-700 transition">
                                    Add New Time Table Entry
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>