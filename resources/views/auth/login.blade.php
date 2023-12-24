@extends('layouts.app')
@section('content')

<div class="container mt-5">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 col-lg-6 offset-lg-3 col-xl-4">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="row">
        <div class="text-center mb-4">         
            <img src="{{ asset('img/logo.png')}}" height="100" alt="" class="rounded">                
        </div>
    </div>

    <div class="row">
      <div class="card card-md">
        <div class="card-body">
          <h2 class="h2 text-center mb-4">Login to your account</h2>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label class="form-label">Email address</label>
              <input id="email" name="email" type="email" class="form-control" placeholder="your@email.com" autocomplete="off">
              <x-input-error :messages="$errors->get('email')" class="mt-14" />
            </div>

            <div class="form-group">
              <label class="form-label">
                Password
                <span class="form-label-description">
                    @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">I forgot password</a>
                  @endif
                </span>
              </label>
              <div class="input-group input-group-flat">
                <input id="password" name="password" type="password" class="form-control"  placeholder="Your password"  autocomplete="off">
                
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>
            </div>             

            <div class="mb-2">
              <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">Remember me on this device</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
          </form>
        </div>    
      
      <div class="text-center text-muted mt-3">
        Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
      </div>
    </div>
  </div>
</div>
@endsection
