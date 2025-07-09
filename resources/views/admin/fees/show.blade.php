<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
            <a href="{{ route('admin.fees.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Student Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Student ID</p>
                            <p>{{ $student->studentProfile->student_id ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Class</p>
                            <p>{{ $student->studentProfile->class ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p>{{ $student->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Fee Records</h3>
                        <a href="{{ route('admin.fees.create', ['student_id' => $student->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Fee
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Month/Year
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Due Date
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Payment Date
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $fee)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $fee->month }} {{ $fee->year }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ number_format($fee->amount, 2) }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            @if($fee->status == 'paid')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Paid
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $fee->due_date->format('M d, Y') }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $fee->payment_date ? $fee->payment_date->format('M d, Y') : 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.fees.edit', $fee->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                @if($fee->status == 'pending')
                                                    <form action="{{ route('admin.fees.mark-paid', $fee->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-green-600 hover:text-green-900 ml-2">Mark as Paid</button>
                                                    </form>
                                                @endif
                                                @if($fee->status == 'paid')
                                                    <a href="{{ route('admin.fees.receipt', $fee->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2" target="_blank">Download Receipt</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if(count($fees) == 0)
                                    <tr>
                                        <td colspan="6" class="py-4 px-4 border-b border-gray-200 text-center text-gray-500">
                                            No fee records found for this student.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>