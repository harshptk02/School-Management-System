@props(['breadcrumbs' => []])

<nav aria-label="Breadcrumb" class=" p-3  mt-6">
    <ol class="flex flex-wrap items-center space-x-1 text-sm text-gray-500">
        <li>
            <a href="{{ route('dashboard') }}" class="flex items-center hover:text-blue-600">
                <i class='bx bx-home-alt mr-1'></i>
                Home
            </a>
        </li>

        @foreach($breadcrumbs as $breadcrumb)
            <li class="flex items-center">
                <i class='bx bx-chevron-right text-gray-400'></i>
                @if(isset($breadcrumb['url']))
                    <a href="{{ $breadcrumb['url'] }}" class="ml-1 hover:text-blue-600">{{ $breadcrumb['label'] }}</a>
                @else
                    <span class="ml-1 font-medium text-gray-900">{{ $breadcrumb['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>