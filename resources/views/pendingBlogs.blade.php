<x-navbar/>
<x-app-layout>
<div class="p-5"><h2>Pending blogs</h2></div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pl-5">
    @if ($posts)
    @foreach($posts as $post)
    <div class="bg-white border-1 rounded-md overflow-hidden shadow-md relative">

        
        <div class="absolute top-1 left-0 transform -translate-x-1/2 -translate-y-1/2 bg-red-500 text-white  text-xs py-1 px-2 rounded-tr-full rounded-bl-full"
            style="z-index: 1; transform: rotate(-45deg);">
            Pending
        </div>
    
      
        <div class="p-4">
            <h3 class="text-lg font-medium mb-2 ml-12">{{ $post->title }}</h3>
            <div class="ml-auto mr-auto bg-gray-300 object-cover h-24 w-32  bg-cover bg-center"
                style="background-image: url('{{ asset($post->imagePath) }}')">
            </div>
            <p class="text-gray-700 mb-4 mt-4">{{ Str::limit(html_entity_decode(strip_tags($post->body)), 100) }}</p>
            <div class="absolute bottom-8 right-1 text-gray-700">
                <a href="{{ route('blog.show', $post) }}"> Read more...</a>
            </div>
        </div>
        <div class="absolute bottom-1 right-1">
            <form action="{{ route('blog.approve', $post) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="submit" value="Approve" class="px-2 border-rounded bg-green-500 text-white rounded cursor-pointer"> 
            </form>
        </div>
    </div>
    @endforeach
    @else
        <p>No pending blogs</p>
    @endif
  


</div>

</x-app-layout>
