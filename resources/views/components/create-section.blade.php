<section
    class="content-item relative h-[calc(100vh-100px)] overflow-y-auto  py-4 min-h-[calc(100vh-64px-64px)] justify-center"
    id="content2">
    <div class=" h-min w-[700px] p-5 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] rounded-lg">
        <form action="{{ route($postRoute) }}" method="POST" class="flex flex-col gap-3 [&>label]:text-lg [&>input]:outline-2 [&>input]:outline-gray-300 [&>input]:rounded-sm [&>input]:px-3 [&>input]:py-1 [&>input]:focus:outline-black">
            @csrf
            <label for="{{ $firstInput }}">{{ $label1 }}:</label>
            <input type="{{ $firstInputType }}" name="{{ $firstInput }}">
            <label for="{{ $secondInput }}">{{ $label2 }}:</label>
            <input type="{{ $secondInputType }}" name="{{ $secondInput }}">
            <label for="{{ $thirdInput }}">{{ $label3 }}:</label>
            <input type="{{ $thirdInputType }}" name="{{ $thirdInput }}">
            <label for="{{ $fourthInput }}">{{ $label4 }}:</label>
            <input type="{{ $fourthInputType }}" name="{{ $fourthInput }}">

            @if (isset($label5))
            <label for="{{ $fifthInput }}">{{ $label5 }}:</label>
            <input type="{{ $fifthInputType }}" name="{{ $fifthInput }}">
            @endif

            @if (isset($label6))
            <label for="{{ $sixthInput }}">{{ $label6 }}:</label>
            <input type="{{ $sixthInputType }}" name="{{ $sixthInput }}">
            @endif
            <button type="submit" class="bg-blue-400 text-white cursor-pointer hover:bg-blue-700 p-2 rounded-md mt-3">{{ $createButton }}</button>
        </form>
    </div>
</section>