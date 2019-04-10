@extends('master')

@section('content')

<div class="row">
    <div class="col">        
    </div>
    <style>
        #contactCaptcha > div{
             margin: 0 auto;   
        }
        .contact-submit{
             display: block;
             margin: 10px auto 0px auto;
        }
    </style>
    
    
    <div class="col-xs-12 col-sm-10 col-lg-6">
        <h2 style="text-align:center">Contact Us</h2>
        <div class="call-box center-text">
            <h3>Give us a call on <a href="tel:+61425638428" style="color:blue; display:inline-block;">0425 638 428</a> </h3>
        </div>
    <br>
    <h3 style="text-align: center;">Or</h3><br>
        <div class="form-area">  
            <form method="POST" action="{{ url('contact') }}">
                    {{ csrf_field() }}
				<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="Name" required>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Email" required>
				</div>
				<div class="form-group">
					<input type="phone" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
				</div>
                <div class="form-group">
                <textarea class="form-control" type="textarea" id="message" name="msg" placeholder="Message" maxlength="140" rows="7" required></textarea>                   
                </div>
                <div id="contactCaptcha" class="g-recaptcha" data-sitekey="6LcVJJ0UAAAAAKBxZUBruQYFaVnY8cOa_z_n9cWB">
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary pull-right contact-submit">  
            </form>
            
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    
    <div class="col">
    </div>
</div>

@stop