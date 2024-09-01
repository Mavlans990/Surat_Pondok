@extends('layouts.main')

@section('isi')
<section class="" style="margin-top: 200px">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="/register" method="POST">
            @csrf

            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="text" name="user_nama" id="form3Example4" class="form-control form-control-lg"
                placeholder="Enter Name" required value="{{ old('user_nama') }}"/>
              {{-- <label class="form-label" for="form3Example4">Password</label> --}}
            </div>
            
            <!-- Email input -->
            {{-- <div class="form-outline mb-4">
              <input type="text" name="username" id="form3Example3" class="form-control form-control-lg @error('username') is-invalid @enderror"
              placeholder="Enter Username" required value="{{ old('username') }}"/> --}}
              {{-- <label class="form-label" for="form3Example3">Email address</label> --}}
              {{-- @error('username')
                <div class="invalid-feedback">
                  Username Sudah Tersedia.
                </div>
              @enderror
            </div> --}}
  
            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" name="user_password" id="form3Example4" class="form-control form-control-lg"
                placeholder="Enter password" required />
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
              <button class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">you have an account? <a href="/login " class="link-danger">Login</a></p>
            </div>
  
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection