<x-navbar />

@extends('layout')

@section('main')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>
    <!-- main -->
    <main class="container">
        <h2 class="header-title">All Blog Posts</h2>
        @include('includes.flash-message')
        <div class="searchbar">
            <form action="">
                <input type="text" placeholder="Search..." name="search" />

                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>

            </form>
        </div>
        <div class="categories">
            <ul>
                @foreach ($categories as $category)
                <li><a href="{{route('blog.index', ['category' => $category->name ])}}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <section class="cards-blog latest-blog">
            @forelse($posts as $post)
            <div class="card-blog-content border-2 w-80 p-3">
                <p class="blogInfo">
                    {{ $post->created_at->diffForHumans() }}
                    <span>Written By {{ $post->user->name }}</span>
                </p>
                <h4>
                    <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                </h4>
                <div class="flex justify-center">
                    <img class="object-fill h-36 w-52" src="{{ asset($post->imagePath) }}" alt="" />

                </div>
                <p class="text-gray-700 mb-4 mt-4">{{ Str::limit(html_entity_decode(strip_tags($post->body)), 100) }}</p>

                <div class="float-right text-gray-700">
                    <a href="{{ route('blog.show', $post) }}"> Read more...</a>
                </div>
                <div>
                    @if ( Auth::user()->is_admin=1)
                    <button class="mt-3 px-2 bg-red-500 text-white rounded-md">

                        <form action="{{ route('blog.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="bg-red-500">
                        </form>
                    </button>
                        <button class="mt-3 px-2  text-white rounded-md">
                            <form action="{{ route('blog.block', $post) }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <input type="submit" value="Block" class="px-2 border-rounded bg-green-500 text-white rounded cursor-pointer"> 
                            </form>
                    </button>
                    @endif
                </div>
            </div>

            @empty
            <p>Sorry, currently there is no blog post related to that search!</p>
            @endforelse
        </section>

        <!-- pagination -->
        <div class="flex justify-center">
            {{ $posts->links('pagination::default') }}
        </div>

        <br>
</x-app-layout>

@endsection