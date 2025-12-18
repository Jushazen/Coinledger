<x-dashboard>
    <div class="container mx-auto px-4 py-8 max-w-md">
        <div class="mb-6">
            <a href="{{ route('funds.show', $fund->fund_id) }}" class="text-blue-500 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Fund Details
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-2">Add Contribution</h1>
            <p class="text-gray-600 mb-6">Fund: <span class="font-semibold">{{ $fund->fund_name }}</span></p>

            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-2">Current Status:</p>
                <p class="font-medium">Your Contribution: ₱{{ number_format($fund->your_contribution, 2) }}</p>
                <p class="font-medium">Total Collected: ₱{{ number_format($fund->collected, 2) }}</p>
            </div>

            <form action="{{ route('funds.add-contribution', $fund->fund_id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 mb-2">Additional Contribution *</label>
                    <input type="number" id="amount" name="amount" step="0.01" min="0.01"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="flex space-x-2">
                    <button type="submit" class="flex-1 bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                        Add Contribution
                    </button>
                    <a href="{{ route('funds.show', $fund->fund_id) }}"
                        class="flex-1 bg-gray-300 text-gray-700 py-2 rounded text-center hover:bg-gray-400">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-dashboard>