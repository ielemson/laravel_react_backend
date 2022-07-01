@extends('layouts.welcomeLayout')

@section('content')
<div class="w3l-contact-10 py-5" id="contact">
    <div class="form-41-mian py-lg-5 py-md-4 py-2">
      <div class="container form-cover">
        <div>
          <div class="header-title text-center mx-auto mt-4">
            <h3 class="title-w3l login-title">Login</h3>
          </div>

                           
                                       
        <div class="mx-auto mt-3">
          <!-- Session Status -->
<x-auth-session-status class="mb-4 text-center text-danger text-sm" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4 text-center text-danger text-sm text-bold" :errors="$errors" />
</div>

        <form method="POST" action="{{ route('login') }}"  class="signin-form mt-4">
            @csrf
            <div class="form-input" data-aos="fade-down">
              <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Enter Email"
                :value="old('email')"
                required
              />
            </div>
            <div class="form-input mt-4 mb-4" data-aos="fade-down">
              <input
                type="password"
                name="password"
                class="form-control"
                placeholder="password "
                required
                
              />
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="customCheck1"
                />
                <label class="custom-control-label" for="customCheck1"
                  >Keep me logged in</label
                >
              </div>
            </div>
            <div class="text-center">
              <button class="btn btn-style btn-primary login-btn">
                Login Now
              </button>
            </div>
            <div class="text-center mt-3">
              <a href="{{ route('password.request') }}">Forgot password ?</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection