@extends('layouts.admin')

@section('content')

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
            <h2>Users List <small>List</small></h2>
            <ul class="nav navbar-right panel_toolbox">
             <li><a href="{{url('administrator/user/create')}}" style="background-color:green; color:#fff" ><i class="fa fa-plus" aria-hidden="true"></i>Add new</a></li>
            </ul>                    
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th text-align:center" >Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td class="action">
                            <a class="btn btn-app edit b_block"  title="status" user_id="{{$user->id}}">
                              @if($user->block=='Yes') <i class="fa fa-ban blocked" ></i>Blocked
                              @else <i class="fa fa-check-circle-o unblocked" ></i>Unblocked
                              @endif
                            </a>
                            <a class="btn btn-app edit b_status"  title="status" validity_id="{{$user->id}}">
                              @if($user->active=='Yes') <i class="fa fa-thumbs-o-up acitvate"></i>Active
                              @else <i class="fa fa-edit fa-thumbs-o-down inactivate"></i>Inactive
                              @endif
                            </a>
                            @if($user->role!='admin')
                            <a class="btn btn-app edit" href="{{url('administrator/user/edit/'.$user->id)}}"><i class="fa fa-edit"></i>Edit</a>
                            <a class="btn btn-app delete" href="{{url('administrator/user/delete')}}" del_id="{{$user->id}}"><input type="hidden" name="_token" value="{{csrf_token()}}"><i class="fa fa-trash-o"></i>Delete</a>
                            @endif
                            
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
<script src="{{{ url('assets/js/jquery.dataTables.min.js') }}}"></script>
<script type="text/javascript">
 jQuery(document).ready(function(){
    $('#datatable').dataTable({"sPaginationType": "full_numbers", "bStateSave": true,"ordering": false, "aoColumns":[{},{},{},{'width':'29%'}]});
    $('.alert').fadeOut(7000);
    $(".b_status").click(function(){

      var t=$(this);
      var id=$(this).attr('validity_id');
      var status=($(this).find('.acitvate').length)?'No':'Yes';
      $.ajax({
   
      url: '{{url("administrator/user/change-status")}}',
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

//block merchant
    $(".b_block").click(function(){

      var t=$(this);
      var id=$(this).attr('user_id');
      var block=($(this).find('.blocked').length)?'No':'Yes';
      $.ajax({
   
      url: '{{url("administrator/user/block-unblock")}}',
      type:'post',
      data:{_token:'{{csrf_token()}}', id: id, block: block},
      success:function(data){

        if(data){
          if(block=='No'){

            $(t).html('<i class="fa fa-check-circle-o unblocked" ></i>Unblocked');
          }else{

            $(t).html('<i class="fa fa-ban blocked" ></i>Blocked');
          } 
        }
      }
    });
    })
  })
</script>
@stop