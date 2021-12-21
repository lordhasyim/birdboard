@extends('layouts.app')
@section('content')

    <header class="flex items-center mb-3 py-4">
        <header class="flex items-center mb-3 pb-4">
            <div class="flex justify-between items-end w-full">
                <h2 class="text-muted text-base font-light">My Projects</h2>
    
                <a href="/projects/create" class="button">New Project</a>
            </div>
        </header>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="bg-white p-5 rounded-lg shadow">
                    <a href="{{$project->path()}}" class="text-black no-underline">
                        <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-400 pl-4 " style="">{{ $project->title }}</h3>
                    </a>
                    <div class="text-gray-600">{{ str_limit($project->description, 100) }}</div>
                </div>
            </div>
        @empty
            <div>No Projects yet</div>
            
        @endforelse
    </main>

   
@endsection