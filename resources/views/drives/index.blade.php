@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-header">
                <h5 class="card-title">List File</h5>
            </div>
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>File</th>
                            <th>Status</th>
                            <th colspan="3" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($drives as $drive)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $drive->title }}</td>
                                <td>{{ $drive->description }}</td>
                                <td>{{ $drive->file }}</td>
                                @php
                                    $lockIcon = ($drive->status === 'private') ? '<i class="text-info fas fa-lock"></i>' : '<i class="text-warning fa-solid fa-lock-open"></i>';
                                @endphp
                                <td>{!! $lockIcon !!}</td>
                                <td><a href="{{ route('drives.show',$drive->id) }}"><i class="text-info fa-solid fa-eye"></i></a></td>
                                <td><a href="{{ route('drives.edit',$drive->id) }}"><i class="text-warning fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="{{ route('drives.destroy',$drive->id) }}"><i class="text-danger fa-regular fa-trash-can"></i></a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No files found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
