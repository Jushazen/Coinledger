<x-dashboard>
    <x-submenu>
        <x-slot name="submenu1">
            Active Loans
        </x-slot>
        <x-slot name="submenu2">
            New Loan
        </x-slot>
    </x-submenu>

    @if(session('success')) 
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <x-card-section>
        @foreach($loans as $loan)
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

        <x-card cardTitle="{{ $loan->loan_name }}" cardStatus="{{ $status }}" statusAttribute="{{ $statusAttr }}"
            label1="Person" label2="Amount" label3="Due Date" label4="Paid"
            value1="{{ $loan->person_name }} ({{ ucfirst($loan->role) }})"
            value2="₱{{ number_format($loan->amount, 2) }}"
            value3="{{ \Carbon\Carbon::parse($loan->due_date)->format('M. d, Y') }}"
            value4="₱{{ number_format($loan->paid, 2) }} of ₱{{ number_format($loan->amount, 2) }}"
            paymentType="loan-payment" loanId="{{ $loan->loan_id }}"
            paymentLink="{{ route('loans.payment.form', $loan->loan_id) }}"
            detailsLink="{{ route('loans.show', $loan->loan_id) }}" recordType="loan" />
        @endforeach
    </x-card-section>

    <x-create-section postRoute="loans.store" label1="Loan Title" firstInput="loan_name" firstInputType="text"
        label2="Loan Role (borrower/lender)" secondInput="role" secondInputType="text" label3="Borrower/Lender's Name"
        thirdInput="person_name" thirdInputType="text" label4="Amount" fourthInput="amount" fourthInputType="number"
        label5="Due Date" fifthInput="due_date" fifthInputType="date" label6="Brief Description"
        sixthInput="short_description" sixthInputType="text" createButton="Create Loan"></x-create-section>
</x-dashboard>