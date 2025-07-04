<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md mb-8">
                <p><strong>ID:</strong> {{ $student->id }}</p>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Student ID:</strong> {{ $student->studentProfile->student_id ?? 'N/A' }}</p>
                <p><strong>Class:</strong> {{ $student->studentProfile->class ?? 'N/A' }}</p>
                <p><strong>Section:</strong> {{ $student->studentProfile->section ?? 'N/A' }}</p>
                <p><strong>Admission Date:</strong> {{ $student->studentProfile->admission_date ?? 'N/A' }}</p>
                <a href="{{ route('admin.students.edit', $student) }}" class="inline-block mt-4 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Edit</a>
                <a href="{{ route('admin.students.index') }}" class="inline-block mt-4 ml-2 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to List</a>
            </div>
            <div class="bg-white p-6 rounded shadow-md">
                <h3 class="text-lg font-semibold mb-4">Class Time Table</h3>
                @php
                    $class = $student->studentProfile->class ?? null;
                    $section = $student->studentProfile->section ?? null;
                    $timetables = \App\Models\TimeTable::where('class', $class)->where('section', $section)->orderBy('day')->orderBy('start_time')->get();
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
                    <p class="text-gray-500">No time table found for this class and section.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
