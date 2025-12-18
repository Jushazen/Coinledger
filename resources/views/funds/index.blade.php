<x-dashboard>
    <x-submenu>
        <x-slot name="submenu1">
            My Funds
        </x-slot>
        <x-slot name="submenu2">
            New Fund
        </x-slot>
    </x-submenu>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <x-card-section>
        @foreach($funds as $fund)
        <x-card recordType="fund" cardTitle="{{ $fund->fund_name }}" cardStatus="{{ $fund->status }}"
            statusAttribute="{{ $fund->status }}-status" label1="Your Contribution" label2="Contributed On"
            label3="Total Collected" label4="Your Share" value1="₱{{ number_format($fund->your_contribution, 2) }}"
            value2="{{ \Carbon\Carbon::parse($fund->contributed_on)->format('M. d, Y') }}"
            value3="₱{{ number_format($fund->collected, 2) }}"
            value4="{{ $fund->collected > 0 ? number_format(($fund->your_contribution / $fund->collected * 100), 1) : 0 }}%"
            loanId="{{ $fund->fund_id }}" paymentLink="{{ route('funds.add-contribution.form', $fund->fund_id) }}"
            detailsLink="{{ route('funds.show', $fund->fund_id) }}" />
        @endforeach
    </x-card-section>

    <x-create-section postRoute="funds.store" label1="Fund Name" firstInput="fund_name" firstInputType="text"
        label2="Your Contribution" secondInput="your_contribution" secondInputType="number" label3="Contribution Date"
        thirdInput="contributed_on" thirdInputType="date" label4="Brief Description" fourthInput="short_description"
        fourthInputType="text" createButton="Create Fund"></x-create-section>
</x-dashboard>