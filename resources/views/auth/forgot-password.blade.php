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

        <form method="POST" action="{{ route('password.email') }}"  class="signin-form mt-4">
            @csrf
            <div class="form-input" data-aos="fade-down">
              <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Enter Email"
                :value="old('email')"
                required 
                autofocus
              />
            </div>
            <div class="form-input mt-4 mb-4" data-aos="fade-down">
                <div class="text-center">
                    <button class="btn  btn-primary">
                        Email Password Reset Link
                    </button>
                
                  </div>
            </div>
           
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection