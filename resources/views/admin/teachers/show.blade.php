<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teacher Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <p><strong>ID:</strong> {{ $teacher->id }}</p>
                <p><strong>Name:</strong> {{ $teacher->name }}</p>
                <p><strong>Email:</strong> {{ $teacher->email }}</p>
                <p><strong>Employee ID:</strong> {{ $teacher->teacherProfile->employee_id ?? 'N/A' }}</p>
                <p><strong>Subject:</strong> {{ $teacher->teacherProfile->subject ?? 'N/A' }}</p>
                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="inline-block mt-4 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Edit</a>
                <a href="{{ route('admin.teachers.index') }}" class="inline-block mt-4 ml-2 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to List</a>
            </div>
        </div>
    </div>
</x-app-layout>
