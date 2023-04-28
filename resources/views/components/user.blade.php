<!DOCTYPE html>
<html lang="en">


<div class="p-1 bg-white border-b border-gray-200">

    <div class="dashboard">
        {{-- <ul>
            <li><a href="{{route('blog.create')}}">Create Post</a></li>
            <li><a href="{{route('categories.create')}}">Create Category</a></li>
            <li><a href="{{route('categories.index')}}">Categories List</a></li>
        </ul> --}}
        <a href="{{route('blog.create')}}"><button
                class="border-2 border-red-200 rounded-sm px-1 text-base text-gray-900 hover:bg-gray-200 hover:border-red-400">Create
                new blog</button></a>
        <h2 class="text-lg px-2">Your Blogs</h2>

        {{-- <ul>
            @foreach($posts as $post)
            <li>{{ $post->title }}</li>
            <img src="{{ asset($post->imagePath) }}" alt="" />
            <p>{{ $post->body }}</p>
            @endforeach
        </ul> --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($posts as $post)
            <div class="bg-gray-100 border-1 rounded-md overflow-hidden shadow-md relative">

                @if ($post->is_approved==0)
                <div class="absolute top-1 left-0 transform -translate-x-1/2 -translate-y-1/2 bg-red-500 text-white  text-xs py-1 px-2 rounded-tr-full rounded-bl-full"
                    style="z-index: 1; transform: rotate(-45deg);">
                    Pending
                </div>
                @else
                <div class="absolute top-1 left-0 transform -translate-x-1/2 -translate-y-1/2 bg-green-500 text-white  text-xs py-1 px-2 rounded-tr-full rounded-bl-full"
                    style="z-index: 1; transform: rotate(-45deg);">
                    Approved
                </div>
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-medium mb-2 ml-12">{{ $post->title }}</h3>
                    <div class="ml-auto mr-auto bg-gray-300 object-cover h-24 w-32  bg-cover bg-center"
                        style="background-image: url('{{ asset($post->imagePath) }}')">
                    </div>                  
                    {{-- <p class="text-gray-700 mb-4 mt-4">{{ Str::limit($post->body, 100) }}</p> --}}
                    <p class="text-gray-700 mb-4 mt-4">{{ Str::limit(html_entity_decode(strip_tags($post->body)), 100) }}</p>

                    {{-- <div class="float-right text-gray-700">
                        <a href="{{ route('blog.show', $post) }}"> Read more...</a>
                    </div> --}}
                </div>
                {{-- <div class="post-buttons">
                    <a class="border-1" href="{{ route('blog.edit', $post) }}">Edit</a>
                    <form action="{{ route('blog.destroy', $post) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete">
                    </form>
                </div> --}}
                <div class="absolute inset-x-0 bottom-0 p-2 flex justify-center gap-2">
                    <button class="px-2 bg-blue-500 text-white rounded-md"
                        onclick="window.location.href='{{ route('blog.show',$post) }}'">Read</button>
                    <button class="px-2 bg-yellow-500 text-white rounded-md"
                        onclick="window.location.href='{{ route('blog.edit',$post) }}'">Edit</button>
                    <button class="px-2 bg-red-500 text-white rounded-md">

                        <form action="{{ route('blog.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="bg-red-500">
                        </form>

                    </button>
                </div>


            </div>
            @endforeach
            @if (count($posts) === 0)
            <p class="mt-2 text-gray-500">No posts</p>
        @endif
        


        </div>


        </section>
    </div>
</div>