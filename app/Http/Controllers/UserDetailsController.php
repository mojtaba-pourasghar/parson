<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use App\UserDetail;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserDetailsController extends Controller
{
    protected $userdetails;

    public function __construct(UserDetail $userdetails)
    {
        $this->userdetails = $userdetails;
    }

    public function addresses()
    {
        $userdetails = $this->userdetails
            ->with('province')
            ->with('city')
            ->where('user_id', auth()->id());

        $userdetails = $userdetails->get();
        return view(currentFrontView('userdetails.addresses'), compact('userdetails'));
    }


    public function add(Request $request, UserDetail $userDetail)
    {
        $provinces = Province::getList();
        $selected_province = [];
        if ($request->isMethod('post')) {
            try {

                $messages = [
                    'telephon.required' => 'شماره تلفن همراه را وارد نمایید',
                    'recipient_name.required' => ' نام گیرنده را وارد نمایید',
                    'city_id.required'    => 'شهر ر ا انتخاب نمایید',
                    'address.required' => 'آدرس را وارد نمایید',
                ];

                $validator = Validator::make($request->all(), [
                    'telephon' => 'required',
                    'recipient_name' => 'required',
                    'city_id' => 'required',
                    'address' => 'required',
                ],$messages)->validate();


                $userDetail = UserDetail::create([
                    'user_id' => auth()->id(),
                    'province_id' => $request->province_id,
                    'city_id' => $request->city_id,
                    'telephon' => $request->telephon,
                    'recipient_name' => $request->recipient_name,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                ]);
                DB::commit();
                flash()->success(__('user_detail.address_has_been_saved'));

                $back_to_basket = Session::get('back_to_basket');
                if ($back_to_basket) {
                    $userDetail->selected = 1;
                    $userDetail->save();
                    return redirect(route('basket.list'));
                }

                return redirect(route('userdetail.addresses'));
            } catch (\QueryException $e) {
                DB::rollBack();
                flash()->error(__('user_detail.address_dont_saved'));
                return redirect(route('userdetail.addresses'));
            }
        }

        return view(currentFrontView('userdetails.form'), compact('provinces', 'userDetail', 'selected_province'));
    }

    public function edit(Request $request, $id)
    {
        $provinces = Province::getList();

        $userDetail = $this->userdetails->where([['user_id', auth()->id()], ['id', $id]])->first();

        if (empty($userDetail)) {
            flash()->error(__('user_detail.not_exist_this_address'));
        }


        if (!empty($_REQUEST['redirect'])) {
            if ($_REQUEST['redirect'] == 'step1') {
                Session::put('back_to_step1', 1);
            }
        }


        $selected_province = $userDetail->province_id;
        if ($request->isMethod('put')) {
            try {
                $validator = Validator::make($request->all(), [
                    'telephon' => 'required',
                    'recipient_name' => 'required',
                    'address' => 'required',
                ]);

                $userDetail->fill([
                    'province_id' => $request->province_id,
                    'city_id' => $request->city_id,
                    'telephon' => $request->telephon,
                    'recipient_name' => $request->recipient_name,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                ])->save();

                DB::commit();
                flash()->success(__('user_detail.address_has_been_saved'));

                $back_to_step1 = Session::get('back_to_step1');
                if ($back_to_step1) {
                    return redirect(route('order.step1'));
                }
                return redirect(route('userdetail.addresses'));
            } catch (\QueryException $e) {
                DB::rollBack();
                flash()->error(__('user_detail.address_dont_saved'));
                return redirect(route('userdetail.addresses'));
            }
        } else {
            if (empty($_REQUEST['redirect']))
                session()->forget('back_to_step1');
        }

        return view(currentFrontView('userdetails.form'), compact('provinces', 'userDetail', 'selected_province'));
    }

    public
    function select_address(Request $request)
    {
        $userDetail = $this->userdetails->where([['user_id', auth()->id()], ['id', $request->id]])->first();
        if (empty($userDetail)) {
            return response()->json(['message' => __('user_detail.not_exist_this_address'), 'success' => 0]);
        }
        $this->userdetails->where('user_id', '=', auth()->id())->update(['selected' => '0']);
        $userDetail->selected = 1;
        if ($userDetail->save()) {
            return response()->json(['message' => __('user_detail.select_address_successful'), 'success' => 1]);
        }
        return response()->json(['message' => __('user_detail.the_address_dont_select'), 'success' => 0]);
    }

    public
    function delete(Request $request, $id)
    {
        $userDetail = $this->userdetails->where([['user_id', auth()->id()], ['id', $id]])->first();
        if (empty($userDetail)) {
            return flash()->error(__('user_detail.not_exist_this_address'));
        }
        if ($userDetail->delete()) {
            flash()->success(__('user_detail.delete_address_successful'));
            return redirect(route('userdetail.addresses'));
        }

        flash()->error(__('user_detail.the_address_dont_delete'));
        return redirect(route('userdetail.addresses'));
    }

    public
    function current_address()
    {
        $userdetail = $this->userdetails
            ->with('province')
            ->with('city')
            ->where([['user_id', auth()->id()], ['selected', 1]]);
        //->select('telephon', 'recipient_name', 'post_code', 'address', 'longitude', 'latitude');
        $userdetail = $userdetail->first();
        if ($userdetail == null) {
            return response()->json(['userdetail' => $userdetail, 'success' => 0, 'message' => __('user_detail.dont_exist_address_or_dont_select_any_address')]);
        }
        return response()->json(['userdetail' => $userdetail, 'success' => 1]);
    }
}
