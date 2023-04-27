    @if(isset($breed))
     <h1 class="flex justify-center items-center pt-16">{{ substr($breed, strrpos($breed, "This is a") + 9) }}</h1>
     <img src="{{ url('storage/app/images/n02112137_1614.jpg') }}" alt="Image description">

     @else
        <h1>No breed predicted yet</h1>
    @endif
