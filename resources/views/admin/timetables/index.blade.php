<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Time Tables Management') }}
        </h2>
        <a href="{{ route('admin.timetables.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition float-right">Add New Entry</a>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timeTables as $timetable)
                                    <tr>
                                        <td>{{ $timetable->class }}</td>
                                        <td>{{ $timetable->section }}</td>
                                        <td>{{ $timetable->subject }}</td>
                                        <td>{{ $timetable->teacher->name ?? '' }}</td>
                                        <td>{{ $timetable->day }}</td>
                                        <td>{{ $timetable->start_time }}</td>
                                        <td>{{ $timetable->end_time }}</td>
                                        <td>
                                            <a href="{{ route('admin.timetables.edit', $timetable) }}" class="text-green-600 hover:text-green-900">Edit</a>
                                            <form action="{{ route('admin.timetables.destroy', $timetable) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $timeTables->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
