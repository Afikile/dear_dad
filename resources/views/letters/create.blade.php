<!-- resources/views/letters/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Letter</h1>

    <form action="{{ route('letters.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
@endsection
