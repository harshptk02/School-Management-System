<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Fee Status
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('error'))
                    <div class="mb-4 text-red-600">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('admin.fees.update', $fee->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Student:</label>
                        <input type="text" value="{{ $fee->student->name }} ({{ $fee->student->studentProfile->student_id ?? 'N/A' }})" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Class:</label>
                        <input type="text" value="{{ $fee->student->studentProfile->class ?? 'N/A' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Month/Year:</label>
                        <input type="text" value="{{ $fee->month }} {{ $fee->year }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                        <input type="text" value="{{ number_format($fee->amount, 2) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Due Date:</label>
                        <input type="text" value="{{ $fee->due_date->format('Y-m-d') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Payment Status:</label>
                        <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="pending" @if($fee->status == 'pending') selected @endif>Pending</option>
                            <option value="paid" @if($fee->status == 'paid') selected @endif>Paid</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <a href="{{ route('admin.fees.show', $fee->student_id) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 