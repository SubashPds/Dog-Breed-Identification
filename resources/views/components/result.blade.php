    @if(isset($breed))
     <h1 class="flex justify-center items-center pt-16">{{ substr($breed, strrpos($breed, "This is a") + 9) }}</h1>
    @else
        <h1>No breed predicted yet</h1>
    @endif
