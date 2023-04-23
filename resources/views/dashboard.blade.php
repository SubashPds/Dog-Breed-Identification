<x-navbar/>
@extends('layout')

@section('main')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ( Auth::user()->is_admin==1)
                {{-- <x-admin /> --}}
                @include('components.admin', ['posts' => $posts])

                @endif

                @if ( Auth::user()->is_admin!=1)
                {{-- <x-user /> --}}
                @include('components.user', ['posts' => $posts])

                @endif


            </div>
        </div>
</x-app-layout>

@endsection