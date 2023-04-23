<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="p-6 bg-white border-b border-gray-200">
      <div class="dashboard">
        {{-- <ul>
            <li><a href="{{route('blog.create')}}">Create Post</a></li>
            <li><a href="{{route('categories.create')}}">Create Category</a></li>
            <li><a href="{{route('categories.index')}}">Categories List</a></li>
        </ul> --}}
        <a href="{{route('blog.create')}}"><button class="border-2 border-red-200 rounded-sm px-1 text-base text-gray-900 hover:bg-gray-200 hover:border-red-400">Pending Blogs</button></a>

    </div>
    </div>
</body>
</html>