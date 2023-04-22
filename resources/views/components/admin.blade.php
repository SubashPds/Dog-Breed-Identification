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
      admin
      <div class="dashboard">
        <ul>
            <li><a href="{{route('blog.create')}}">Create Post</a></li>
            <li><a href="{{route('categories.create')}}">Create Category</a></li>
            <li><a href="{{route('categories.index')}}">Categories List</a></li>
        </ul>
    </div>
    </div>
</body>
</html>