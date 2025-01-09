@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Letter</h1>
    <form action="{{ route('letters.update', $letter->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="username">Your Name</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ $letter->username }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="content">Letter Content</label>
            <textarea name="content" id="content" class="form-control" required>{{ $letter->content }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="is_approved">Approve Letter?</label>
            <input type="checkbox" name="is_approved" id="is_approved" value="1" 
                {{ $letter->is_approved ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
