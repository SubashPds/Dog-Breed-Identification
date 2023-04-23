<x-navbar/>

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
                    <p>
                        {{ $post->created_at->diffForHumans() }}
                        <span>Written By {{ $post->user->name }}</span>
                    </p>
                    <h4>
                        <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                    </h4>
                    <img class="w-52" src="{{ asset($post->imagePath) }}" alt="" />
                    <p class="text-gray-900 mb-4 mt-4">{{ Str::limit($post->body, 100) }}</p>
        
                    @auth
                        @if (auth()->user()->id === $post->user->id)
                            <div class="post-buttons">
                                <a href="{{ route('blog.edit', $post) }}">Edit</a>
                                <form action="{{ route('blog.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete">
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @empty
                <p>Sorry, currently there is no blog post related to that search!</p>
            @endforelse
        </section>
        
        <!-- pagination -->

        {{ $posts->links('pagination::default') }}
        <br>
    </x-app-layout>

        @endsection
