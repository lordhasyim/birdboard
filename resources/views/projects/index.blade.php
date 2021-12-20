@extends('layouts.app')
@section('content')

    <div style="flex items-center mb-3">

        <a href="/projects/create">Create New Project</a> 
    </div>

    <div class="flex">
        @forelse ($projects as $project)
            <div class="bg-white p-5 mr-4 rounded shadow w-1/3">
                <h3 class="font-normal text-xl mb-4">{{ $project->title }}</h3>
                <div class="text-gray-600">{{ str_limit($project->description, 100) }}</div>
            </div>
        @empty
            <div>No Projects yet</div>
            
        @endforelse
    </div>

   
@endsection