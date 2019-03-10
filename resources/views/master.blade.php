<html>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ asset('style.css') }}" media="all" rel="stylesheet" type="text/css" />
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="/resources/assets/js/responsive-paginate.js"></script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Gold Coast Discounts</title>
    </head>
    <body>
        <div class="container" style="max-width:100%">
        
            <nav class="navbar navbar-expand-lg greencode">
                <a class="navbar-brand greencode" href="{{ route('vouchers.index') }}">Gold Coast Discounts</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navT" aria-controls="navT" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                
                <div class="collapse navbar-collapse" id="navT">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href={{ route('vouchers.index') }}>Vouchers <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href={{ route('contact') }}>Contact Us</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href={{ route('about') }}>About Us</a>
                    </li>-->
                    
                    @if (Auth::check() && (Auth::user()->admin))
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('vouchers.create') }}>Add New Voucher</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('importpage') }}>Import Vouchers</a>
                        </li>   
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('vouchers.updateOrder') }}>Change Voucher Order</a>
                        </li>   
                    @endif
                    </ul>
                
                    <!-- <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form> -->
                    @if (\Request::is('register'))  
                    @else
                    @if (Auth::check())
                        <a style="color:white;text-decoration:none;" href={{ route('logout') }}> Logout</a>
                    @else
                        <!-- DROPDOWN START -->
                        <div class="dropdown {{ !$errors->isEmpty() ? 'show' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded={{ !$errors->isEmpty() ? 'true' : 'false' }}><b>Login</b> <span class="caret"></span></a>
                        <div class="dropdown-menu dropdown-menu-right login-dp {{ !$errors->isEmpty() ? 'show' : '' }}">
        			
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('login') }}">
                                    @csrf
            
                                    <div class="form-group">
                                        <label for="email" class="sr-only">{{ __('Email') }}</label>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                    </div>
            
                                    <div class="form-group">
                                        <label for="password" class="sr-only">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                        <!--<div class="help-block text-right">
                                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                                        </div>-->
                                    </div>
            
                                    <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Login
                                            </button>            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group justify-content-right">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Keep Me Logged In
                                            </label>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
							<div class="bottom text-center">
								New User? <a href={{ route('register') }}><b>Register</b></a>
							</div>
    					    </div>
                        </div>
                        <!-- END DROPDOWN -->
                    @endif
                    @endif
                </div>
            </nav>
            
            <div id="fb-root"></div>
            <!-- FACEBOOK LIKE
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1&appId=1627780490810324&autoLogAppEvents=1';
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <div class="fb-like" data-href="https://www.facebook.com/GoldCoastDiscounts" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            -->
            <div class="row">
            <div class="col">
            </div>
            <div class="col-10">
            
            @yield('content')
            </div>
            <div class="col">
            </div>
            </div>
        </div>

        <footer class="page-footer font-small pt-4 greencode" style="padding-top:0px!important;">
            <div class="container navbar navbar-fixed-bottom" style="margin-bottom:0px;">
                <div class="row justify-content-center center-text" style="width:100%">
                    <div class="col-md-4 footer-cols">
                        <h4>Information</h4>
                        <ul class="footer-link-list">
                            <li>
                                <a class="footer-link" href="2019 FULL YEAR Advertising Prices.pdf" >Advertise with Us</a>
                            </li>
                            <li>
                                <a class="footer-link" href={{ route('policy') }}>Privacy Policy</a>
                            </li>
                            <li>
                                <a class="footer-link" href={{ route('terms') }}>Terms and Conditions</a>
                            </li>
                        </ul>                                         
                        
                    </div>
                    <div class="col-md-3 footer-cols">
                        <h4>Follow Us</h4>
                        <a class="icons" href='https://www.facebook.com/GoldCoastDiscounts/'>
                            <img class="app-badge" alt='Facebook' src="facebook_icon_circle.png"></img>
                        </a>
                        <a class="icons" href='https://twitter.com/DiscountsGold'>
                            <img class="app-badge" alt='Twitter' src="twitter_icon_circle.png"></img>
                        </a>
                        <a class="icons" href='https://www.instagram.com/gold_coast_discounts/'>
                            <img class="app-badge" alt='Instagram' src="instagram_icon_red.png"></img>
                        </a>
                    </div>
                    
                </div>
            </div>
                    
            <div class="footer-copyright text-center py-3">
                © 2018 Copyright - GoldCoastDiscounts.com.au - All Rights Reserved.
            </div>
        </footer>       
        
    </body>
</html>