<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
} else {
    $text = 'light';
}
?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content ">
            <div class="page-inner">

                <div class="mt-2 mb-4">
                    <h1 class="title1 ">All Celebrities</h1>
                </div>
                <x-danger-alert />

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-5 row">
                    <div class="col card p-3 shadow ">
                        <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
                            <span style="margin:3px;">
                                <table id="ShipTable" class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Celebrity Photo</th>
                                            <th>Celebrity Name</th>
                                            <th>Occupation</th>
                                            <th>Booking Fee</th>
                                            <th>Active Year</th>
                                            <th>date of birth</th>
                                            <th>Date Created</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($celebrities as $celebrity)
                                            <tr>
                                                <td><img width="85" height="80"
                                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                        data-src="{{ asset('storage/' . $celebrity->photo) }}"
                                                        alt="{{ $celebrity->name }}" class="lazy-load"></td>
                                                <td>{{ $celebrity->name }} </td>
                                                <td>{{ $celebrity->known_for }}</td>
                                                <td>{{ $settings->currency }}{{ $celebrity->booking_fee }}</td>
                                                <td>{{ $celebrity->years_active }}
                                                </td>
                                                <td>{{ $celebrity->dob }}</td>
                                                <td>{{ \Carbon\Carbon::parse($celebrity->created_at)->toDayDateTimeString() }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('ViewApplication', $celebrity->id) }}"
                                                        class="m-1 btn btn-info btn-sm"><i class="fa fa-eye"></i> Edit</a>
                                                </td>


                                                <td>
                                                    <a href="{{ route('deleteApplication', $celebrity->id) }}"
                                                        class="m-1 btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Lazy loading for images
        document.addEventListener('DOMContentLoaded', function() {
            const lazyImages = document.querySelectorAll('.lazy-load');

            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-load');
                        imageObserver.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(img => imageObserver.observe(img));
        });
    </script>
@endsection
