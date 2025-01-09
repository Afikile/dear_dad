@extends('layouts.app')

@section('content')
    <h1>Letter</h1>

    <p>{{ $letter->content }}</p>

    {{-- You can add features like:
        - Displaying the date/time the letter was created
        - Allowing users to like or share the letter (if applicable) 
    --}}

@endsection