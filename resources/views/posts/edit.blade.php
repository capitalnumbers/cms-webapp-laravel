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
				<h2>Edit Country</h2>
				
				<div class="clearfix"></div>
				</div>
				<div class="x_content">
					{{ Form::open(['url' => 'country/save', 'class'=>'form-horizontal form-label-left']) }}
					{{ Form::hidden('id', $country->id) }}
					<div class="item form-group">
						{{Form::label('name', 'Country Name *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::text('name', $country->name, ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button type="button" onclick="window.location='{{url('countries')}}'" class="btn btn-primary">Cancel</button>
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
        if(name==''){
        	$("#name").closest('.item').addClass('bad');
			$("#name").parent().after('<div class="alert">Please enter country name</div>');
			submit=false;
		}
		if(name!='' && !name.match(/^[a-zA-Z ]*$/)){
			$("#name").closest('.item').addClass('bad');
			$("#name").parent().after('<div class="alert">Please enter a valid name</div>');
			submit=false;
		}
        if (submit)
          this.submit();

        return false;
    });
})
</script>
@stop