<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('frontend/styles/stylelogin.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title></title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row regis">
                <div class="col-md-6 side-image">
                    <!-------Image-------->
                    <div class="text">
                        
                    </div>
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>T R A V E L G O</header>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="input-field">
                                <input id="name" type="text"  class="input @error('name') is-invalid @enderror"  value="{{ old('name') }}" name="name" required autocomplete="name" autofocus>
                                <label for="name">Name</label>
                                @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="input-field">
                                <input type="text" name="username" class="input @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" required>
                                <label for="username">Username</label>
                                @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            
                            <div class="input-field">
                                <input type="text" name="email" class="input @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                                <label for="email">{{ __('Email Address') }}</label>
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="input-field">
                                
                                <input id="password" type="password" class="input  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <label for="password">{{ __('Password') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field">
                                
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            </div>
                            

                            <div class="input-field">
                                <input readonly id="roles" type="text" class="input" name="roles" value="USER" required autofocus style="color: #B08D74">
                            </div>
                            
                                    


                            <div class="input-field">
                                <button type="submit" class="submit"> {{ __('Register') }} </Button>
                                
                            </div>
                            {{-- <div class="signin">
                                <span>Already have an account? <a href="{{ route('login') }}" style="color: #B08D74;">Login</a></span>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="roles" class="col-md-4 col-form-label text-md-end">{{ __('Roles') }}</label>

                            <div class="col-md-6">
                                <input readonly id="roles" type="text" class="form-control" name="roles" value="USER" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
