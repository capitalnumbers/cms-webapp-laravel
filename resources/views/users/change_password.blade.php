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
					{{ Form::open(['url' => 'user/save-password', 'class'=>'form-horizontal form-label-left']) }}
					{{ Form::hidden('id', $user->_id) }}
					<div class="item form-group">
						
						{{Form::label('old_password', 'Old Password*', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::password('old_password',  ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="item form-group">
						
						{{Form::label('new_password', 'New Password *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::password('new_password',  ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					
					<div class="item form-group">
						
						{{Form::label('confirm_password', 'Confirm Password *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::password('confirm_password', ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="generate_password">Generate Password</label>
						<div class="col-md-5 col-sm-5 col-xs-12">
							<div class="form-control col-md-5 col-sm-5 col-xs-12" ><span id="generated_password"></span><i class="fa fa-retweet" style="float:right; cursor:pointer" id="generate_passowrd"></i></div>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button type="button" onclick="window.location='{{url('user/change_password')}}'" class="btn btn-primary">Cancel</button>
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

	$("#generate_passowrd").click(function(){
		$.ajax({
		  	url: "{{url('get-code/10/1')}}",
		  	success:function(data){
		  		$("#generated_password").html(data);
		  	}
		})
	})

	$('form').submit(function(e) {
        e.preventDefault();

        $('.item').removeClass('bad');
        $(".alert").remove();
        var submit = true;
        var old_password=$('#old_password').val();
        var new_password=$('#new_password').val();
        var confirm_password=$('#confirm_password').val();
        if(old_password==''){
        	$("#old_password").closest('.item').addClass('bad');
			$("#old_password").parent().after('<div class="alert">Please enter old password</div>');
			submit=false;
		}
		if(new_password==''){
        	$("#new_password").closest('.item').addClass('bad');
			$("#new_password").parent().after('<div class="alert">Please enter new password</div>');
			submit=false;
		}
		if(new_password!=confirm_password){
			$("#confirm_password").closest('.item').addClass('bad');
			$("#confirm_password").parent().after('<div class="alert">Invalid Confirm password</div>');
			submit=false;
		}
        if (submit)
          this.submit();

        return false;
    });
})
</script>
@stop