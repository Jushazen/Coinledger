<x-dashboard>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('savings.index') }}" class="text-blue-500 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to All Savings
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
                        <h1 class="text-2xl font-bold">{{ $saving->saving_name }}</h1>
                        @php
                        // Use target_amount instead of calculated monthly * 12
                        if ($saving->saved >= $saving->target_amount) {
                        $statusLabel = 'Complete';
                        $statusClass = 'complete-status';
                        } else {
                        $target = \Carbon\Carbon::parse($saving->target_date);
                        if ($target->isPast()) {
                        $statusLabel = 'Overdue';
                        $statusClass = 'overdue-status';
                        } else {
                        $statusLabel = ucfirst($saving->status);
                        $statusClass = $saving->status . '-status';
                        }
                        }
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('savings.add-amount.form', $saving->saving_id) }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Add Amount
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Saving Information</h3>

                        <div>
                            <p class="text-gray-500">Goal Name</p>
                            <p class="font-medium">{{ $saving->saving_name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Monthly Target</p>
                            <p class="font-medium">₱{{ number_format($saving->monthly, 2) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Target Amount</p>
                            <p class="font-medium">₱{{ number_format($saving->target_amount, 2) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Target Date</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($saving->target_date)->format('F d, Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Progress Details</h3>

                        <div>
                            <p class="text-gray-500">Total Saved</p>
                            <p class="font-medium text-xl text-green-600">₱{{ number_format($saving->saved, 2) }}</p>
                        </div>

                        @php
                        $targetTotal = $saving->target_amount;
                        $remaining = max(0, $targetTotal - $saving->saved);
                        $progress = $targetTotal > 0 ? ($saving->saved / $targetTotal * 100) : 0;
                        @endphp

                        <div>
                            <p class="text-gray-500">Target Total</p>
                            <p class="font-medium">₱{{ number_format($targetTotal, 2) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Remaining</p>
                            <p class="font-medium {{ $remaining > 0 ? 'text-red-600' : 'text-green-600' }}">
                                ₱{{ number_format($remaining, 2) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Progress</p>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ min(100, $progress) }}%">
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">{{ number_format($progress, 1) }}% Complete</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <p class="text-gray-500">Description</p>
                    <p class="font-medium">{{ $saving->short_description }}</p>
                </div>

                <div class="mt-8 pt-6 border-t">
                    <form action="{{ route('savings.destroy', $saving->saving_id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this saving goal?');"
                        class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                            Delete Saving Goal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>