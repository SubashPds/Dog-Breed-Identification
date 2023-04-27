@if(isset($breed))
    <div class="flex justify-center items-center mr-28 mt-6 mb-6">
        <img class="object-fill h-36 w-52" src="{{ asset($image) }}" alt="" />
        @if(strpos($breed, 'This is a Pug') !== false)
            <h1 class="pl-6 text-green-500">This is a Pug</h1>
        @elseif(strpos($breed, 'This is a Japanese spaniel') !== false)
            <h1 class="pl-6 text-green-500">This is a Japanese spaniel</h1>
        @elseif(strpos($breed, 'This is a Chow') !== false)
            <h1 class="pl-6 text-green-500">This is a Chow</h1>
        @else
            <h1 class="pl-6 text-red-500">Sorry, I cannot identify that image.</h1>
        @endif
    </div>
@else
    <h1>No breed predicted yet</h1>
@endif
