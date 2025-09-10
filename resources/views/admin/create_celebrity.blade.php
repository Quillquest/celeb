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
                            <h1 class="title1 text-{{ $text }} text-center">Create New Celebrity</h1>
                        </div>
                        <x-danger-alert />
                        <x-success-alert />
                    </div>
                </div>
                <div class="mb-5 row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-2 shadow ">
                            <div class="card-body">
                                <div>
                                    <form method="POST" action="{{ route('createcelebrity') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Celebrity Name</h6>
                                                <input type="text"
                                                    class="form-control bg-{{ $bg }} text-{{ $text }}"
                                                    name="name" required placeholder="Celebrity Name">
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
                                                    name="known_for" placeholder="Occupation" requird>

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
                                                    name="booking_fee" placeholder="Booking Fee">

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
                                                    name="years_active" placeholder="Years Active" requird>

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
                                                    name="dob" required>

                                                <div class='mt-2'>
                                                    @error('dob')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Celebrity Country</h6>
                                                <input name='country' type='text'
                                                    class='form-control bg-{{ $bg }} text-{{ $text }}'>

                                                <div class='mt-2'>
                                                    @error('category')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Featured</h6>
                                                <select type="text"
                                                    class="form-control  bg-{{ $bg }} text-{{ $text }}"
                                                    name="featured" required>

                                                    <option value="featured">Featured</option>
                                                    <option value="not_featured">Not Featured</option>
                                                </select>

                                                <div class='mt-2'>
                                                    @error('featured')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <h6 class="text-{{ $text }}">Upload Celebrity photo</h6>
                                                <input type="file"
                                                    class="form-control bg-{{ $bg }} text-{{ $text }}"
                                                    name="photo" required>


                                                <div class='mt-2'>
                                                    @error('photo')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>
                                        <button type="submit" class="px-5 btn  btn-primary">Add Celebrity</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
