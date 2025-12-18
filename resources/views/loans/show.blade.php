<x-dashboard>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('loans.index') }}" class="text-blue-500 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to All Loans
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Loan Details Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold">{{ $loan->loan_name }}</h1>
                        @php
                        if ($loan->paid >= $loan->amount) {
                        $statusLabel = 'Paid';
                        $statusClass = 'complete-status';
                        } else {
                        $due = \Carbon\Carbon::parse($loan->due_date);
                        if ($due->isPast()) {
                        $statusLabel = 'Overdue';
                        $statusClass = 'overdue-status';
                        } else {
                        $statusLabel = 'Active';
                        $statusClass = 'active-status';
                        }
                        }
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <!-- Record Payment Button -->
                        <a href="{{ route('loans.payment.form', $loan->loan_id) }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Record Payment
                        </a>
                    </div>
                </div>
            </div>

            <!-- Loan Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column: Basic Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Loan Information</h3>

                        <div>
                            <p class="text-gray-500">Loan Name</p>
                            <p class="font-medium">{{ $loan->loan_name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Role</p>
                            <p class="font-medium">{{ ucfirst($loan->role) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Person</p>
                            <p class="font-medium">{{ $loan->person_name }}</p>
                        </div>
                    </div>

                    <!-- Right Column: Financial Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Financial Details</h3>

                        <div>
                            <p class="text-gray-500">Total Amount</p>
                            <p class="font-medium text-xl">₱{{ number_format($loan->amount, 2) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Amount Paid</p>
                            <p class="font-medium text-xl text-green-600">₱{{ number_format($loan->paid, 2) }}</p>
                        </div>

                        @php
                        $remaining = $loan->amount - $loan->paid;
                        @endphp
                        <div>
                            <p class="text-gray-500">Remaining Balance</p>
                            <p class="font-medium text-xl {{ $remaining > 0 ? 'text-red-600' : 'text-green-600' }}">
                                ₱{{ number_format($remaining, 2) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Due Date</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($loan->due_date)->format('F d, Y') }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Progress</p>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                <div class="bg-blue-600 h-2.5 rounded-full"
                                    style="width: {{ $loan->amount > 0 ? ($loan->paid / $loan->amount * 100) : 0 }}%">
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ number_format($loan->paid / $loan->amount * 100, 1) }}% Paid
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Short Description -->
                <div class="mt-6 pt-6 border-t">
                    <p class="text-gray-500">Short Description</p>
                    <p class="font-medium">{{ $loan->short_description }}</p>
                </div>

                <!-- Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 pt-6 border-t">
                    <div>
                        <p class="text-gray-500">Created</p>
                        <p class="font-medium">{{ $loan->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Last Updated</p>
                        <p class="font-medium">{{ $loan->updated_at->format('F d, Y') }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t">
                    <!-- Delete Button with Confirmation -->
                    <form action="{{ route('loans.destroy', $loan->loan_id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this loan? This action cannot be undone.');"
                        class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Loan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>