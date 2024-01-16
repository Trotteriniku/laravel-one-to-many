@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Project Create</h1>
        <p>section content</p>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    required minlength="3" maxlength="200" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body">Body</label>
                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30"
                    rows="10">
    {{ old('body') }}
    </textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="link">Link</label>
                <input type="url" class="form-control @error('link') is-invalid @enderror" name="link" id="link"
                    value="{{ old('link') }}">
                @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="preview">Preview</label>
                <input type="file" class="form-control @error('preview') is-invalid @enderror" name="preview"
                    id="preview" value="{{ old('preview') }}">
                @error('preview')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <button type="reset" class="btn btn-primary">Reset</button>

        </form>
    </section>
@endsection
