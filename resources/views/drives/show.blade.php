@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $drive->title }}</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    @if(strtolower(pathinfo($drive->file, PATHINFO_EXTENSION)) === 'pdf')
                        <iframe width="100%" height="400px" src="{{ asset('upload/' . $drive->file) }}" frameborder="0"></iframe>
                    @else
                        <img src="http://2.bp.blogspot.com/-fspTT4gzYB4/T6Ij3lLf2xI/AAAAAAAAA3g/Jo5DmFZ8hhU/s1600/hint+logo.jpg" class="img-fluid w-25" alt="File Preview">
                        <p class="lead">This file is {{ pathinfo($drive->file, PATHINFO_EXTENSION) }} and can't be shown in an iframe.</p>
                    @endif
                </div>
                <div class="mb-3">
                    <p class="lead">Description: {{ $drive->description }}</p>
                </div>

                <div class="mb-3">
                    @php
                        $lockIcon = ($drive->status === 'private') ? '<i class="text-info fas fa-lock"></i>' : '<i class="text-warning fa-solid fa-lock-open"></i>';
                    @endphp
                    <p class="lead">Status:  {{ $drive->status }} {!! $lockIcon !!}</p>
                </div>
                <div class="mb-3">
                    <p class="lead">Author By: {{ $drive->name }}</p>
                </div>


                {{-- Back Button --}}
                <a href="{{ route('drives.index') }}" class="btn btn-secondary">Back to List</a>

                {{-- Download Button --}}
                @if($drive->status === 'public')
                    <a href="{{ asset('upload/' . $drive->file) }}" class="btn btn-primary" download>Download This File</a>
                @else
                    <p>This file is private and cannot be downloaded.</p>
                @endif


            </div>
        </div>
    </div>
@endsection
