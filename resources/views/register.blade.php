@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
        </div>
    </div>
    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
        <div class="card card-plain">
            <div class="card-header">
                <h4 class="font-weight-bolder">Sign Up</h4>
                <p class="mb-0">Enter your email and password to register</p>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="/register">
                    @csrf
                    <div class="input-group input-group-outline mt-3">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name here" required>
                    </div>
                    @error('name')
                    <p class="text-danger text-start text-sm">{{ $message }}</p>
                    @enderror


                    <div class="input-group input-group-outline mt-3">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email here..." value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                    <p class="text-danger text-start text-sm">{{ $message }}</p>
                    @enderror
                    

                    <div class="input-group input-group-outline mt-3">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password here.." required>
                    </div>
                    @error('password')
                    <p class="text-danger text-start text-sm">{{ $message }}</p>
                    @enderror



                    <div class="input-group input-group-outline mt-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password here..." required>
                    </div>
                    @error('password_confirmation')
                    <p class="text-danger text-start text-sm">{{ $message }}</p>
                    @enderror


                    <div class="form-check form-check-info text-start ps-0 mt-3">
                        <input class="form-check-input" type="checkbox" name="agree">
                        <label class="form-check-label" for="flexCheckDefault">
                            I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                        </label>

                        @error('agree')
                        <p class="text-danger text-start text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-2 mb-0">Sign Up</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection