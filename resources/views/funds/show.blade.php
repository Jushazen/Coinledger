<x-dashboard>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('funds.index') }}" class="text-blue-500 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to All Funds
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold">{{ $fund->fund_name }}</h1>
                        <span class="px-3 py-1 rounded-full text-sm {{ $fund->status }}-status">
                            {{ ucfirst($fund->status) }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('funds.add-contribution.form', $fund->fund_id) }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Add Contribution
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Fund Information</h3>

                        <div>
                            <p class="text-gray-500">Fund Name</p>
                            <p class="font-medium">{{ $fund->fund_name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Your Contribution</p>
                            <p class="font-medium text-xl">₱{{ number_format($fund->your_contribution, 2) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Contribution Date</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($fund->contributed_on)->format('F d, Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Collection Details</h3>

                        <div>
                            <p class="text-gray-500">Total Collected</p>
                            <p class="font-medium text-xl text-green-600">₱{{ number_format($fund->collected, 2) }}</p>
                        </div>

                        @php
                        $remaining = max(0, $fund->collected - $fund->your_contribution);
                        $percentage = $fund->collected > 0 ? ($fund->your_contribution / $fund->collected * 100) : 0;
                        @endphp

                        <div>
                            <p class="text-gray-500">Others' Contribution</p>
                            <p class="font-medium">₱{{ number_format($remaining, 2) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Your Share</p>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ min(100, $percentage) }}%">
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">{{ number_format($percentage, 1) }}% of Total</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <p class="text-gray-500">Description</p>
                    <p class="font-medium">{{ $fund->short_description }}</p>
                </div>

                <div class="mt-8 pt-6 border-t">
                    <form action="{{ route('funds.destroy', $fund->fund_id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this fund?');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                            Delete Fund
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>