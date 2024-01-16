@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Edit Project</h1>
        <p>section content</p>
        <h1>Edit {{ $project->title }}</h1>
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    required minlength="3" maxlength="200" value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body">Body</label>
                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30"
                    rows="10">
    {{ old('body', $project->body) }}
    </textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="link">Link</label>
                <input type="url" class="form-control @error('link') is-invalid @enderror" name="link" id="link"
                    value="{{ old('link', $project->link) }}">
                @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="preview">Preview</label>
                <input type="file" class="form-control @error('preview') is-invalid @enderror" name="preview"
                    id="preview" value="{{ old('preview', $project->preview) }}">
                @error('preview')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <button type="reset" class="btn btn-primary">Reset</button>

        </form>
    </section>
@endsection
