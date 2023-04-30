<x-navbar />
@extends('layout')

@section('main')
<x-app-layout>
    <div class="back ml-3">
        <a href="{{route('dashboard')}}"><button>Back</button></a>
    </div>

    <div class="flex justify-center">
        <main>
            <section>
              
                <div class="mt-4 mb-3 block w-60 text-center">All Users</div>
                <div class="flex justify-center">
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users as $user)
                            <tr class="@if ($loop->even) bg-gray-100 @endif">
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </x-app-layout>
        </main>
    </div>
    @endsection