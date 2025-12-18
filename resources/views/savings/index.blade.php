<x-dashboard>
    <x-submenu>
        <x-slot name="submenu1">
            My Savings
        </x-slot>
        <x-slot name="submenu2">
            New Savings
        </x-slot>
    </x-submenu>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <x-card-section>
        @foreach($savings as $saving)
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

        // Calculate progress based on target_amount
        $progress = $targetTotal > 0 ? ($saving->saved / $targetTotal * 100) : 0;
        @endphp

        <x-card recordType="saving" cardTitle="{{ $saving->saving_name }}" cardStatus="{{ $status }}"
            statusAttribute="{{ $statusAttr }}" label1="Saved" label2="Monthly Target" label3="Target Amount" label4="Target Date" value1="₱{{ number_format($saving->saved, 2) }}"
            value2="₱{{ number_format($saving->monthly, 2) }}" value3="₱{{ number_format($saving->target_amount, 2) }}" value4="{{ \Carbon\Carbon::parse($saving->target_date)->format('M. d, Y') }}"
            loanId="{{ $saving->saving_id }}" paymentLink="{{ route('savings.add-amount.form', $saving->saving_id) }}"
            detailsLink="{{ route('savings.show', $saving->saving_id) }}" />
        @endforeach
    </x-card-section>

    <x-create-section postRoute="savings.store" label1="Saving Goal Name" firstInput="saving_name" firstInputType="text"
        label2="Monthly Target Amount" secondInput="monthly" secondInputType="number" label3="Total Target Amount"
        thirdInput="target_amount" thirdInputType="number" label4="Target Date" fourthInput="target_date"
        fourthInputType="date" label5="Brief Description" fifthInput="short_description" fifthInputType="text"
        createButton="Create Saving Goal"></x-create-section>
</x-dashboard>