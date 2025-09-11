<form method="POST" action="{{ route('profile.password.update') }}">
    @csrf
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="current_password">{{ __('Old Password') }}</label>
                <input id="current_password" type="password" name="current_password" class="form-control" required>
                @error('current_password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="password">{{ __('New Password') }}</label>
                <input id="password" type="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                    required>
                @error('password_confirmation')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
    </form>

    <div class="mt-4">
        <a href="{{ route('2fa') }}" class="text-decoration-none">{{ __('Advance Account Settings') }} <i
                class="fas fa-arrow-right"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="alert alert-light mw-450px" role="alert">
                <h4 class="mb-3">{{ __('Password requirements:') }}</h4>
                <ul class="p-3 mb-0">
                    <li>{{ __('Minimum 8 characters long - the more, the better') }}</li>
                    <li>{{ __('At least one lowercase character') }}</li>
                    <li>{{ __('At least one uppercase character') }}</li>
                    <li>{{ __('At least one number, symbol.') }}</li>
                </ul>
            </div>
        </div>
    </div> <!-- / .row -->
