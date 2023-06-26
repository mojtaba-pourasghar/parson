<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Province;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDetailsController extends Controller
{
    protected $userdetails;

    public function __construct(UserDetail $userdetails)
    {
        $this->userdetails = $userdetails;
        parent::__construct();
    }

    public function addresses()
    {
        $userdetails = $this->userdetails
            ->with('province')
            ->with('city')
            ->where('user_id', auth()->id());

        $userdetails = $userdetails->get();
        return response()->json(['userdetails' => $userdetails, 'success' => 1]);
    }


    public function store(Request $request)
    {
        $success = 0;
        $message = '';
        $validator = Validator::make($request->all(), [
            'telephon' => 'required',
            'recipient_name' => 'required',
            'address' => 'required',
        ]);
        $data = $request->json()->all();

        $userDetail = UserDetail::create([
            'user_id' => auth()->id(),
            'province_id' => $data['province_id'],
            'city_id' => $data['city_id'],
            'telephon' => $data['telephon'],
            'recipient_name' => $data['recipient_name'],
            'post_code' => $data['post_code'],
            'address' => $data['address'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
        ]);

        if ($userDetail) {
            $success = 1;
        } else $success = 0;

        return response()->json(['success' => 1]);
    }

    public function update(Request $request)
    {
        $success = 0;
        $message = '';
        $validator = Validator::make($request->all(), [
            'telephon' => 'required',
            'recipient_name' => 'required',
            'address' => 'required',
        ]);
        $data = $request->json()->all();

        $userDetail = $this->userdetails->where([['user_id', auth()->id()], ['id', $data['user_detail_id']]])->first();
        if (empty($userDetail)) {
            return response()->json(['message' => __('user_detail.not_exist_this_address'), 'success' => 0]);
        }
        $userDetail->fill([
            'province_id' => $data['province_id'],
            'city_id' => $data['city_id'],
            'telephon' => $data['telephon'],
            'recipient_name' => $data['recipient_name'],
            'post_code' => $data['post_code'],
            'address' => $data['address'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
        ])->save();

        if ($userDetail) {
            $success = 1;
        } else $success = 0;

        return response()->json(['success' => $success, 'message' => $message]);
    }

    public function get($id)
    {
        $userDetail = $this->userdetails->where([['user_id', auth()->id()], ['id', $id]])->first();
        if (empty($userDetail)) {
            return response()->json(['message' => __('user_detail.not_exist_this_address'), 'success' => 0]);
        }

        $provinces = Province::orderBy('name', 'asc')->where('state',1)->get();
        $cities = City::orderBy('name', 'asc')->get();
        return response()->json(['userdetail' => $userDetail, 'success' => 1,'provinces'=>$provinces,'cities'=>$cities]);
    }

    public function select_address(Request $request)
    {
        $success = 0;
        $message = '';
        $data = $request->json()->all();
        $userDetail = $this->userdetails->where([['user_id', auth()->id()], ['id', $data['user_detail_id']]])->first();
        if (empty($userDetail)) {
            return response()->json(['message' => __('user_detail.not_exist_this_address'), 'success' => 0]);
        }
        $this->userdetails->where('user_id', '=', auth()->id())->update(['selected' => '0']);
        $userDetail->selected = 1;
        if ($userDetail->save()) $success = 1;

        return response()->json(['success' => $success, 'message' => $message]);
    }

    public function delete(Request $request)
    {
        $success = 0;
        $message = '';
        $data = $request->json()->all();
        $userDetail = $this->userdetails->where([['user_id', auth()->id()], ['id', $data['user_detail_id']]])->first();
        if (empty($userDetail)) {
            return response()->json(['message' => __('user_detail.not_exist_this_address'), 'success' => 0]);
        }
        if ($userDetail->delete()) {
            $success = 1;
            $message = __('user_detail.delete_address_successful');
        }

        return response()->json(['success' => $success, 'message' => $message]);
    }

    public function current_address()
    {
        $userdetail = $this->userdetails
            ->with('province')
            ->with('city')
            ->where([['user_id', auth()->id()], ['selected', 1]]);
            //->select('telephon', 'recipient_name', 'post_code', 'address', 'longitude', 'latitude');
        $userdetail = $userdetail->first();
        if ($userdetail==null){
            return response()->json(['userdetail' => $userdetail, 'success' => 0,'message'=>__('user_detail.dont_exist_address_or_dont_select_any_address')]);
        }
        return response()->json(['userdetail' => $userdetail, 'success' => 1]);
    }
}
