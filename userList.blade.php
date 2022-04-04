@extends('admin.layouts.adminLayout')
@section('title',"User List")
@section('content')

     <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>Users Management
                     
                    </div>
                </div>
                <div class="page-title-actions">
                    <div class="add_bttn">
                        <a href="{{url('add/user')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Add User</a>
                    </div>
                </div>
            </div>
        </div>            
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <table id="example" class="lstng_tbl table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Phone number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(!empty($user_list))
                                    @foreach($user_list as $key=>$list)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$list['id']}}</td>
                                        <td>{{$list['name']}}</td>
                                        <td>{{$list['country_code']}} {{$list['phone_no']}}</td>
                                        <td>


                                            <label class="switch"><input data-id="{{$list['id']}}" type="checkbox" class="new_check" data-toggle="toggle" {{ $list['status'] == 'active' ? 'checked' : '' }}><span class="slider round"></span></label>

                                       <!--      @if($list['status'] == 'active')
                                            <label class="switch"><input data-id="{{$list['id']}}" type="checkbox" class="new_check " data-style="ios"  checked="" data-toggle="toggle"  ><span class="slider round"></span></label>


                                          <div  class="switch"><input type="checkbox"><span class="slider round"></span>{{$list['id']}}</div></td>


                                         @elseif($list['status'] == 'inactive')
                                         <label class="switch"><input data-id="{{$list['id']}}" type="checkbox" class="new_check " data-style="ios"   data-toggle="toggle"  ><span class="slider round"></span></label>
                                          @endif  -->
                                        <td>
                                            <div class="actn_bttns">
                                                <a href="{{url('user/view/'.base64_encode($list['id']))}}">
                                                    <span class="actn_icn">
                                                    	<i class="fa fa-eye"></i>
                                                    </span>
                                                </a>
                                                <a href="{{url('user/edit/'.base64_encode($list['id']))}}">
                                                    <span class="actn_icn">
                                                    	<i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                 <a href="#" data-toggle="modal" data-target="#dlt-usr{{$list['id']}}">
                                                    <span class="actn_icn">
                                                      <i class="fa fa-trash"></i>
                                                       </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                 <h4 class="text-center">No Record</h4>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
  @foreach($user_list as $key=>$list)
  <form action="{{url('user/delete/'.base64_encode($list['id']))}}" method="post">
    @csrf
  <div class="modal fade" id="dlt-usr{{$list['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete the selected user's account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
   </div>
</form>
@endforeach

  @section('scripts')

<script type="text/javascript">

    $(document).ready(function(){
        $('.new_check').on('click', function(){
        var attribute = this.getAttribute("data-id");
        //alert(attribute);
       var attribute = this.getAttribute("data-id");
       // alert(attribute);
        
            //alert('Status changed');
            var admin_verifications = $(this).prop('checked') == true ? 'active' : 'inactive';
           //alert(admin_verifications);
           $.ajax({
               url: "{{url('/user/statusChange')}}",
               type: "POST",
               dataType: "json",
               data: {
                   'status': admin_verifications,
                   'id': attribute,
                   "_token": "{{ csrf_token() }}",
               },
              // alert(data);
               success: function(response) {
                    if(response.success == true){
                        //alert(response);
                        toastr.success(response.message);
                    }
                },
            });
        
    });
    })
    
   
</script>

  @stop                  