@extends('layouts.app')

@section('title', 'Create Letter')

@section('content')
    <h1 class="mb-4">Create Letter</h1>
    <form action="{{ route('letters.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
