<?php

namespace App\Http\Controllers\Mobile;

use App\BookCommentLike;
use App\BookShelf;
use App\Follower;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Province;
use App\Shelf;
use App\Traits\UploadFiles;
use App\User;
use App\UserImage;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $users;
    use RegistersUsers;
    use UploadFiles;
    protected $path;

    public function __construct(User $users)
    {
        $this->users = $users;
        $this->path = getConstant('options.upload_path') . '/users';
    }

    public function setting(Request $request)
    {

        return view(currentFrontView('users.setting')/*, compact('user')*/);
    }
    protected function newPasswordValidator(array $data)
    {
        $attributes = [
            'confirm_password' => __('user.confirm_new_password'),
        ];
        $messages = [
            '' => '',
        ];

        $rules = [
            'password' => ['required', 'min:5', 'required_with:password_confirmation'],
            'confirm_password' => ['required', 'min:5'],
        ];

        return Validator::make($data, $rules, $messages, $attributes);
    }
    public function new_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->newPasswordValidator($request->all())->validate();

            $fuser = $this->users->where('mobile', $request->mobile)->first();
            if ($request->confirm_code != $fuser->mobile_confirmation) {
                flash()->error(__('user.your_sended_code_not_correct'));
                return view(currentFrontView('users.new_password'));
            }
            $fuser->password = $request->password;
            $fuser->mobile_confirmation = null;
            $fuser->save();
            flash()->success(__('user.password_updated_successfully'));
            return redirect(route('login'));
        }
        return view(currentFrontView('users.new_password')/*, compact('user')*/);
    }

    public function send_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $fuser = $this->users->where('mobile', $request->mobile)->first();

            if (empty($fuser)) {
                flash()->error(__('user.not_exist_this_mobile'));
                return view(currentFrontView('users.new_password'));
            }
            $otp = rand(10000, 99999);

            $fuser->mobile_confirmation = $otp;
            $fuser->save();

            speedSend($request->mobile, 43279, array(
                ["Parameter" => "VerificationCode", "ParameterValue" => $otp]
            ));
            flash()->success(__('user.code_send_successfully'));
            return redirect(route('user.new_password'));
        }
        return view(currentFrontView('users.send_password'));
    }

    public function edit_single(Request $request)
    {
        $success = 1;
        $message = __('user.user_has_been_saved');
        $text = $request->value;

        $user = $this->users->where('id' , auth()->id())->first();
        if (empty($user)){
            $success = 0;
            $message = __('user.dont_exist_this_user');
            return response()->json(['message' => $message, 'success' => $success]);
        }

        try {
            $user->where('id', $user->id)->update([$request->field => $request->value]);

        } catch (\QueryException $e) {
            DB::rollBack();
            $success = 0;
            $message = __('user.user_has_been_dont_saved');
        }

        return response()->json(['message' => $message, 'success' => $success,'text'=>$text]);
    }

}
