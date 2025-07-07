



<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            <!-- Table Container -->
            <div class="flex justify-end">
                <a href="{{ route('admin.timetables.create') }}" class="w-fit block justify-end mb-4  bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Add New Time Table</span>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-white">Time Tables List</h3>
                        <div class="flex items-center space-x-4">
                            
                            <div class="relative">
                                <input type="text" id="searchInput" placeholder="Search time tables..."
                                    class="bg-white/20 backdrop-blur-sm text-white placeholder-white/70 px-4 py-2 rounded-lg border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent">
                                <svg class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Time</th>
                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                           

                            <tbody class="bg-white divide-y divide-gray-200">
    @forelse($timeTables as $timetable)
    <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300">
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ $timetable->class }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $timetable->section }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ $timetable->subject }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                @if($timetable->teacher)
                    @if($timetable->teacher->teacherProfile && $timetable->teacher->teacherProfile->profile_image)
                        <img src="{{ asset('storage/' . $timetable->teacher->teacherProfile->profile_image) }}" 
                             class="h-8 w-8 rounded-full object-cover" 
                             alt="{{ $timetable->teacher->name }}">
                    @else
                        <div class="h-8 w-8 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                            {{ strtoupper(substr($timetable->teacher->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $timetable->teacher->name)[1] ?? '', 0, 1)) }}
                        </div>
                    @endif
                    <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900">{{ $timetable->teacher->name }}</div>
                    </div>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        N/A
                    </span>
                @endif
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                {{ $timetable->day }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-mono text-gray-900">{{ $timetable->start_time }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-mono text-gray-900">{{ $timetable->end_time }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-center">
            <div class="flex items-center justify-center space-x-2">
                
                <a href="{{ route('admin.timetables.edit', $timetable) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-all duration-300 hover:transform hover:-translate-y-1 hover:shadow-lg" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </a>
                <form action="{{ route('admin.timetables.destroy', $timetable) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-all duration-300 hover:transform hover:-translate-y-1 hover:shadow-lg" title="Delete" onclick="return confirm('Are you sure you want to delete this timetable entry?')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="px-6 py-12 text-center">
            <div class="text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-lg font-medium">No timetable entries found</p>
                <p class="text-sm">Get started by adding a new timetable entry.</p>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>
                        </table>
                    </div>

                    

                    <!-- Pagination -->
                    <div class="mt-6 bg-gray-50 px-6 py-4 rounded-lg">
                        {{ $timeTables->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr, .md\\:hidden > div > div');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Add smooth animations to action buttons
        document.querySelectorAll('[title]').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .table-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .row-hover:hover {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        }
    </style>
</x-app-layout>