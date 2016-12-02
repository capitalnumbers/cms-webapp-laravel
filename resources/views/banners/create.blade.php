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
				<h2>Create New Banner</h2>
				
				<div class="clearfix"></div>
				</div>
				<div class="x_content">
					{{ Form::open(['url' => 'administrator/banner/save', 'class'=>'form-horizontal form-label-left', 'files' => true]) }}
					<div class="item form-group">
						{{Form::label('title', 'Title *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::text('title', null, ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="item form-group">
						{{Form::label('description', 'description', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-8 col-sm-5 col-xs-12">
							{{Form::textarea('description', null, ['class'=>'form-control col-md-7 col-xs-12'])}}
						</div>	
					</div>
					<div class="item form-group">						
						{{Form::label('images', 'Image', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}
						<div class="col-md-5 col-sm-5 col-xs-12">
							{{Form::file('images', ['class'=>'', 'accept'=>"image/*"])}}
						</div>	
						<img id="img" alt="" width="90px" />
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button type="button" onclick="window.location='{{url('administrator/banners')}}'" class="btn btn-primary">Cancel</button>
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

/**@------- Load Image Upload Time --------*/
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){

	$("#images").change(function(){
	    readURL(this);
	});

	tinyMCE.init({
	    mode : "textareas",
	    theme : "modern",
	    plugins : "spellchecker,insertdatetime,preview", 
                
        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",      
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
 
	});


	$('form').submit(function(e) {
        e.preventDefault();

        $('.item').removeClass('bad');
        $(".alert").remove();
        var submit = true;
        var title=$('#title').val();
        tinyMCE.triggerSave(false, true);
        var description=$('#description').val();
        if(title==''){
        	$("#title").closest('.item').addClass('bad');
			$("#title").parent().after('<div class="alert">Please enter banner Title</div>');
			submit=false;
		}
		if(title!='' && !title.match(/^[a-zA-Z0-9 ]*$/)){
			$("#title").closest('.item').addClass('bad');
			$("#title").parent().after('<div class="alert">Please enter a valid title</div>');
			submit=false;
		}
		if(description!='' && (description.match(/\&lt;script(.*?)?&gt;/)||description.match(/\<script(.*?)?\>/))){
 			$("#description").closest('.item').addClass('bad');
 			$("#description").parent().after('<div class="alert">Script not allowed</div>');
  			submit=false;
 		}
        if (submit)
          this.submit();

        return false;
    });
})
</script>
@stop