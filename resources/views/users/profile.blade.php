@extends('layouts.admin')
@section('content')
<div class="right_col" role="main">
    <div class="clearfix"></div>
    	@if(Session::has('success'))
	        <div class="alert alert-success">
	          <strong>Success!</strong> {{ Session::get('success') }}
	        </div>
	    @endif
	    @if(Session::has('error'))
		    <div class="alert alert-danger">
		      <strong>Error!</strong> {{ Session::get('error') }}
		    </div>
	    @endif
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
				<h2>Edit Brand</h2>
				
				<div class="clearfix"></div>
				</div>
				<div class="x_content">
					{{ Form::open(['url' => 'user/update-profile', 'class'=>'form-horizontal form-label-left']) }}
					{{ Form::hidden('id', $user->_id) }}
					<div class="item form-group">
						
						{{Form::label('name', 'Name *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::text('name', $user->name, ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="item form-group">
						
						{{Form::label('email', 'Email *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::text('email', $user->email, ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="item form-group">
						
						{{Form::label('phone', 'Phone number *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::text('phone', $user->phone, ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button type="button" onclick="window.location='{{url('user/profile')}}'" class="btn btn-primary">Cancel</button>
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
        var email=$('#email').val();
        var phone=$('#phone').val();
        var role=$('#role').val();
        if(name==''){
        	$("#name").closest('.item').addClass('bad');
			$("#name").parent().after('<div class="alert">Please enter name</div>');
			submit=false;
		}
		if(name!='' && !name.match(/^[a-zA-Z ]*$/)){
			$("#name").closest('.item').addClass('bad');
			$("#name").parent().after('<div class="alert">Please enter a valid name</div>');
			submit=false;
		}
		if(email==''){
        	$("#email").closest('.item').addClass('bad');
			$("#email").parent().after('<div class="alert">Please enter email</div>');
			submit=false;
		}
		if(email!='' && !email.match(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i)){
			$("#email").closest('.item').addClass('bad');
			$("#email").parent().after('<div class="alert">Please enter a valid email</div>');
			submit=false;
		}
		if(phone==''){
        	$("#phone").closest('.item').addClass('bad');
			$("#phone").parent().after('<div class="alert">Please enter phone number</div>');
			submit=false;
		}
		if(phone!='' && !phone.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/)){
			$("#phone").closest('.item').addClass('bad');
			$("#phone").parent().after('<div class="alert">Please enter a valid phone number</div>');
			submit=false;
		}
        if (submit)
          this.submit();

        return false;
    });
})
</script>
@stop