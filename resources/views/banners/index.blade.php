@extends('layouts.admin')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="clearfix"></div>
    @if(Session::has('success'))
		<div class="alert alert-success">
		  <strong>Success!</strong> {{ Session::get('success') }}
		</div>
	@endif
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Banners <small>List</small></h2>
            <ul class="nav navbar-right panel_toolbox">
             <li><a href="{{url('administrator/banner/create')}}" style="background-color:green; color:#fff" ><i class="fa fa-plus" aria-hidden="true"></i>Add new</a></li>
            </ul>                    
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
				<tr>
				  <th>Title</th>
				  <th>Description</th>
				  <th>Image</th>
				  <th text-align:center" >Action</th>
				</tr>
				</thead>
			  	<tbody>
			  	@foreach ($banners as $banner)
			  		<tr>
			  			<td>{{$banner->title}}</td>
			  			<td>{{$banner->description}}</td>
			  			<td>{{$banner->image}}</td>
			  			
			  			<td class="action">
			  				<a class="btn btn-app edit b_status"  title="status" classification_id="{{$banner->id}}">
			  					@if($banner->active=='No') <i class="fa fa-edit fa-thumbs-o-down inactivate"></i>Inactive
			  					@else <i class="fa fa-thumbs-o-up acitvate"></i>Active
			  					@endif
			  				</a>
			  				<a class="btn btn-app edit" href="{{url('administrator/banner/edit/'.$banner->id)}}"><i class="fa fa-edit"></i>Edit</a>
	                        <a class="btn btn-app delete" href="{{url('administrator/banner/delete/')}}" del_id="{{$banner->id}}"><input type="hidden" name="_token" value="{{csrf_token()}}"><i class="fa fa-trash-o"></i>Delete</a>
			  			</td>
			  		</tr>
			  	@endforeach
				</tbody>
        	</table>
      </div>
      <!-- ********************* Pagination ***************************** -->
    </div>

  </div>

</div>
</div>
<script src="{{{ url('assets/js/jquery.dataTables.min.js')}}}"></script>
<script type="text/javascript">
 jQuery(document).ready(function(){
    $('#datatable').dataTable({"sPaginationType": "full_numbers", "bStateSave": true, "ordering": false, "aoColumns":[{},{},{},{'width':'22%'}]});
    $(".b_status").click(function(){

    	var t=$(this);
    	var id=$(this).attr('classification_id');
    	var status=($(this).find('.acitvate').length)?'No':'Yes';
    	$.ajax({
   
			url: '{{url("administrator/post/change-status")}}',
			type:'post',
			data:{_token:'{{csrf_token()}}', id: id, active: status},
			success:function(data){

				if(data){
					if(status=='No'){

						$(t).html('<i class="fa fa-edit fa-thumbs-o-down inactivate" ></i>Inactive');
					}else{

						$(t).html('<i class="fa fa-thumbs-o-up acitvate"></i>Active');
					}	
				}
			}
		});
    })
  })
</script>
@stop

 