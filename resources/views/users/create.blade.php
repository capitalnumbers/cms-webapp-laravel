@extends('layouts.admin')
@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
	    @if(Session::has('error'))
		    <div class="alert alert-danger">
		      <strong>Error!</strong> {{ Session::get('error') }}
		    </div>
	    @endif
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
				<h2>Create New Validity</h2>
				
				<div class="clearfix"></div>
				</div>
				<div class="x_content">
					{{ Form::open(['url' => 'administrator/user/save', 'class'=>'form-horizontal form-label-left']) }}
					<div class="item form-group">
                        {{Form::label('name', 'Name *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            {{Form::text('name', null, ['class'=>'form-control col-md-7 col-xs-12'])}}
                        </div>  
                    </div>
                    <div class="item form-group">
						{{Form::label('email', 'Email *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::text('email', null, ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div> 
					<div class="item form-group">
						{{Form::label('password', 'Password *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::password('password', ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="item form-group">
						{{Form::label('confirm_password', 'Confirm Password *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::password('confirm_password', ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button type="button" onclick="window.location='{{url('administrator/users')}}'" class="btn btn-primary">Cancel</button>
							<button id="send" type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

	$('form').submit(function(e) {
        e.preventDefault();

        $('.item').removeClass('bad');
        $(".alert").remove();
        var submit = true;
        var name=$('#name').val();
        var email=$("#email").val();
        var password= $("#password").val();
        var confirmPassword=$("#confirm_password").val();

        if(name==''){
        	$("#name").closest('.item').addClass('bad');
			$("#name").parent().after('<div class="alert">Please enter name</div>');
			submit=false;
		}
		if((name!='' && !name.match(/^[a-zA-Z ]*$/)) ||(name!='' && name.length >=100)){
	        $("#first_name").closest('.item').addClass('bad');
	        $("#first_name").parent().after('<div class="alert">Enter a valid name </div>');
	        submit=false;
	    }
		if(email==''){
            $("#email").closest('.item').addClass('bad');
            $("#email").parent().after('<div class="alert">Please enter email </div>');
            submit=false;
        }
        if(email!='' && !email.match(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i)){
            $("#email").closest('.item').addClass('bad');
            $("#email").parent().after('<div class="alert">Enter a valid email </div>');
            submit=false;
        }
        if(password==''){
            $("#password").closest('.item').addClass('bad');
            $("#password").parent().after('<div class="alert">Please enter password </div>');
            submit=false;
        }
        if(password!='' && password.length<6){
            $("#password").closest('.item').addClass('bad');
            $("#password").parent().after('<div class="alert">Password too small</div>');
            submit=false;
        }
        if(password!=confirmPassword){
            $("#confirm_password").closest('.item').addClass('bad');
            $("#confirm_password").parent().after('<div class="alert">Wrong confirm password </div>');
            submit=false;
        }

		
        if (submit)
          this.submit();

        return false;
    });
})
</script>
@stop