<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Models\Admin;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function userList(Request $request)
    {
		$page = "User Management";
		$user_list = User::where('user_type','user')
									->orderBy('id','desc')
									->get()
									->toArray();
		return view('admin.userManagement.userList',compact('page','user_list'));						
    	
    }
    
    public function userEdit(Request $request,$id)
    { 
        $page = "User Edit";
       
      $user_edit = User::where('id',base64_decode($id))->first();
        if($request->isMethod('post')){
            
                if($request->hasfile('profile_image')){

             
                      //dd($id);
                         $image  = $request->file('profile_image');
                         $profile_image = time().'_'.rand().'.'.$image->getClientOriginalExtension();
                         //dd($header_image);
                         $destinationPath = adminImage;
                                 // dd($destination_path);
                         $image->move($destinationPath,$profile_image);
                         
                         $update1= User::where('id',base64_decode($id))->update(['profile_image'=>$profile_image]);
              }    

           
                    $update=User::where('id',base64_decode($id))->update([
                        //'profile_image'=>$profile_image,
                          'name' => $request['name'],
                       'phone_no'=>$request['phone_no'],
                        'email'=>$request['email'],
                        'country_code'=>$request['country_code'],

             ]);
                return redirect('user/list')->with('success','User Data Updated Successfully');

        }

        return view('admin.userManagement.userEdit',compact('page','user_edit'));
   
    }


    public function userDelete(Request $request,$id)
    {
        $userDelete= User::where('id',base64_decode($id))->first();
        //dd($userDelete);
        $userDelete->delete();
         return redirect('user/list')->with('success','User Data Deleted Successfully');


        
    }
    public function userView(Request $request,$id)
    {   
    	$page = "View User";
    	$detail = User::where('id',base64_decode($id))->first(); 
    	return view('admin.userManagement.userView',compact('page','detail'));						   	

    }
    public function addUser(Request $request)
    {
    	$page = "Add User";
    	if($request->isMethod('post')){
    		// dd($request->all());
	    	$user = new User();
	    	$pass = rand(100000,900000);
	    	$user->name = $request['name'];
	    	$user->email = $request['email'];
        $user->country_code=$request['country_code'];
	    	$user->phone_no = $request['phone_no'];
	    	$hash_password = Hash::make($pass);
	        $password = str_replace("$2y$","$2b$",$hash_password);
	            // dd($password);
	    	$user->password = $password;
	    	$user->decoded_password = $pass;
        $user->user_type = "user";

                // dd($request->all());
	    	if($request->hasfile('profile_image')){

                $random = rand(100000,999999);
                $image  = $request->file('profile_image');
                    
                $name = time().'r'.$random.'.'.$image->getClientOriginalExtension();
                $destinationPath = adminImage;
                $image->move($destinationPath, $name);
                $user->profile_image = $name; 
                //dd($user);

            }
	    	if($user->save()){
	    		$email = $request->email;
          $country_code=$request->country_code;
                $phone_no=$request->phone_no;
	            $message_data = [
	                            'email'=>$email,
	                            //'password'=>$pass,
                                'country_code'=>$country_code,
	                              'phone_no'=>$phone_no,           
	                        ];
	            $subject="Login Credentials";        
	            $email_send =  Mail::send('admin.email.credentials', $message_data, function($message) use ($email,$subject){
	                                        $message->to($email)->subject($subject);
	                    });

	    	}
	    	Session::flash('success','User Added Successfully and Credentials sent on registered email');
	    	return redirect('user/list');

    	}
    	return view('admin.userManagement.addUser',compact('page'));

    }

    public function statusChange(Request $request){

       if($request->isMethod('post')){
 
          $user=User::where('id',$request->id)->update(["status"=>$request->status]);
            // dd($user);
            
                return response()->json([
                  'success'=>true,
                  'message'=>'Status change successfully.']);
              }
      
       }
    

     public function validateEmail(Request $request){
        $data = $request->all();
        if(User::where('email',$data['email'])->where('user_type','user')->exists()){
            return 'false';
        }
        else {
            return 'true';
        }
       }

       public function validatePhone_no(Request $request){
        $data = $request->all();
       // dd($data);
        if(User::where('phone_no',$data['phone_no'])->where('user_type','user')->exists()){
            return 'false';
        }
        else {
            return 'true';
        }
       }
       
        public function validateEditEmail(Request $request) {
            $data = $request->all();

            //dd($data);
            if(User::where([['id','!=',$data['id']],['email','=',$data['email']]])->exists()) {
                return 'false';
            }
            else {
                return 'true';
            }
        }



        public function validateEditphone_no(Request $request) {
            $data = $request->all();
            // dd($data);
            if(User::where([['id','!=',$data['id']],['phone_no','=',$data['phone_no']]])->exists()) {
                return 'false';
            }
            else {
                return 'true';
            }

        }
}