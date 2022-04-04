 @extends('admin.layouts.adminLayout')
@section('title',"User View")
@section('content')      
      <div class="app-main__inner">
                            <div class="app-page-title">
                                <div class="page-title-wrapper">
                                    <div class="page-title-heading">
                                        <div class="page-title-icon">
                                            <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                                            </i>
                                        </div>
                                        <div> View User Details
                                        </div>
                                    </div>
                                </div>
                            </div>            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <!-- <h5 class="card-title">Grid Rows</h5> -->
                                            <div class="detail_frm">
                                                <div class="prflimg_wrp text-center mb-5">
                                                    <div class="usrprfl_img">
                                                        <img src="{{url(adminImage.'/'.$detail['profile_image'])}}" class="img-fluid">
                                                        <!-- div class="upldimg_icn">
                                                            <i class="fa fa-upload"></i>
                                                            <input type="file" class="inpt_fl">
                                                        </div> -->
                                                    </div>
                                                </div>
                                                
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="">Name</label>
                                                                <input placeholder="Enter Name" type="text" class="form-control" value="{{$detail['name']}}" disabled="disabled">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="">Phone Number</label>
                                                                <div class="row">
                                                                  <div class="col-sm-2 pr-0">
                                                                    <input type="tel" class="form-control" name="country_code" id="telephone" value="{{$detail['country_code']}}" readonly="" disabled="disabled">
                                                                  </div>
                                                                  <div class="col-sm-10">
                                                                    <input name="phone_no" placeholder="Enter Phone Number" type="text" class="form-control" value="{{$detail['phone_no']}}" readonly="" disabled="disabled">
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                                     <div class="form-row justify-content-center">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="">Email</label>
                                                                <input name="email" placeholder="Enter Phone Number" type="text" class="form-control" value="{{$detail['email']}}" disabled="disabled">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dtlactn_btn text-right">
                                                        <button onclick="history.back()" class="mt-2 btn btn-primary btn-lg">Back</button>
                                                    </div>
                                                    
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
     </div>
@stop
@section('scripts')
<script>
  $(document).ready(function(){

          $("#telephone").intlTelInput({
            allowExtensions: true,
            autoFormat: false,
            autoHideDialCode: false,
            autoPlaceholder: false,
            defaultCountry: "auto",
            ipinfoToken: "yolo",
            nationalMode: false,
            numberType: "MOBILE",
          });
      });
 </script>

@stop 
