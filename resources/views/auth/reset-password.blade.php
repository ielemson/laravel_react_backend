@extends('layouts.welcomeLayout')

@section('content')
    <div class="w3l-contact-10 py-5" id="contact">
        <div class="form-41-mian py-lg-5 py-md-4 py-2">
            <div class="container form-cover">
                <div>
                    <div class="header-title text-center mx-auto mt-4">
                        <h3 class="title-w3l login-title">Reset Password</h3>
                    </div>

                    <div class="mx-auto mt-3">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4 text-center text-danger text-sm" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4 text-center text-danger text-sm text-bold" :errors="$errors" />
                    </div>


                    <form method="POST" action="{{ route('password.update') }}" class="signin-form mt-4">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-input" data-aos="fade-down">
                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                        </div>
                        <div class="form-input mt-4 mb-4" data-aos="fade-down">
                            <input type="password" name="password" class="form-control" placeholder="password "
                                required />
                        </div>
                        <div class="form-input mt-4 mb-4" data-aos="fade-down">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="password "
                                required />
                        </div>
                        
                        <div class="text-center">
                            <button class="btn  btn-primary login-btn">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
