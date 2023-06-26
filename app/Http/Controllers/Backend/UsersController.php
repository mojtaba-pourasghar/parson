<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use  App\Http\Controllers\Backend\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
        parent::__construct();
    }

    public function index()
    {
        //$user = request()->user(); //getting the current logged in user
        // dd($user->hasRole('admin','bloger')); // and so on
        // \DB::enableQueryLog();

        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (request()->isMethod('post')) {

            $users = $this->users
                ->where([['id', '>', 1], ['name', 'like', '%' . request()->input('search') . '%']])
                ->with('roles')
                ->orderBy('id', 'desc')
                ->paginate($limit);
        }

        if (request()->isMethod('get')) {
            $users = $this->users
                ->where('id', '>', 1)
                ->with('roles')
                ->orderBy('id', 'desc')
                ->paginate($limit);
        }


        // return $users;
        // dd(\DB::getQueryLog());

        return view(currentBackView('users.index'), compact('users'));

    }


    public function create(User $userSite, Role $roles)
    {
        //  $roles = $user->roles()->pluck('id','name');
        //  $roles = $user->roles()->all();
        $roles = $roles->all();
        // dd($user->roles());
        return view(currentBackView('users.form'), compact('userSite', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request->roles);
        // dd($request->all('roles'));
        $user = $this->users->Create(['is_admin' => 1] + $request->only('name', 'email', 'password','state'));
        $user->roles()->attach($request->roles);
        return redirect(route('backend.users.index'))->with('status', __('user.user_has_been_saved'));
    }

    public function edit($id, Role $roles)
    {
        $userSite = $this->users->findOrFail($id);
        $roles = $roles->all();
        return view(currentBackView('users.form'), compact('userSite', 'roles'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->users->findOrFail($id);
        if (empty($request->password)) {
            $user->fill($request->only('name', 'email','state'))->save();
        } else
            $user->fill($request->only('name', 'email', 'password','state'))->save();
        $user->roles()->sync($request->roles);
        return redirect(route('backend.users.index'))->with('status', __('user.user_has_been_saved'));
    }

    public function delete(DeleteUserRequest $request, $id)
    {
        $user = $this->users->findOrFail($id);
        $user->delete();
        $user->roles()->detach();
        return redirect(route('backend.users.index'))->with('status', __('user.user_has_been_deleted'));
    }

    public function getusers($name)
    {
        $users = $this->users
            ->where([['name', 'like', '%' . $name . '%']])
            ->limit(10)
            ->orderBy('name', 'asc')
            ->get();
        $returnHTML = view(currentBackView('partials.users.getusers'))->with('users', $users)->render();
        // return $returnHTML;
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

}
