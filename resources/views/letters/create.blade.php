@extends('layouts.app')

@section('title', 'Create a New Letter')

@section('content')
<div class="container">
    <h1>Create a New Letter</h1>

    <form action="{{ route('letters.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Letter Content:</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save Letter</button>
    </form>
</div>
@endsection
