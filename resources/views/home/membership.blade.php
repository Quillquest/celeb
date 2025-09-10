@extends('layouts.base')
@section('title', $title)
@section('content')
    <section class="section auth">
        <div class="wrapper">
            <div class="title-box">
                <h3 class="heading"> {{ $settings->site_name }}</h3>
                <p class="paragraph">FAN MEMBERSHIP FORM</p>
            </div>
            <div class="boxes">
                <div class="box">
                    @if (Session::has('success'))
                        <div
                            style="background-color: #4CAF50; color: #fff; padding: 10px; text-align: center; margin : 10px 0;">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div style="background-color: red; color: #fff; padding: 10px; text-align: center; margin : 10px 0;">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="{{ route('apply_membership_card') }}" class="form" method="POST">
                        @csrf
                        <div class="column-row">
                            <label for="#"> Name
                                <input type="text" placeholder="Enter Name" name="name" required>
                            </label>

                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="label-row">
                            <label for="#">Phone Number
                                <input type="text" placeholder="Phone Number" name="phone" required>

                                @error('phone')
                                    <div class="alert alert-danger mb-1">{{ $message }}</div>
                                @enderror
                            </label>

                            <label for="#">Email
                                <input type="email" placeholder="Email" name="email" required>
                            </label>

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="column-row">
                            <label for="#">Celebrity Name
                                <input type="text" placeholder="Celebrity Name" value="{{ $celebrity->name }}"
                                    name="celebrity" required readonly>
                            </label>
                            <input type="hidden" value="{{ $celebrity->id }}" name="celebrity_id" required>

                            <input type="hidden" value="Card Membership Purchase" name="booking_type" required>

                        </div>
                        <div class="column-row">
                            
                            <input type="hidden" value="Card Membership Purchase" name="purpose" required>
                            
                        </div>

                        <div class="label-row">
                            <label for="#">Payment Method
                                <select type="text" placeholder="Purpose of Booking" name="method" required>
                                    <option value="International Bank Transfer">International Bank Transfer</option>
                                    <option value="Cryptocurrency">Cryptocurrency</option>
                                </select>
                                @error('method')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </label>

                            <label for="#">Membership Status
                                <select type="text" placeholder="Purpose of Booking" name="membership_plan" required>
                                    <option value="$1,500.00 - Gold ">$1,500.00 - Gold </option>
                                    <option value="$4,500.00 - Premium ">$4,500.00 - Premium </option>
                                    <option value="$9,500.00 - Silver">$9,500.00 - Silver</option>
                                </select>
                            </label>

                            @error('membership_plan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <label for="#">
                            <span class="label-row">
                                <input required type="checkbox" name="check" id="check">
                                <p class="paragraph">By clicking this form you agree to all <a href="/">Terms &
                                        conditions</a></p>
                            </span>
                        </label> --}}

                        <label for="#"><button name="book">Submit</button></label>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
