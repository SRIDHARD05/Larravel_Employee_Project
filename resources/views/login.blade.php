@extends('layouts.app')

@section('content')

<div class="container my-auto">
    <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                        <div class="row mt-3">
                            <div class="col-2 text-center ms-auto">
                                <a class="btn btn-link px-3" href="javascript:;">
                                    <i class="fa fa-facebook text-white text-lg"></i>
                                </a>
                            </div>
                            <div class="col-2 text-center px-1">
                                <a class="btn btn-link px-3" href="javascript:;">
                                    <i class="fa fa-github text-white text-lg"></i>
                                </a>
                            </div>
                            <div class="col-2 text-center me-auto">
                                <a class="btn btn-link px-3" href="javascript:;">
                                    <i class="fa fa-google text-white text-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" class="text-start" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email here..." required>

                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password here..." required>

                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch d-flex align-items-center mb-3">
                            <input class="form-check-input" name="remember" type="checkbox">
                            <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                        </div>
                        <p class="mt-4 text-sm text-center">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection