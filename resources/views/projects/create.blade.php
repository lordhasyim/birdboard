@extends('layouts.app')
@section('content')
    <form method="POST" action="/projects">
        @csrf
        <h4 class="heading is-1">Create Form</h4>
        <div class="field">
            <label for="" class="label">Title</label>
            <div class="control">
                <input name="title" type="text" class="input" placeholder="title">
            </div>
        </div>

        <div class="field">
            <label for="" class="label">Description</label>
            <div class="control">
                <textarea name="description" id="" cols="30" rows="10" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">create project</button>
                <a href="/projects" class="btn btn-cancel">Cancel</a>
            </div>
        </div>
    </form>
@endsection