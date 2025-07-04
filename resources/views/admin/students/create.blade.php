<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('admin.students.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2">Name</label>
                        <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Email</label>
                        <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Password</label>
                        <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Student ID</label>
                        <input type="text" name="student_id" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Class</label>
                        <input type="text" name="class" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Section</label>
                        <input type="text" name="section" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Admission Date</label>
                        <input type="date" name="admission_date" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Create
                        Student</button>
                    <a href="{{ route('admin.students.index') }}"
                        class="ml-2 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
