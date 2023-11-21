@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-header">
                <h5 class="card-title">Your Name is {{ $user->name }}</h5>
            </div>
            <div class="card-body">

                <div class="d-flex align-items-center justify-content-center flex-column mb-4">
                    <div class="mb-3">
                        @if ($user->gender == 'male' && $user->profile === null )
                            <img src="{{ asset("images/fake-male.jpg") }}" alt="Male Profile Image" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                        @elseif ($user->gender == 'female' && $user->profile === null)
                            <img src="{{ asset("images/fake-women.png") }}" alt="Female Profile Image" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                        @elseif ($user->gender === null && $user->profile === null)
                            <img src="{{ asset("images/default-profile.png") }}" alt="Default Profile Image" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                        @else
                            <img src="{{ asset("profile_images/$user->profile") }}" alt="User Profile Image" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                        @endif
                    </div>

                    <form method="POST" action="{{ route('update.profile.image') }}" enctype="multipart/form-data" class="text-center">
                        @csrf

                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Change Profile Image</label>
                            <input type="file" class="form-control btn btn-primary" id="profile_image" name="profile_image">
                        </div>

                        <button type="submit" class="btn btn-success">Update Profile Image</button>
                    </form>
                </div>

                <hr>

                <div class="mb-3">
                    <h6>User Details:</h6>
                    <p><strong>User ID:</strong> {{ $user->id }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <!-- Add other fields as needed -->
                </div>
            </div>
        </div>
    </div>
@endsection
