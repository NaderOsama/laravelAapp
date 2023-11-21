@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Edit File: {{ $drive->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('drives.update', $drive->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $drive->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $drive->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Old File is <span class="text-primary">{{ $drive->file }}</span> But Can Update This Or Not </label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status </label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="private" {{ $drive->status === 'private' ? 'selected' : '' }}>Private</option>
                            <option value="public" {{ $drive->status === 'public' ? 'selected' : '' }}>Public</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update File</button>
                </form>
            </div>
        </div>
    </div>
@endsection
