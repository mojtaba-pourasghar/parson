<?php

namespace App\Http\Controllers;

use App\BookCommentLike;
use App\BookShelf;
use App\Events\Message;
use App\Follower;
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

    public function email_confirmation(Request $request, $confirmation)
    {
        $user = $this->users->where('email_confirmation', $confirmation)->first();
        if (!empty($user->id)) {
            $user->where('id', $user->id)->update(['email_confirmation' => '', 'state' => 1, 'email_verified' => 1]);
            $this->guard()->login($user);
            return redirect(route('home'));
        } else
            flash()->error(__('user.your_email_confirmation_will_not_be_accepted'));

        return view(currentFrontView('auth.email_confirmation'));
    }

    /**
     * edit user profile
     */
    public function edit_profile(Request $request)
    {

        $user = $this->users->find(auth()->id());

        if ($request->isMethod('put')) {
            DB::beginTransaction();
            try {
                $user->fill($request->only('name', 'gender', 'email', 'date_of_birth', 'telegram',
                    'province_id', 'city_id', 'instagram', 'twitter', 'facebook', 'about'))->save();

                if (!empty($request->image_file)) {
                    $user_image = '';

                    if (!empty($_FILES['image_file']['name'])) {
                        $image = $this->uploadImage($_FILES['image_file'], $this->path);
                        if ($image['action']) {
                            $user_image = $image['filename'];
                        } else {
                            return redirect() . back() . with('status', $image['message']);
                        }
                        @unlink($this->path . '/' . $userImage->image);
                    }
                    $user->images()->delete();
                    $UserImage = new UserImage();
                    $UserImage->image = $user_image;
                    $UserImage->user_id = auth()->id();
                    //dd($UserImage);
                    $user->images()->save($UserImage);
                }

                DB::commit();
                flash()->success(__('user.user_has_been_saved'));
                return redirect(route('user.edit'));
            } catch (\QueryException $e) {
                DB::rollBack();
                if (!empty($thumbnail['filename']))
                    @unlink($this->path . '/' . $thumbnail['filename']);
                flash()->error(__('user.user_dont_saved'));
                return redirect(route('user.edit'));
            }
        }
        return view(currentFrontView('users.edit_profile'), compact('user'));
    }

    protected function changeMobileValidator(array $data)
    {
        $attributes = [
            'mobile' => __('user.mobile'),
        ];
        $messages = [];
        $rules = [
            'mobile' => ['required'],
        ];
        return Validator::make($data, $rules, $messages, $attributes);
    }

    public function change_mobile(Request $request)
    {
        $user = $this->users->find(auth()->id());
        $otp = rand(10000, 99999);
        if ($request->isMethod('put')) {

            $this->changeMobileValidator($request->all())->validate();
            $user->mobile_confirmation = $otp;
            $user->save();

            speedSend($request->mobile, 26690, array(
                ["Parameter" => "VerificationCode", "ParameterValue" => $otp]
            ));
            return redirect(route('user.mobile_verify', $request->mobile));
        }

        return view(currentFrontView('users.change_mobile'), compact('user'));
    }

    protected function mobileVerifyValidator(array $data)
    {
        $attributes = [
            'mobile_confirmation' => __('user.mobile_confirmation'),
        ];
        $messages = [];
        $rules = [
            'mobile_confirmation' => ['required'],
        ];
        return Validator::make($data, $rules, $messages, $attributes);
    }

    public function mobile_verify(Request $request, $mobile)
    {
        if ($request->isMethod('put')) {
            $this->mobileVerifyValidator($request->all())->validate();
            $user = $this->users->where('mobile', $mobile)->first();
            if ($user->mobile_confirmation == $request->mobile_confirmation) {
                $user->mobile_confirmation = 0;
                $user->mobile_verified = 1;
                $user->mobile = $mobile;
                $user->save();
                return redirect(route('login'))->with('success', __('user.the_mobile_was_successfully_registred'));
            } else {
                return redirect(route('user.mobile_verify', $mobile))->with('error', __('user.the_confirm_code_incorrect'));
            }
        }
        return view(currentFrontView('users.mobile_verify'), compact('mobile'));
    }

    protected function changePasswordValidator(array $data)
    {
        $attributes = [
            'old_password' => __('user.current_password'),
            'confirm_password' => __('user.confirm_new_password'),
        ];
        $messages = [
            '' => '',
        ];

        $rules = [
            'old_password' => ['required', 'min:5'],
            'password' => ['required', 'min:5', 'required_with:password_confirmation'],
            'confirm_password' => ['required', 'min:5'],
        ];

        return Validator::make($data, $rules, $messages, $attributes);
    }

    public function change_password(Request $request)
    {
        if ($request->isMethod('put')) {
            $this->changePasswordValidator($request->all())->validate();

            $user = $this->users->find(auth()->id());
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect(route('user.change_password'))->with('error', __('user.your_current_password_is_incorrect'));
            }
            $user->password = $request->password;
            $user->save();
            return redirect(route('auth.logout'))->with('success', __('user.the_password_was_successfully_changed'));
        }
        return view(currentFrontView('users.change_password'));
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
        }
        return view(currentFrontView('users.new_password')/*, compact('user')*/);
    }

    public function send_password(Request $request)
    {
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
        return view(currentFrontView('users.new_password'));
    }

    public function change_image(Request $request)
    {
        $user = $this->users->where('id', auth()->id())->first();
        if ($request->isMethod('put')) {

            if (!empty($request->image_file)) {
                $user_image = '';

                if (!empty($_FILES['image_file']['name'])) {
                    $image = $this->uploadImage($_FILES['image_file'], $this->path);
                    if ($image['action']) {
                        $user_image = $image['filename'];
                    } else {
                        return redirect() . back() . with('status', $image['message']);
                    }
                    @unlink($this->path . '/' . $user->image);
                }
                try {
                    $user->image = $user_image;
                    $user->save();
                    flash()->success(__('user.user_image_has_been_saved'));
                } catch (\QueryException $e) {
                    DB::rollBack();
                    if (!empty($image))
                        @unlink($this->path . '/' . $image['filename']);
                    flash()->error(__('user.user_image_dont_upload'));
                }
            }
        }
        return view(currentFrontView('users.change_image'), compact('user'));
    }

    public function profile(Request $request, $id, $title)
    {
        $userProfile = $this->users
            ->with([
                'bookComments' => function ($query) use ($id) {
                    $query->with(['book' => function ($query) {
                        $query->where('state', 1);
                        return $query->select(['id', 'title', 'slug', 'thumbnail', 'rate']);
                    }]);
                    $query->where([['state', 1], ['user_id', $id]]);
                    $query->take(4);
                },
                'bookShelves' => function ($query) use ($id) {
                    $query->with(['book' => function ($query) {
                        $query->where('state', 1);
                        $query->take(4);
                        $query->orderBy('id', 'desc');
                        return $query->select(['id', 'title', 'slug', 'thumbnail', 'rate']);
                    }]);
                    $query->with(['shelf' => function ($query) {
                        $query->where('state', 1);
                        return $query->select(['id', 'title']);
                    }]);
                    $query->where([['user_id', $id]]);
                    //$query->take(4);
                }
            ])
            ->select(['id', 'name', 'email', 'image', 'book_read_count', 'book_comment_count', 'created_at', 'description', 'rate_count', 'book_read_count'])
            ->find($id);

        $folow = Follower::where([['user_id', $id], ['folower_id', auth()->id()]])->first();
        $shelves = $this->getShelves($id);
        $followWriters = $this->getFavoriteWriters($id);
        $followOrganizations = $this->getFavoriteOrganizations($id);
        //return $userProfile;
        return view(currentFrontView('users.profile'), compact('userProfile', 'folow', 'shelves', 'followWriters', 'followOrganizations'));
    }

    public function getShelves($user_id)
    {
        return BookShelf::join('shelves', 'shelves.id', '=', 'book_shelves.shelf_id')
            ->select('shelves.title', 'shelves.id')
            ->where([['book_shelves.user_id', $user_id]])
            ->distinct('shelves.title')
            ->take(3)
            ->get();
    }


    public function getFavoriteWriters($user_id)
    {
        return Follower::with(['person' => function ($query) use ($user_id) {
            $query->where('state', 1);
            return $query->select(['id', 'title', 'thumbnail', 'slug']);
        }])
            ->where([['folower_id', $user_id], ['person_id', '>', '0']])
            ->whereHas('person', function ($query) {
                $query->with(['personRoles' => function ($query) {
                    $query->where('person_role_id', getConstant('person_role.writer'));
                }]);
                $query->where('state', 1);
            })
            ->take(7)
            ->get();
    }

    public function getFavoriteOrganizations($user_id)
    {
        return Follower::with(['organization' => function ($query) use ($user_id) {
            $query->where('state', 1);
            return $query->select(['id', 'title', 'thumbnail', 'slug']);
        }])
            ->where([['folower_id', $user_id], ['organization_id', '>', '0']])
            ->take(7)
            ->get();
    }

    public function getFavoriteComments($user_id)
    {
        //\DB::enableQueryLog();
        $BookCommentLike = BookCommentLike::with([
            'bookComment' => function ($query) use ($user_id) {
                $query->with(['book' => function ($query) {
                    $query->where('state', 1);
                    return $query->select(['id', 'title', 'slug', 'thumbnail', 'rate']);
                }]);
                $query->where([['state', 1]]);
                $query->take(2);
            }
        ])
            ->where([['like', 1]])
            ->get();
        return $BookCommentLike;
        //return \DB::getQueryLog();
    }


    public function myProfile()
    {
        $id = auth()->id();
        $userProfile = $this->users
            ->with([
                'bookComments' => function ($query) use ($id) {
                    $query->with(['book' => function ($query) {
                        $query->where('state', 1);
                        return $query->select(['id', 'title', 'slug', 'thumbnail', 'rate']);
                    }]);
                    $query->where([['state', 1], ['user_id', $id]]);
                    $query->take(4);
                },
                'bookShelves' => function ($query) use ($id) {
                    $query->with(['book' => function ($query) {
                        $query->where('state', 1);
                        $query->take(4);
                        $query->orderBy('id', 'desc');
                        return $query->select(['id', 'title', 'slug', 'thumbnail', 'rate']);
                    }]);
                    $query->with(['shelf' => function ($query) {
                        $query->where('state', 1);
                        return $query->select(['id', 'title']);
                    }]);
                    $query->where([['user_id', $id]]);
                    //$query->take(4);
                }
            ])
            ->select(['id', 'name', 'email', 'image', 'book_read_count', 'book_comment_count', 'created_at', 'description', 'rate_count', 'book_read_count'])
            ->find($id);

        $folow = Follower::where([['user_id', $id], ['folower_id', auth()->id()]])->first();
        $shelves = $this->getShelves($id);
        $followWriters = $this->getFavoriteWriters($id);
        $followOrganizations = $this->getFavoriteOrganizations($id);

        $favoriteComments = $this->getFavoriteComments($id);

        //return $favoriteComments;
        return view(currentFrontView('users.myProfile'), compact('userProfile', 'folow', 'shelves', 'followWriters', 'followOrganizations', 'favoriteComments'));
    }

    public function chat()
    {
        return view(currentFrontView('users.chat'));
    }


    public function send_message(Request $request)
    {
        event(
            new Message(
                $request->username,
                $request->message)
        );
    }
}
