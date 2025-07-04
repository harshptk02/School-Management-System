<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Teacher') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block mb-2">Name</label>
                        <input type="text" name="name" value="{{ $teacher->name }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Email</label>
                        <input type="email" name="email" value="{{ $teacher->email }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Employee ID</label>
                        <input type="text" name="employee_id" value="{{ $teacher->teacherProfile->employee_id ?? '' }}" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Subject</label>
                        <input type="text" name="subject" value="{{ $teacher->teacherProfile->subject ?? '' }}" class="w-full border px-3 py-2 rounded">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Teacher</button>
                    <a href="{{ route('admin.teachers.index') }}" class="ml-2 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
