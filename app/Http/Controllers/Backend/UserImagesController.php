<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\UserImage;
use DB;
use Illuminate\Http\Request;

class UserImagesController extends Controller
{
    protected $userimages;
    protected $path;

    public function __construct(UserImage $userimages)
    {
        $this->userimages = $userimages;
        $this->path = getConstant('options.upload_path') . '/users';
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (isset($_REQUEST['search'])) {
            $userimages = $this->userimages
                ->WhereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . request()->input('search') . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate($limit);
        } else {
            $userimages = $this->userimages
                ->orderBy('id', 'desc')
                ->paginate($limit);
        }
        $path = $this->path;
        return view(currentBackView('userimages.index'), compact('userimages', 'path'));
    }


    public function confirmation(Request $request, $id)
    {
        $userimage = $this->userimages->findOrFail($id);
        $user = User::findOrFail($userimage->user_id);
        DB::beginTransaction();
        try {
            $user->image = $userimage->image;
            $user->save();
            $userimage->delete();
            DB::commit();
            return redirect(route('backend.userimages.index'))->with('status', __('userimage.userimage_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            return redirect(route('backend.userimages.index'))->with('error', __('userimage.userimage_dont_saved'));
        }
    }

    public function delete(Request $request, $id)
    {
        $userimage = $this->userimages->findOrFail($id);
        $userimage->delete();
        if ($userimage->image != null)
            @unlink($this->path . '/' . $userimage->image);
        return redirect(route('backend.userimages.index'))->with('status', __('userimage.userimage_has_been_deleted'));
    }
}
