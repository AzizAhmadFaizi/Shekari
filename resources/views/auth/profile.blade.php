@extends('layouts.app')

@section('content')
    <div class="card-header">
        <h4 class="card-title">پروفایل من</h4>
    </div>
    <div class="card-body">
        <form class="form form-vertical" method="POST" action="{{ route('update-profile') }}">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label class="mb-1">اسم</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                <i data-feather="user"></i> </span>
                            <input class="form-control"value="{{ $user->name }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label class="mb-1">ایمیل</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                <i data-feather="mail"></i> </span>
                            <input class="form-control"value="{{ $user->email }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label class="mb-1">صلاحیت</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                <i data-feather="check-circle"></i> </span>
                            <input class="form-control"value="{{ $user->role_details->name }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label for="old_password" class="mb-1">رمز عبور قبلی</label>
                        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" placeholder="رمز عبور قبلی" name="old_password" autocomplete="off" required>
                        @error('old_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label for="password" class="mb-1">رمز عبور جدید</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="current-password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-1">
                        <label for="password-confirm" class="mb-1">تایید رمز عبور جدید</label>
                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" autocomplete="new-password" required>
                    </div>
                </div>

                <div class="col-6 mt-2">
                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light"><span data-feather="save"></span></button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    @if (session()->has('success_update'))
        <script>
            success_msg("مشخصات شما تغییر نمود");
        </script>
    @endif
    @if (session()->has('error_old_password'))
        <script>
            error_msg("رمز عبور قبلی درست نیست");
        </script>
    @endif
@endsection
