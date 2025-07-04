<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Time Table Entry') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('admin.timetables.update', $timetable) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block mb-2">Class</label>
                        <input type="text" name="class" value="{{ $timetable->class }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Section</label>
                        <input type="text" name="section" value="{{ $timetable->section }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Subject</label>
                        <input type="text" name="subject" value="{{ $timetable->subject }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Teacher</label>
                        <select name="teacher_id" class="w-full border px-3 py-2 rounded" required>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @if($timetable->teacher_id == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Day</label>
                        <input type="text" name="day" value="{{ $timetable->day }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Start Time</label>
                        <input type="time" name="start_time" value="{{ $timetable->start_time }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">End Time</label>
                        <input type="time" name="end_time" value="{{ $timetable->end_time }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Entry</button>
                    <a href="{{ route('admin.timetables.index') }}" class="ml-2 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
