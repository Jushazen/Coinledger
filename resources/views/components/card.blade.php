@props([
'cardTitle',
'cardStatus',
'statusAttribute',
'label1',
'label2',
'label3',
'label4' => null,
'value1',
'value2',
'value3',
'value4' => null,
'paymentType',
'loanId' => 1,
'paymentLink' => '#',
'detailsLink' => '#',
'recordType'
])

<div
    class="bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] rounded-xl text-sm p-4 flex flex-col gap-3 [&>div]:flex [&>div]:justify-between [&>div]:items-center">

    <div class="border-b border-gray-300 text-lg">
        {{ $cardTitle }}
        <span class="text-sm px-2 {{ $statusAttribute }} rounded-full">{{ $cardStatus }}</span>
    </div>

    <div>
        <span class="text-gray-400">{{ $label1 }}:</span>
        <span>{{ $value1 }}</span>
    </div>

    <div>
        <span class="text-gray-400">{{ $label2 }}:</span>
        <span>{{ $value2 }}</span>
    </div>

    <div>
        <span class="text-gray-400">{{ $label3 }}:</span>
        <span>{{ $value3 }}</span>
    </div>

    @if($label4)
    <div>
        <span class="text-gray-400">{{ $label4 }}:</span>
        <span>{{ $value4 }}</span>
    </div>
    @endif

    <div class="flex flex-col gap-2">
        <!-- Dynamic button label based on type -->
        <a href="{{ $paymentLink }}"
            class="w-full bg-blue-400 text-white py-1 rounded-sm cursor-pointer hover:bg-blue-700 transition-[all_0.5s_linear] text-center">
            {{ $recordType === 'loan' ? 'Record Payment' : ($recordType === 'saving' ? 'Add Amount' : 'Add Contribution') }}
        </a>
    
        <a href="{{ $detailsLink }}"
            class="w-full border-2 border-gray-400 text-gray-600 py-1 rounded-sm cursor-pointer hover:bg-gray-400 hover:text-white transition-[all_0.5s_linear] text-center">
            View Details
        </a>
    </div>
</div>