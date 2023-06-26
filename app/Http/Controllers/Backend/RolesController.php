<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $roles;

    public function __construct(Role $roles)
    {
        $this->roles = $roles;
        parent::__construct();
    }

    public function index()
    {
        $roles = $this->roles->paginate(10);
        return view(currentBackView('roles.index'), compact('roles'));
    }

    public function create(Role $role,Permission $permissions)
    {
        $permissions = $permissions->all();
        return view(currentBackView('roles.form'), compact('role','permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $role = $this->roles->create($request->only('name', 'slug'));
        $role->permissions()->attach($request->permissions);
        return redirect(route('backend.roles.index'))->with('status', __('role.role_has_been_created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Permission $permissions)
    {
        //dd(\Gate::abilities());
        /*if (request()->user()->can('create-tasks')) {
            print_r('ddddd');
        }*/
        $permissions = $permissions->all();
        $role = $this->roles->findOrFail($id);
        return view(currentBackView('roles.form'), compact('role','permissions'));
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = $this->roles->findOrFail($id);
        $role->fill($request->only('name', 'slug'))->save();
        $role->permissions()->sync($request->permissions);
        return redirect(route('backend.roles.index'))->with('status', __('role.role_has_been_created'));
    }

    public function delete(Request $request, $id)
    {
        $role = $this->roles->findOrFail($id);
        $role->delete();
        return redirect(route('backend.roles.index'))->with('status', __('role.role_has_been_deleted'));
    }
}
