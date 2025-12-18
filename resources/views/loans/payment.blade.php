<x-dashboard>
    <div class="container mx-auto px-4 py-8 max-w-md">
        <div class="mb-6">
            <a href="{{ route('loans.show', $loan->loan_id) }}" class="text-blue-500 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Loan Details
            </a>
        </div>
    
        @if(session('success')) 
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-2">Record Payment</h1>
            <p class="text-gray-600 mb-6">Loan: <span class="font-semibold">{{ $loan->loan_name }}</span></p>

            <!-- Loan Summary -->
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-2">Loan Summary:</p>
                <p class="font-medium">Total Amount: ₱{{ number_format($loan->amount, 2) }}</p>
                <p class="font-medium">Paid So Far: ₱{{ number_format($loan->paid, 2) }}</p>
                <p class="font-medium {{ $remaining > 0 ? 'text-red-600' : 'text-green-600' }}">
                    Remaining Balance: ₱{{ number_format($remaining, 2) }}
                </p>
            </div>

            <!-- Payment Form -->
            <form action="{{ route('loans.payment.record', $loan->loan_id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 mb-2">Payment Amount *</label>
                    <input type="number" id="amount" name="amount" step="0.01" min="0.01" max="{{ $remaining }}"
                        class="w-full border rounded px-3 py-2 @error('amount') border-red-500 @enderror" required>
                    @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">
                        Maximum: ₱{{ number_format($remaining, 2) }}
                    </p>
                </div>

                <div class="flex space-x-2">
                    <button type="submit" class="flex-1 bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                        Record Payment
                    </button>
                    <a href="{{ route('loans.show', $loan->loan_id) }}"
                        class="flex-1 bg-gray-300 text-gray-700 py-2 rounded text-center hover:bg-gray-400">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-dashboard>