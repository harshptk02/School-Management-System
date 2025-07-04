<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('admin.students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block mb-2">Name</label>
                        <input type="text" name="name" value="{{ $student->name }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Email</label>
                        <input type="email" name="email" value="{{ $student->email }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Student ID</label>
                        <input type="text" name="student_id" value="{{ $student->studentProfile->student_id ?? '' }}" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Class</label>
                        <input type="text" name="class" value="{{ $student->studentProfile->class ?? '' }}" class="w-full border px-3 py-2 rounded">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Student</button>
                    <a href="{{ route('admin.students.index') }}" class="ml-2 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
