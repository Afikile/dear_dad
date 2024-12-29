@extends('layouts.app')

@section('title', 'Welcome to Dear Dad')

@section('content')
    <div class="container">
        <h1>Welcome to Dear Dad</h1>
        <p>This is a safe space for young people to express their feelings to their fathers.</p>

        @if(Auth::check())
            <a href="{{ route('letters.create') }}" class="btn btn-primary">Write a Letter</a>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to share your thoughts.</p>
        @endif
    </div>
@endsection
