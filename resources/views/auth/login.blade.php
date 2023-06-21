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
            <div class="row">
                <div class="col-md-6 side-image">
                    <!-------Image-------->
                    <div class="text">
                        
                    </div>
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>T R A V E L G O</header>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-field">
                                <input type="email" name="email" class="input @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                                <label for="email">Email</label>
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" id="password" required >
                                <label for="password">{{ __('Password') }}</label>
                                @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <button type="submit" class="submit" value="Sign In"> {{ __('Sign In') }} </Button>
                                
                            </div>
                            <div class="signin">
                                <span>Don't have an account? <a href="{{ route('register') }}" style="color: #B08D74;">Sign Up</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>