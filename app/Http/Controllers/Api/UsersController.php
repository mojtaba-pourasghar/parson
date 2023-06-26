<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\User;
use App\Wallet;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $users;
    protected $path;

    public function __construct(User $users)
    {
        $this->users = $users;
	$this->path = getConstant('options.upload_path') . '/users';
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verify', 'forget_send_sms', 'verify_forget']]);
        parent::__construct();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $request)
    {
        $success = 0;
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|string|between:2,100',
            // 'mobile' => 'required|max:15|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->json()->all();

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $otp = rand(10000, 99999);

        $user = User::create([
            // 'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => $data['password'],
            'mobile_confirmation' => $otp,
        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        if ($user) {
            $success = 1;
            speedSend($data['mobile'], 43279, array(
                ["Parameter" => "VerificationCode", "ParameterValue" => $otp]
            ));
        }

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'success' => $success,
            'token' => $token
        ], 201);
    }


    public function verify(Request $request)
    {

        $message = '';
        $success = 0;
        $validator = Validator::make($request->all(), [
            'mobile' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = $request->json()->all();
        $token = '';

        $user = $this->users
            ->where([['mobile_confirmation', $data['mobile_confirmation']], ['mobile', $data['mobile']]])
            ->first();

        if (!$user) {
            $success = 0;
            $message = __('user.the_sent_code_not_correct');
        } else {
            $user->mobile_confirmation = null;
            $user->state = 1;
            $success = 1;
            if (!$user->save()) $success = 0;
        }
        return response()->json(['success' => $success, 'message' => $message]);
    }


    public function login(Request $request)
    {
        $message = '';
        $success = 0;
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = $request->json()->all();
        $token = '';
        if (auth()->attempt($validator->validated())) {
            $success = 1;
            $user = auth()->user();
            $token = $user->createToken('token')->accessToken;
            if (!$user->save()) $success = 0;
        }
        return response()->json(['success' => $success, 'message' => $message, 'token' => $token]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' => 1], 200);
        } else {
            return response()->json(['success' => 0, 'message' => 'user.api_something_went_wrong'], 500);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        $ammount = Wallet::getAccountBalance(auth()->user()->id);
        $user = $this->users->select('id', 'name', 'image', 'cover_image', 'mobile', 'email', 'user_name')->where('id', auth()->user()->id)->first();
        return response()->json(['ammount' => $ammount, 'user' => $user]);
    }

    public function changeName(Request $request)
    {

        $message = '';
        $success = 0;
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = $request->json()->all();

        $user = $this->users->select('id', 'name')->where('id', auth()->user()->id)->first();

        if (!$user) {
            $success = 0;
            $message = __('user.cant_find_this_user');
        } else {
            $user->name = $data['name'];
            $success = 1;
            if (!$user->save()) $success = 0;
        }
        return response()->json(['success' => $success, 'message' => $message]);
    }

    public function changeUserName(Request $request)
    {

        $message = '';
        $success = 0;
        $validator = Validator::make($request->all(), [
            'user_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = $request->json()->all();

        $user = $this->users->select('id', 'user_name')->where('id', auth()->user()->id)->first();

        if (!$user) {
            $success = 0;
            $message = __('user.cant_find_this_user');
        } else {
            $user->user_name = $data['user_name'];
            $success = 1;
            if (!$user->save()) $success = 0;
        }
        return response()->json(['success' => $success, 'message' => $message]);
    }

    public function changeEmail(Request $request)
    {

        $message = '';
        $success = 0;

        $data = $request->json()->all();

        $user = $this->users->select('id', 'email')->where('id', auth()->user()->id)->first();

        $validator = Validator::make($request->all(), [
            'email' => 'unique:users,email,' . $user->id
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$user) {
            $success = 0;
            $message = __('user.cant_find_this_user');
        } else {
            $user->email = $data['email'];
            $success = 1;
            if (!$user->save()) $success = 0;
        }
        return response()->json(['success' => $success, 'message' => $message]);
    }

    public function changeMobile(Request $request)
    {
        $message = '';
        $success = 0;
        $validator = Validator::make($request->all(), [
            'mobile' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = $request->json()->all();

        $user = $this->users->select('id', 'mobile')->where('id', auth()->user()->id)->first();

        if (!$user) {
            $success = 0;
            $message = __('user.cant_find_this_user');
        } else {

            $otp = rand(10000, 99999);
            $user->mobile = $data['mobile'];
            $user->mobile_confirmation = $otp;
            $user->state = 0;

            $success = 1;
            if (!$user->save()) $success = 0;
            else {
                speedSend($data['mobile'], 43279, array(
                    ["Parameter" => "VerificationCode", "ParameterValue" => $otp]
                ));
            }
        }
        return response()->json(['success' => $success, 'message' => $message]);
    }

    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = auth()->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array('success' => 0, "status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array('success' => 0, "status" => 400, "message" => __('user.check_your_old_password'), "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array('success' => 0, "status" => 400, "message" => __('user.enter_password_which_is_not_similar_then_current_password'), "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array('success' => 1, "status" => 200, "message" => __('user.password_updated_successfully'), "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array('success' => 0, "status" => 400, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }

    public function forget_send_sms(Request $request)
    {
        $success = 0;
        $validator = Validator::make($request->all(), [
            'mobile' => 'required'
        ]);

        $data = $request->json()->all();

        $user = $this->users
            ->where('mobile', $data['mobile'])
            ->first();

        if (!$user) {
            $success = 0;
            $message = __('user.not_exist_this_mobile');
        }
	$otp = rand(10000, 99999);
	
	$user->mobile_confirmation = $otp;
	$user->save();
	
        
        if ($user) {
            $success = 1;
            speedSend($data['mobile'], 43279, array(
                ["Parameter" => "VerificationCode", "ParameterValue" => $otp]
            ));
        }

        return response()->json([
            'message' => 'User successfully registered',
            'success' => $success,
        ], 201);
    }


    public function verify_forget(Request $request)
    {

        $message = '';
        $success = 0;
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = $request->json()->all();
        $token = '';

        $user = $this->users
            ->where([['mobile_confirmation', $data['mobile_confirmation']], ['mobile', $data['mobile']]])
            ->first();

        if (!$user) {
            $success = 0;
            $message = __('user.the_sent_code_not_correct');
        } else {
            $user->mobile_confirmation = null;
           // $user->password = Hash::make($data['password']);
	   User::where('mobile', $data['mobile'])->update(['password' => Hash::make($data['password']),"mobile_confirmation"=>null]);
            $success = 1;
            //if (!$user->save()) $success = 0;
        }
        return response()->json(['success' => $success, 'message' => $message]);
    }

    public function profileImage(Request $request)
    {
        $message = '';
        $success = 0;
        $user = $this->users->where('id', auth()->id())->first();

	/*$image = $request->file('profileImage');
	$destinationPath = $this->path;
	$name = $request->input('description') .'.'. $image->getClientOriginalExtension();
	$image->move(public_path($destinationPath), $name);*/

            $user_image = '';
            try {
                if ( $request->hasfile('profileImage')) {


                    $image = $this->uploadImage($request->file('profileImage'), $this->path);
                    if ($image['action']) {
                        $user_image = $image['filename'];
                    } else {
			$message = $image['message'];
			$success = 0;
                    }
                    @unlink($this->path . '/' . $user->image);

                } else {
                    $reply = 'File Not Found';
                }
            } catch (Exception $e) {
                $reply = $e;
            }

            try {
                $user->image = $user_image;
                $user->save();
                $success = 1;
            } catch (\QueryException $e) {
                $success = 0;
                if (!empty($image))
                    @unlink($this->path . '/' . $image['filename']);

            }


        return response()->json(['success' => $success, 'message' => $message]);
    }

}
