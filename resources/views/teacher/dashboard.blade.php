<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl font-semibold text-gray-900">
                        Welcome, {{ auth()->user()->name }}!
                    </div>
                    <div class="mt-6 text-gray-500">
                        Manage your classes and students from here.
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-3xl font-bold text-blue-600">{{ $totalStudents }}</div>
                        <div class="text-gray-600">Total Students</div>
                    </div>
                    @if($teacherProfile)
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-lg font-semibold text-gray-900">Subject: {{ $teacherProfile->subject }}</div>
                        <div class="text-gray-600">Employee ID: {{ $teacherProfile->employee_id }}</div>
                        <div class="text-gray-600">Qualification: {{ $teacherProfile->qualification }}</div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Class Time Table Section -->
            <div class="bg-white p-6 rounded shadow-md mt-8">
                <h3 class="text-lg font-semibold mb-4">Class Time Table</h3>
                @if($classSections && $classSections->count())
                    <form method="GET" action="">
                        <div class="flex space-x-4 mb-4">
                            <div>
                                <label>Class</label>
                                <select name="class" class="border rounded px-2 py-1">
                                    @foreach($classSections as $cs)
                                        <option value="{{ $cs->class }}" @if($selectedClass == $cs->class) selected @endif>{{ $cs->class }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label>Section</label>
                                <select name="section" class="border rounded px-2 py-1">
                                    @foreach($classSections->where('class', $selectedClass) as $cs)
                                        <option value="{{ $cs->section }}" @if($selectedSection == $cs->section) selected @endif>{{ $cs->section }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View</button>
                            </div>
                        </div>
                    </form>
                    @if($timetables && $timetables->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th>Day</th>
                                        <th>Subject</th>
                                        <th>Teacher</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timetables as $timetable)
                                        <tr>
                                            <td>{{ $timetable->day }}</td>
                                            <td>{{ $timetable->subject }}</td>
                                            <td>{{ $timetable->teacher->name ?? '' }}</td>
                                            <td>{{ $timetable->start_time }}</td>
                                            <td>{{ $timetable->end_time }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No time table found for this class and section.</p>
                    @endif
                @else
                    <p class="text-gray-500">No classes assigned.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>