<?php
namespace App\Http\Controllers;

use App\Bookmark;
use App\Textile;
use App\UserDetail;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class BookmarkController
{

    protected $bookmarks;

    public function __construct(Bookmark $bookmarks)
    {
        $this->bookmarks = $bookmarks;
    }

    public function add(Request $request)
    {
        $success = 1;
        $message = __('bookmark.the_bookmark_have_been_saved');

        $bookmark = $this->bookmarks->where([['textile_id',$request->textile_id],['user_id' , auth()->id()]])->first();
        if (!empty($bookmark)){
            $success = 0;
            $message = __('bookmark.before_you_added_bookmark');
            return response()->json(['message' => $message, 'success' => $success]);
        }

        try {
            $bookmark = $this->bookmarks->create([
                'user_id' => auth()->id(),
                'textile_id' => $request->textile_id,
            ]);

        } catch (\QueryException $e) {
            DB::rollBack();
            $success = 0;
            $message = __('bookmark.bookmark_not_saved');
        }

        return response()->json(['message' => $message, 'success' => $success]);
    }

    public function refresh()
    {
        $Basket_Info = Session::get('Basket_Info');

        $count = 0;
        if (!empty($Basket_Info))
            $count = count($Basket_Info);
        return response()->json(['basket_count' => $count]);
    }

    public function list(){
        $bookmarks = $this->bookmarks
            ->with(['textile' => function ($query)   {

                $query->select('id', 'title', 'slug', 'available_amount', 'unit_measurement',
                    'price', DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id =
                     t.discount_type_id where t.textile_id = textiles.id ) as sum_off')
                    ,DB::raw('(select price  - (price * (sum_off / 100)) ) as sum_discount_price')
                );
                $query->with([
                    'images' => function ($query) {
                        // $query->where('id', '=', 1);
                        // return $query->select('id', 'image');
                    }]);
                //return $query->where('trend_id', $id);
                //return $query->select(['id', 'title', 'price', 'available_amount']);
            }])
            ->where([['user_id' , auth()->id()]])->get();

        return view(currentFrontView('bookmarks.list'), compact('bookmarks'));
    }

    public function delete($id)
    {
        $bookmark = $this->bookmarks->where('id',$id)->delete();
        return redirect(route('bookmark.list'));
    }
}
