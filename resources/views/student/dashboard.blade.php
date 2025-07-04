<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
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
                        Access your student portal from here.
                    </div>
                </div>

                @if($studentProfile)
                <div class="bg-gray-200 bg-opacity-25 p-6">
                    <div class="bg-white p-6 rounded-lg shadow mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Student Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="font-medium text-gray-700">Student ID:</span>
                                <span class="text-gray-900">{{ $studentProfile->student_id }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Class:</span>
                                <span class="text-gray-900">{{ $studentProfile->class }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Section:</span>
                                <span class="text-gray-900">{{ $studentProfile->section }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Admission Date:</span>
                                <span class="text-gray-900">{{ $studentProfile->admission_date->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Class Time Table Section -->
                    <div class="bg-white p-6 rounded shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Class Time Table</h3>
                        @php
                            $timetables = \App\Models\TimeTable::where('class', $studentProfile->class)
                                ->where('section', $studentProfile->section)
                                ->orderBy('day')
                                ->orderBy('start_time')
                                ->get();
                        @endphp
                        @if($timetables->count())
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
                            <p class="text-gray-500">No time table found for your class and section.</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>