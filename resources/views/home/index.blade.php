<x-dashboard>
    <section class="p-4 content-item active min-h-[calc(100vh-64px-24px)] flex flex-col" id="content1">

        <!-- Summary Section -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-[0_0_10px_rgba(0,0,0,0.1)] p-6">
                <h2 class="text-2xl font-bold mb-6">Financial Overview</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Loans Summary -->
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-blue-700">Loans</h3>
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 
                                    2-1.343 2-3 2m0-8c1.11 0 
                                    2.08.402 2.599 1M12 8V7m0 
                                    1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 
                                    12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        @php
                        $totalLoans = $loans->count();
                        $activeLoans = $loans->where('paid', '<', \DB::raw('amount'))->count();
                            $overdueLoans = $loans->filter(function($loan) {
                            return $loan->paid < $loan->amount && \Carbon\Carbon::parse($loan->due_date)->isPast();
                                })->count();
                                $totalLoanAmount = $loans->sum('amount');
                                $totalPaid = $loans->sum('paid');
                                $loanBalance = $totalLoanAmount - $totalPaid;
                                @endphp
                                <p class="text-2xl font-bold text-gray-800 mb-2">₱{{ number_format($loanBalance, 2) }}
                                </p>
                                <p class="text-sm text-gray-600">Balance Remaining</p>
                                <div class="mt-3 space-y-1">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Active Loans:</span>
                                        <span class="font-medium">{{ $activeLoans }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Overdue:</span>
                                        <span class="font-medium text-red-600">{{ $overdueLoans }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Total:</span>
                                        <span class="font-medium">{{ $totalLoans }}</span>
                                    </div>
                                </div>
                    </div>

                    <!-- Savings Summary -->
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-green-700">Savings</h3>
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        @php
                        $totalSavings = $savings->count();
                        $totalSaved = $savings->sum('saved');
                        $totalTarget = $savings->sum('target_amount');
                        $savingsProgress = $totalTarget > 0 ? ($totalSaved / $totalTarget * 100) : 0;
                        $activeSavings = $savings->where('saved', '<', \DB::raw('target_amount'))->count();
                            $completedSavings = $savings->where('saved', '>=', \DB::raw('target_amount'))->count();
                            @endphp
                            <p class="text-2xl font-bold text-gray-800 mb-2">₱{{ number_format($totalSaved, 2) }}</p>
                            <p class="text-sm text-gray-600">Total Saved</p>
                            <div class="mt-3 space-y-1">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Progress:</span>
                                    <span class="font-medium">{{ number_format($savingsProgress, 1) }}%</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Active Goals:</span>
                                    <span class="font-medium">{{ $activeSavings }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Completed:</span>
                                    <span class="font-medium">{{ $completedSavings }}</span>
                                </div>
                            </div>
                    </div>

                    <!-- Funds Summary -->
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-purple-700">Funds</h3>
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 
                                    2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 
                                    11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        @php
                        $totalFunds = $funds->count();
                        $totalFundAmount = $funds->sum('amount');
                        $activeFunds = $funds->where('status', 'active')->count();
                        $inactiveFunds = $funds->where('status', 'inactive')->count();
                        @endphp
                        <p class="text-2xl font-bold text-gray-800 mb-2">₱{{ number_format($totalFundAmount, 2) }}</p>
                        <p class="text-sm text-gray-600">Total Funds</p>
                        <div class="mt-3 space-y-1">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Active Funds:</span>
                                <span class="font-medium">{{ $activeFunds }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Inactive:</span>
                                <span class="font-medium">{{ $inactiveFunds }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total:</span>
                                <span class="font-medium">{{ $totalFunds }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Items Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Loans -->
            <div class="bg-white rounded-xl shadow-[0_0_10px_rgba(0,0,0,0.1)] p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Recent Loans</h3>
                    <a href="{{ route('loans.index') }}"
                        class="text-blue-500 hover:underline text-sm flex items-center">
                        View All
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                @if($recentLoans->count() > 0)
                @foreach($recentLoans as $loan)
                @php
                if ($loan->paid >= $loan->amount) {
                $status = 'complete';
                $statusAttr = 'complete-status';
                } else {
                $due = \Carbon\Carbon::parse($loan->due_date);
                if ($due->isPast()) {
                $status = 'overdue';
                $statusAttr = 'overdue-status';
                } else {
                $status = 'active';
                $statusAttr = 'active-status';
                }
                }
                @endphp
                <x-card cardTitle="{{ $loan->loan_name }}" cardStatus="{{ $status }}"
                    statusAttribute="{{ $statusAttr }}" label1="Person" label2="Amount" label3="Due Date" label4="Paid"
                    value1="{{ $loan->person_name }} ({{ ucfirst($loan->role) }})"
                    value2="₱{{ number_format($loan->amount, 2) }}"
                    value3="{{ \Carbon\Carbon::parse($loan->due_date)->format('M. d, Y') }}"
                    value4="₱{{ number_format($loan->paid, 2) }} of ₱{{ number_format($loan->amount, 2) }}"
                    paymentType="loan-payment" loanId="{{ $loan->loan_id }}"
                    paymentLink="{{ route('loans.payment.form', $loan->loan_id) }}"
                    detailsLink="{{ route('loans.show', $loan->loan_id) }}" recordType="loan" class="mb-3" />
                @endforeach
                @else
                <div class="text-center py-8 text-gray-500">
                    <p>No loans yet</p>
                    <a href="{{ route('loans.index') }}" class="text-blue-500 hover:underline mt-2 inline-block">
                        Create your first loan
                    </a>
                </div>
                @endif
            </div>

            <!-- Recent Savings -->
            <div class="bg-white rounded-xl shadow-[0_0_10px_rgba(0,0,0,0.1)] p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Recent Savings</h3>
                    <a href="{{ route('savings.index') }}"
                        class="text-blue-500 hover:underline text-sm flex items-center">
                        View All
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                @if($recentSavings->count() > 0)
                @foreach($recentSavings as $saving)
                @php
                $targetTotal = $saving->target_amount;
                if ($saving->saved >= $targetTotal) {
                $status = 'complete';
                $statusAttr = 'complete-status';
                } else {
                $target = \Carbon\Carbon::parse($saving->target_date);
                if ($target->isPast()) {
                $status = 'overdue';
                $statusAttr = 'overdue-status';
                } else {
                $status = $saving->status ?? 'active';
                $statusAttr = ($status === 'active') ? 'active-status' : $status . '-status';
                }
                }
                @endphp
                <x-card recordType="saving" cardTitle="{{ $saving->saving_name }}" cardStatus="{{ $status }}"
                    statusAttribute="{{ $statusAttr }}" label1="Saved" label2="Monthly Target" label3="Target Amount"
                    label4="Target Date" value1="₱{{ number_format($saving->saved, 2) }}"
                    value2="₱{{ number_format($saving->monthly, 2) }}"
                    value3="₱{{ number_format($saving->target_amount, 2) }}"
                    value4="{{ \Carbon\Carbon::parse($saving->target_date)->format('M. d, Y') }}"
                    loanId="{{ $saving->saving_id }}"
                    paymentLink="{{ route('savings.add-amount.form', $saving->saving_id) }}"
                    detailsLink="{{ route('savings.show', $saving->saving_id) }}" class="mb-3" />
                @endforeach
                @else
                <div class="text-center py-8 text-gray-500">
                    <p>No savings goals yet</p>
                    <a href="{{ route('savings.index') }}" class="text-blue-500 hover:underline mt-2 inline-block">
                        Create your first savings goal
                    </a>
                </div>
                @endif
            </div>

            <!-- Recent Funds -->
            <div class="bg-white rounded-xl shadow-[0_0_10px_rgba(0,0,0,0.1)] p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Recent Funds</h3>
                    <a href="{{ route('funds.index') }}"
                        class="text-blue-500 hover:underline text-sm flex items-center">
                        View All
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                @if($recentFunds->count() > 0)
                @foreach($recentFunds as $fund)
                @php
                $status = $fund->status ?? 'active';
                $statusAttr = $status . '-status';
                @endphp
                <x-card recordType="fund" cardTitle="{{ $fund->fund_name }}" cardStatus="{{ $status }}"
                    statusAttribute="{{ $statusAttr }}" label1="Amount" label2="Type" label3="Status"
                    label4="Last Updated" value1="₱{{ number_format($fund->amount, 2) }}"
                    value2="{{ ucfirst($fund->type ?? 'General') }}" value3="{{ ucfirst($status) }}"
                    value4="{{ $fund->updated_at->format('M. d, Y') }}" loanId="{{ $fund->fund_id ?? $fund->id }}"
                    detailsLink="{{ route('funds.show', $fund->fund_id ?? $fund->id) }}" class="mb-3" />
                @endforeach
                @else
                <div class="text-center py-8 text-gray-500">
                    <p>No funds yet</p>
                    <a href="{{ route('funds.index') }}" class="text-blue-500 hover:underline mt-2 inline-block">
                        Create your first fund
                    </a>
                </div>
                @endif
            </div>
        </div>

    </section>
    <section class="content-item outline-1 min-h-[calc(100vh-64px-24px)] mt-16" id="content2">Content 2</section>
</x-dashboard>