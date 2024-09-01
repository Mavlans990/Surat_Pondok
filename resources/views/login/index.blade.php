@extends('layouts.main')

@section('isi')
<section class="" style="margin-top: 200px">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      </div>
    </div>
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="/login" method="post">
            @csrf
  
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="text" name="user_nama" id="form3Example3" class="form-control form-control-lg @error('user_nama') is-invalid @enderror"
                placeholder="Enter Name" autofocus required value="{{ old('user_nama') }}"/>
              {{-- <label class="form-label" for="form3Example3">Email address</label> --}}
              @error('user_nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            {{-- <div class="form-outline mb-4">
              <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div> --}}
  
            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" name="user_password" id="form3Example4" class="form-control form-control-lg"
                placeholder="Enter password" />
              {{-- <label class="form-label" for="form3Example4">Password</label> --}}
            </div>
  
            {{-- <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Remember me
                </label>
              </div>
              <a href="#!" class="text-body">Forgot password?</a>
            </div> --}}
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="/register"
                  class="link-danger">Register</a></p>
            </div>
  
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection