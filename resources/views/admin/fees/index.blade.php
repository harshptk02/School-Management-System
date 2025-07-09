<x-app-layout>
    <x-slot name="header">
      
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Student Fee Status ({{ $currentMonth }} {{ $currentYear }})</h3>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.fees.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Individual Fee
                        </a>
                        <button type="button" onclick="document.getElementById('generateFeesModal').classList.remove('hidden')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Generate Monthly Fees
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <form method="GET" action="{{ route('admin.fees.index') }}" class="mb-4 flex flex-wrap gap-4 items-center">
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700">Class:</label>
                        <select name="class" id="class" onchange="this.form.submit()" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Classes</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" @if($selectedClass == $class) selected @endif>{{ $class }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                        <select name="status" id="status" onchange="this.form.submit()" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Statuses</option>
                            <option value="paid" @if($selectedStatus == 'paid') selected @endif>Paid</option>
                            <option value="pending" @if($selectedStatus == 'pending') selected @endif>Pending</option>
                            <option value="not_generated" @if($selectedStatus == 'not_generated') selected @endif>Not Generated</option>
                        </select>
                    </div>
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700">Month:</label>
                        <select name="month" id="month" onchange="this.form.submit()" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Current Month</option>
                            @foreach($months as $month)
                                <option value="{{ $month }}" @if($selectedMonth == $month) selected @endif>{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Student ID
                                </th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Class
                                </th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Current Month Status
                                </th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $student->studentProfile->student_id ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $student->name }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $student->studentProfile->class ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if($student->currentFeeStatus == 'paid')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Paid
                                            </span>
                                        @elseif($student->currentFeeStatus == 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Not Generated
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <a href="{{ route('admin.fees.show', $student->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">View History</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Generate Fees Modal -->
    <div id="generateFeesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Generate Monthly Fees</h3>
                <div class="mt-2 px-7 py-3">
                    <form action="{{ route('admin.fees.generate') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="class" class="block text-gray-700 text-sm font-bold mb-2">Class:</label>
                            <select name="class" id="class" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">All Classes</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class }}">{{ $class }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="month" class="block text-gray-700 text-sm font-bold mb-2">Month:</label>
                            <select name="month" id="month" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
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
                            <button type="button" onclick="document.getElementById('generateFeesModal').classList.add('hidden')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Generate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>