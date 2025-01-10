@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section py-5">
        <div class="container d-flex flex-column flex-lg-row align-items-center">
            <div class="text-content me-lg-4">
                <h1 class="display-4 fw-bold">Welcome to Dear Dad</h1>
                <p class="lead mt-3">
                    A place to share heartfelt letters to your father. Express your emotions, share your stories, 
                    and connect with others who treasure their special bond with their dads. Join our community today!
                </p>
            </div>
            <div class="image-content mt-4 mt-lg-0">
                <img src="{{ asset('images/family_bond.png') }}" alt="Family Bond" class="img-fluid rounded">
            </div>
        </div>
    </div>

    <!-- Letters Section -->
    <div class="container mt-5">
        <h2 class="mb-4">Recent Letters</h2>
        <!-- Include the list of letters here -->
        @include('letters.index')
    </div>
@endsection
