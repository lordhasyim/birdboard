@extends('layouts.app')
@section('content')

<header class="flex items-center mb-3 pb-4">
    <div class="flex justify-between items-end w-full">
        <h2 class="text-muted text-base text-grey font-light">My Projects</h2>
        <a href="/projects/create" class="bg-blue-button no-underline rounded-lg text-sm text-white py-2 px-5" >New Project</a>
    </div>
</header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="bg-white p-5 rounded-lg shadow">
                    <a href="{{$project->path()}}" class="text-black no-underline">
                        <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-light pl-4">
                        <a href="{{ $project->path() }}" class="text-default no-underline">{{ $project->title }}</a>                        </h3>
                    </a>
                    <div class="text-grey mb-4 flex-1">{{ str_limit($project->description, 100) }}</div>
                </div>
            </div>
        @empty
            <div>No Projects yet</div>
            
        @endforelse
    </main>

   
@endsection