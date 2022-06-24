<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller
{
public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            //$success['token'] =  $user->createToken('Dishtansya')-> accessToken;
            $access_token =  $user->createToken('Dishtansya')-> accessToken;
            
            return response()->json(['access_token' => $access_token], 201); 
            //return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['message' => "Invalid credentials"], 401); 
        } 
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input               = $request->all(); 
        $input['password']   = bcrypt($input['password']);
        $users               = User::where('email', '=', $request->input('email'))->first();
        $response            = array();
        $response['message'] = "Registration error";
        $code                = 400;

        if ($users === null) {
            // User does not exist
            $user = User::create($input); 
            $success['token'] =  $user->createToken('Dishtansya')-> accessToken; 
            $success['name'] =  $user->name;
            $response['message'] = "User successfully registered";
            $code = 201;
        } else {
            // email already taken
            $response['message'] = "Email already taken";
            $code = 400;
        }


        return response()->json($response, $code); 
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}
