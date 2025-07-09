<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Individual Fee
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('error'))
                    <div class="mb-4 text-red-600">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('admin.fees.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="class" class="block text-gray-700 text-sm font-bold mb-2">Class:</label>
                        <select name="class" id="class" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="">Select Class</option>
                            @foreach($students->pluck('studentProfile.class')->unique()->filter() as $class)
                                <option value="{{ $class }}">{{ $class }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="student_id" class="block text-gray-700 text-sm font-bold mb-2">Student:</label>
                        <select name="student_id" id="student_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="">Select Student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" data-class="{{ $student->studentProfile->class }}">
                                    {{ $student->name }} ({{ $student->studentProfile->student_id ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="month" class="block text-gray-700 text-sm font-bold mb-2">Month:</label>
                        <select name="month" id="month" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @foreach($months as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="year" class="block text-gray-700 text-sm font-bold mb-2">Year:</label>
                        <input type="number" name="year" id="year" value="{{ date('Y') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                        <input type="number" step="0.01" name="amount" id="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="due_date" class="block text-gray-700 text-sm font-bold mb-2">Due Date:</label>
                        <input type="date" name="due_date" id="due_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <a href="{{ route('admin.fees.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Fee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Filter students by class selection
        document.getElementById('class').addEventListener('change', function() {
            var selectedClass = this.value;
            var studentOptions = document.getElementById('student_id').options;
            for (var i = 0; i < studentOptions.length; i++) {
                var option = studentOptions[i];
                if (!option.value) continue;
                option.style.display = (selectedClass === '' || option.getAttribute('data-class') === selectedClass) ? '' : 'none';
            }
            document.getElementById('student_id').value = '';
        });
    </script>
</x-app-layout> 