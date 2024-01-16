@extends('layouts.app')
@section('content')
    <section class="container">
        <h1 class=" text-uppercase ">{{ $project->title }}</h1>
        <h2><a href="{{ $project->link }}">Pagina uffuciale</a></h2>
        <p>{{ $project->body }}</p>
        <div class=" w-25 overflow-hidden rounded-5 ">
            <img class="w-100" src="{{ asset('storage/' . $project->preview) }}" alt="{{ $project->title }}">
        </div>

    </section>
    <a class="btn btn-success" href="{{ route('admin.projects.edit', $project->id) }}">Modifica Progetto</a>
    <a class="btn btn-success" href="{{ route('admin.projects.destroy', $project->id) }}">Cancella Progetto</a>
@endsection
