<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">

</head>

<body>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 ">
        <div class="p-3 bg-white border-b border-gray-200">
            <i class="fas fa-blog"></i> &nbsp Blogs
            <div class="mt-3">
                <table class="w-72">
                    <tr>
                        <td class="w-44">Total Blogs</td>
                        <td>{{ $total_posts }}</td>
                    </tr>
                    <tr>
                        <td class="w-44">Approved Blogs</td>
                        <td>{{$total_approved_posts }}</td>
                        <td class="pl-16">
                            <a href="{{ route('blog.index') }}"> <button
                                    class="rounded px-2 bg-gray-500 text-white mb-1 hover:bg-gray-600">view</button>
                            </a>
                        </td>

                    </tr>
                    <tr>
                        <td class="w-44">Pending Blogs</td>
                        <td> {{ $total_pending_posts }}</td>
                        <td class="pl-16"> <a href="{{route('dashboard.pending')}}"><button
                                    class="rounded px-2 bg-gray-500 text-white mt-1 hover:bg-gray-600">view</button></a>
                        </td>

                    </tr>
                </table>


            </div>
        </div>
        <div class="p-3 bg-white border-b border-gray-200">
            <i class="fas fa-list"></i> &nbsp Categories
            <div class="mt-3">
                <table class="w-full">
                    @foreach ($categories as $category)
                    <tr>
                        <td class="w-56">{{ $category->name }}</td>
                        <td> <a href="{{ route('categories.edit', $category) }}"><button
                                    class="rounded px-2 mr-1 bg-gray-500 text-white mt-1 hover:bg-gray-600 text-sm pt-0.5">Edit</button></a>
                        </td>
                        <td>
                            <form action="{{route('categories.destroy', $category)}}" method="post">
                                @method('delete')
                                @csrf
                                <input type="submit" value="Delete"
                                    class="rounded px-2 bg-gray-500 text-white mt-1 hover:bg-gray-600 text-sm pt-0.5">
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </table>

                <div>
                    <a href="{{ route('categories.create') }}">
                        <button class="rounded px-2 bg-gray-500 text-white mt-1 hover:bg-gray-600">
                            Create Category
                        </button>
                    </a>
                </div>





            </div>
        </div>
        <div class="p-3 bg-white border-b border-gray-200"><i class="fas fa-user"></i> &nbsp Users

            <div class="mt-3">
                <div>
                    Total Users <span class="ml-3">{{ $totalUsers }}</span>
                </div>
               <div class="mt-2">
                <div class="border-b-2">Latest users</div>
                <div class="mt-2">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        @foreach ($latestUsers as $latestUser)
                        <tr>
                            <td class="w-36">{{ $latestUser->name }}</td>
                            <td>{{ $latestUser->email }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
               </div>
            </div>
            <div><button  class="rounded px-2 bg-gray-500 text-white mt-2 hover:bg-gray-600 pt-0.5">See more</button></div>
        </div>

    </div>

</body>

</html>