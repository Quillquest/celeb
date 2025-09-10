@php
    if (Auth('admin')->User()->dashboard_style == 'light') {
        $text = 'dark';
        $bg = 'light';
    } else {
        $text = 'light';
        $bg = 'dark';
    }
@endphp
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content">
            <div class="page-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-2 mb-4">
                            <h1 class="title1 text-{{ $text }} text-center">Edit {{ $celebrity->name }} Profile</h1>
                        </div>
                        <x-danger-alert />
                        <x-success-alert />
                    </div>
                </div>
                <div class="mb-5 row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-2 shadow ">
                            <div class='text-center'>
                                <img style="" id="file-ip-1-preview"
                                    src="{{ asset('storage/' . $celebrity->photo) }} " width="90" height="90"
                                    class='rounded-circle'>
                            </div>


                            <div class="card-body">
                                <div>
                                    <form method="POST" action="{{ route('edit_celebrity') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Celebrity Name</h6>
                                                <input type="text"
                                                    class="form-control bg-{{ $bg }} text-{{ $text }}"
                                                    name="name" required value='{{ $celebrity->name }}'>
                                                <div class='mt-2'>
                                                    @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Occupation</h6>
                                                <input type="text"
                                                    class="form-control bg-{{ $bg }} text-{{ $text }}"
                                                    name="known_for" value='{{ $celebrity->known_for }}' requird>

                                                <div class='mt-2'>
                                                    @error('known_for')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Booking Fee
                                                    ({{ $settings->currency }})
                                                </h6>
                                                <input type="text"
                                                    class="form-control bg-{{ $bg }} text-{{ $text }}"
                                                    name="booking_fee" value='{{ $celebrity->booking_fee }}'>

                                                <div class='mt-2'>
                                                    @error('booking_fee')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Years Active</h6>
                                                <input type="text"
                                                    class="form-control bg-{{ $bg }} text-{{ $text }}"
                                                    name="years_active" value='{{ $celebrity->years_active }}' requird>

                                                <div class='mt-2'>
                                                    @error('years_active')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Date of birth</h6>
                                                <input type="date"
                                                    class="form-control bg-{{ $bg }} text-{{ $text }}"
                                                    name="dob"
                                                    value='{{ $celebrity->dob ? \Carbon\Carbon::parse($celebrity->dob)->format('Y-m-d') : '' }}'>

                                                <div class='mt-2'>
                                                    @error('dob')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>




                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Featured</h6>
                                                <select type="text"
                                                    class="form-control  bg-{{ $bg }} text-{{ $text }}"
                                                    name="featured">
                                                    <option value="featured"
                                                        {{ $celebrity->featured == 'featured' ? 'selected' : '' }}>Featured
                                                    </option>
                                                    <option value="not_featured"
                                                        {{ $celebrity->featured == 'not_featured' ? 'selected' : '' }}>Not
                                                        Featured</option>
                                                </select>

                                                <div class='mt-2'>
                                                    @error('featured')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Celebrity Country</h6>
                                                <input name='country' type='text'
                                                    class='form-control bg-{{ $bg }} text-{{ $text }}'
                                                    value='{{ $celebrity->country }}'>

                                                <div class='mt-2'>
                                                    @error('category')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>




                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Upload Celebrity photo</h6>
                                                <input type="file"
                                                    class="form-control bg-{{ $bg }} text-{{ $text }}"
                                                    name="photo" onchange="showPreview(event);">


                                                <div class='mt-2'>
                                                    @error('photo')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <input type='hidden' name='celebrity_id' value='{{ $celebrity->id }}'>
                                        </div>
                                        <button type="submit" class="px-5 btn  btn-primary">Update {{ $celebrity->name }}
                                            Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;

            }
        }
    </script>
@endsection
