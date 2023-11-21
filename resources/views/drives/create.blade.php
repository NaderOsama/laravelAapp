@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            {{-- display error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- display success message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- display error message --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Create Post Form -->
            <div class="card-header">
                <h5 class="card-title">Create File</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('drives.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Your File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="private">Private</option>
                            <option value="public">Public</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create New File</button>
                </form>
            </div>
        </div>
    </div>
@endsection
