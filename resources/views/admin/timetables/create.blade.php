<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Time Table Entry') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('admin.timetables.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2">Class</label>
                        <input type="text" name="class" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Section</label>
                        <input type="text" name="section" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Subject</label>
                        <input type="text" name="subject" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Teacher</label>
                        <select name="teacher_id" class="w-full border px-3 py-2 rounded" required>
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Day</label>
                        <input type="text" name="day" class="w-full border px-3 py-2 rounded" required placeholder="e.g. Monday">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Start Time</label>
                        <input type="time" name="start_time" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">End Time</label>
                        <input type="time" name="end_time" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Create Entry</button>
                    <a href="{{ route('admin.timetables.index') }}" class="ml-2 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
