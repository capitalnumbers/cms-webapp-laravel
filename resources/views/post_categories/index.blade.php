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
            <h2>Post Categories <small>List</small></h2>
            <ul class="nav navbar-right panel_toolbox">
             <li><a href="{{url('administrator/post-category/create')}}" style="background-color:green; color:#fff" ><i class="fa fa-plus" aria-hidden="true"></i>Add new</a></li>
            </ul>                    
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
				<tr>
				  <th>Name</th>
				  <th>Created Date</th>
				  <th text-align:center" >Action</th>
				</tr>
				</thead>
			  	<tbody>
			  	@foreach ($categories as $category)
			  		<tr>
			  			<td>{{$category->name or ''}}</td>
			  			<td>{{$category->created_at or ''}}</td>
			  			<td class="action">
			  				
			  				<a class="btn btn-app edit" href="{{url('administrator/post-category/edit/'.$category->id)}}"><i class="fa fa-edit"></i>Edit</a>
	                        <a class="btn btn-app delete" href="{{url('administrator/post-category/delete/')}}" del_id="{{$category->id}}"><input type="hidden" name="_token" value="{{csrf_token()}}"><i class="fa fa-trash-o"></i>Delete</a>
			  			</td>
			  		</tr>
			  		@foreach($category->children as $sub_category)
			  		<tr>
			  			<td>--{{$sub_category->name or ''}}</td>
			  			<td>{{$sub_category->created_at or ''}}</td>
			  			<td class="action">
			  				
			  				<a class="btn btn-app edit" href="{{url('administrator/post-category/edit/'.$sub_category->id)}}"><i class="fa fa-edit"></i>Edit</a>
	                        <a class="btn btn-app delete" href="{{url('administrator/post-category/delete/')}}" del_id="{{$sub_category->id}}"><input type="hidden" name="_token" value="{{csrf_token()}}"><i class="fa fa-trash-o"></i>Delete</a>
			  			</td>
			  		</tr>
				  		@foreach($sub_category->children as $child_category)
				  		<tr>
				  			<td>----{{$child_category->name or ''}}</td>
				  			<td>{{$child_category->created_at or ''}}</td>
				  			<td class="action">
				  				
				  				<a class="btn btn-app edit" href="{{url('administrator/post-category/edit/'.$child_category->id)}}"><i class="fa fa-edit"></i>Edit</a>
		                        <a class="btn btn-app delete" href="{{url('administrator/post-category/delete/')}}" del_id="{{$child_category->id}}"><input type="hidden" name="_token" value="{{csrf_token()}}"><i class="fa fa-trash-o"></i>Delete</a>
				  			</td>
				  		</tr>
				  		@endforeach
			  		@endforeach
			  	@endforeach
				</tbody>
        	</table>
      </div>
      <!-- ********************* Pagination ***************************** -->
    </div>

  </div>

</div>
</div>
<script src="{{{ url('assets/js/jquery.dataTables.min.js') }}}"></script>
<script type="text/javascript">
 jQuery(document).ready(function(){
    $('#datatable').dataTable({"ordering": false, "aoColumns":[{},{},{'width':'22%'}]});
    $(".b_status").click(function(){

    	var t=$(this);
    	var id=$(this).attr('location_id');
    	var status=($(this).find('.acitvate').length)?'No':'Yes';
    	$.ajax({
   
			url: '{{url("administrator/post-category/change-status")}}',
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

 