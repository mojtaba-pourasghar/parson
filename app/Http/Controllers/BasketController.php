<?php

namespace App\Http\Controllers;

use App\Textile;
use App\UserDetail;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class BasketController
{
    public function add(Request $request)
    {

        $success = 1;
        $message = __('basket.textile_added_in_basket');
        $textile = Textile::
        select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price',
            DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off')
            , DB::raw('(select price  - (price * (sum_off / 100)) ) as sum_discount_price'))
            ->with('images')
            ->where([['state', 1], ['id', $request->textile_id]])
            ->first();

        if ($request->type == 'SMAPLE') {
            $sample_count = 0;
            $session_arr = session('Basket_Info');
            if (!empty($session_arr)) {
                foreach ($session_arr as $key => $basket_textile) {
                    if ($basket_textile['type'] == 'SMAPLE') {
                        $sample_count++;
                    }
                }
            }
            $sample_price = 0;
            if ($sample_count % 5 == 0)
                $sample_price = 150000;

            $session = array(
                'textile_id' => $request->textile_id,
                'unit_measurement' => $request->unit_measurement,
                'sum_price_discount' => $sample_price,
                'sum_price' => $sample_price,
                'color' => $request->color,
                'type' => $request->type,
                'image' => $request->image,
                'title' => $request->title,
                'slug' => $request->slug,
                'requested_amount' => 0,
                'requested_size' => 0.5,
            );
        } else {
            $session = array(
                'textile_id' => $request->textile_id,
                'unit_measurement' => $request->unit_measurement,
                'sum_price_discount' => $request->requested_amount,
                'sum_price' => $textile->price * $request->requested_size,
                'color' => $request->color,
                'type' => $request->type,
                'image' => $request->image,
                'title' => $request->title,
                'slug' => $request->slug,
                'requested_amount' => $request->requested_amount,
                'requested_size' => $request->requested_size,
            );
        }
        $Basket_Info = [];
        $session_arr = array();
        $session_arr = session('Basket_Info');

        $existProduct = FALSE;
        if (!empty($session_arr)) {
            foreach ($session_arr as $key => $basket_textile) {

                if ($basket_textile['textile_id'] == $session['textile_id']) {
                    if ($session['type'] == 'SMAPLE' && $basket_textile['type'] == 'SMAPLE') {
                        $existProduct = TRUE;
                        $success = 0;
                        $message = __('basket.textile_exist_in_basket');
                        $Basket_Info[] = $basket_textile;
                        continue;
                    }
                }

                if ($basket_textile['textile_id'] == $session['textile_id'] && $basket_textile['color'] == $session['color'] && $basket_textile['type'] == $session['type']) {
                    $existProduct = TRUE;
                    if ($session['requested_size'] > 0) {
                        $basket_textile['requested_amount'] = $basket_textile['requested_amount'] + $session['requested_amount'];
                        $basket_textile['sum_price_discount'] = $basket_textile['sum_price_discount'] + $session['sum_price_discount'];
                        $basket_textile['sum_price'] = $basket_textile['sum_price'] + $session['sum_price'];
                        $basket_textile['requested_size'] = $basket_textile['requested_size'] + $session['requested_size'];
                    }
                    if ($textile->available_amount - $basket_textile['requested_size'] <= 1) {
                        return response()->json(['message' => __('basket.this_textile_not_avaiable'), 'success' => 0]);
                    }
                }
                $Basket_Info[] = $basket_textile;
            }
        }
        if (!$existProduct) $Basket_Info[] = $session;
        Session::put('Basket_Info', $Basket_Info);

        return response()->json(['basket_count' => count($Basket_Info), 'message' => $message, 'success' => $success]);
    }

    public function refresh()
    {
        $Basket_Info = Session::get('Basket_Info');

        $count = 0;
        if (!empty($Basket_Info))
            $count = count($Basket_Info);
        return response()->json(['basket_count' => $count]);
    }

    public function list()
    {
        //session()->forget('Basket_Info');

        $session_arr = Session::get('Basket_Info');
        $sample_count = 0;
        if (!empty($session_arr)) {
            foreach ($session_arr as $key => $basket_textile) {
                if ($basket_textile['type'] == 'SMAPLE') {
                    if ($sample_count % 5 == 0 || $sample_count==0) {
                        $sample_price = 150000;
                        $session_arr[$key]['sum_price_discount'] = $sample_price;
                        $session_arr[$key]['sum_price'] = $sample_price;
                    } else {
                        $session_arr[$key]['sum_price_discount'] = 0;
                        $session_arr[$key]['sum_price'] = 0;
                    }
                    $sample_count++;
                }
            }
        }
        Session::put('Basket_Info', $session_arr);
        $Basket_Info = session('Basket_Info');
        $userDetail = UserDetail::where([['user_id', auth()->id()], ['selected', 1]])->first();
        if (empty($userDetail)){
            Session::put('back_to_basket', 1);
            return redirect(route('userdetail.add'));
        }
        session()->forget('back_to_basket');
        //return $Basket_Info;
        return view(currentFrontView('basket.list'), compact('Basket_Info', 'userDetail'));
    }

    public function delete($id)
    {
        $session_arr = Session::get('Basket_Info');

        if (!empty($session_arr)) {
            foreach ($session_arr as $key => $basket_textile) {
                if ($basket_textile['textile_id'] == $id) {
                    unset($session_arr[$key]);
                    break;
                }
            }
        }

        Session::put('Basket_Info', $session_arr);
        $Basket_Info = $session_arr;
        return redirect(route('basket.list'));
    }
}
