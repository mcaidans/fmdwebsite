@extends('master')

@section('content')


<div class="row">
    <div class="col">        
    </div>
    
    
    
    <div class="col-xs-12 col-sm-10 col-lg-6">
        <h2>Contact Us</h2>
        <div class="call-box center-text">
            <h3>Looking to join our customer network? Give us a call on <span style="color:blue;">0425 638 428</span> </h3>
        </div>
    <br>
    <h3 style="text-align: center;">Or</h3><br>
        <div class="form-area">  
            <form role="form">
                
				<div class="form-group">
					<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="email" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
				</div>
                <div class="form-group">
                <textarea class="form-control" type="textarea" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>
                    <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>                    
                </div>
                <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
            </form>
        </div>
    </div>
    
    <div class="col">
    </div>
</div>
@stop