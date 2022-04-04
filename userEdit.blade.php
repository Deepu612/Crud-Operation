 @extends('admin.layouts.adminLayout')
@section('title',"Edit User")
@section('content')

 
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>Edit User Details
                    </div>
                </div>
            </div>
        </div>            
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                 <form action="{{url('user/edit/'.base64_encode($user_edit['id']))}}" method="post" id="editUser" enctype="multipart/form-data">
                     @csrf
                    <div class="card-body">
                       <input type="hidden" name="id" class="hidden_id" value="{{$user_edit['id']}}">
                    
                        <div class="detail_frm">
                                  <div class="prflimg_wrp text-center mb-5">
                                    @if($user_edit['profile_image']!==null)    
                                     <div class="usrprfl_img">
                                        <img src="{{url(adminImage.'/'.$user_edit['profile_image'])}}" class="img-fluid user-img">
                                                <div class="upldimg_icn">
                                                    <i class="fa fa-upload"></i>
                                                    <input type="file" class="inpt_fl" name="profile_image" value="">
                                                </div>
                                        </div>
                                    @else 

                                     <div class="usrprfl_img">
                                            <img src="https://crimzonworld.com/wp-content/uploads/2016/08/dummy-prod-1.jpg" class="img-fluid user-img">
                                            <div class="upldimg_icn">
                                                <i class="fa fa-upload"></i>
                                                <input type="file" class="inpt_fl" name="profile_image" value="" r>
                                            </div>
                                    </div>
                                    @endif   
                                    <div>
                                      <label id="profile_image-error" class="error" for="profile_image"></label>
                                    </div> 
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="">Name</label>
                                            <input placeholder="Enter Name" name="name"  type="text" class="form-control" value="{{$user_edit['name']}}" ">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="">Phone Number</label>
                                            <div class="row">
                                              <div class="col-sm-2 pr-0">
                                                <input type="tel" class="form-control" name="country_code" id="telephone" value="{{$user_edit['country_code']}}">
                                              </div>
                                              <div class="col-sm-10">
                                                <input name="phone_no" placeholder="Enter Phone Number" type="text" class="form-control" value="{{$user_edit['phone_no']}}" >
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="">Email</label>
                                            <input name="email" placeholder="Enter Email" type="text" class="form-control" value="{{$user_edit['email']}}" >
                                        </div>
                                    </div>
                                </div>
                                    <div class="text-center">
                                         <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                
                          
                        </div>
                        
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {

         $('.user-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $(".inpt_fl").change(function() {
      readURL(this);
    });
</script>
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

<script type="text/javascript">
    
      jQuery.validator.addMethod("emailfull", function(value, element) {
 return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
}, "Please enter valid email address!");
   jQuery.validator.addMethod("lettersonly", function(value, element) 
      {
      return this.optional(element) || /^[a-z ]+$/i.test(value);
      }, "Name should contain letters only");
      jQuery.validator.addMethod("noSpace", function(value, element) { 
        return value == '' || value.trim().length != 0;  
      }, "Please enter a valid value")
    $(document).ready(function() {
    $('#editUser').validate({
      rules: {
          
        'profile_image':{
            extension: "jpg|jpeg|png|webp",
            //required:true,
          
        },
        'name':{
          required:true,
         // minlength: 03,
          maxlength:20,
          noSpace:true,
           lettersonly: true,
          
        },
        
        'phone_no':{
          required:true,
          number:true,
          minlength: 07,
          maxlength:15,
           remote: {
                        url: "{{ url('validateEditphone_no')}}",
                        data: {
                          id: function(){
                            return $('.hidden_id').val();
                          }
                        }
                      },  
          
        },
         'email':{
         required:true,
         emailfull: true,
         remote: {
                        url: "{{ url('validateEditEmail')}}",
                        data: {
                          id: function(){
                            return $('.hidden_id').val();
                          }
                        }
                      },  
          },
          
          
      },
      messages: {
        'name':{
          required:"Please Enter Name!",
         // minlength: "Minimum length should be 05 !",
          maxlength: "Maximum length should be 20 character!",
          //lettersonly:"Please Name should contain be character only",
         // number:"Name should contain letters only",
          
        },
        'profile_image':{
            extension:"Profile image should be in valid format",
            //required:"Please upload user profile image",
        },
        'phone_no':{
            required:"Please Enter Phone No!",
          minlength: "Minimum length should be 07 numbers!",
          maxlength: "Maximum length should be 15 numbers!",
          number: "Please enter valid number!",
          remote: "Phone no already exists",
          
        },
        'email':{
            required:"Please Enter Email!",
          email: "Enter a valid email!",
          remote: "Email ID already exists",
          
        },
        
        
      },submitHandler: function(form) {
              form.submit();
        }
    });


  });


    </script>
@stop           