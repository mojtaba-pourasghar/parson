<?php


namespace App\Http\Controllers\Backend;


use App\Blog;
use App\User;

class DashbordController extends Controller
{
    public function index(Blog $blogs, User $users)
    {/*
        $user = request()->user();
        dd($user->hasRole('developer')); //will return true, if user has role
        dd($user->givePermissionsTo('create-tasks'));// will return permission, if not null
        dd($user->can('create-tasks')); // will return true, if user has permission
*/


        $blogs = $blogs->orderBy('updated_at', 'desc')->take(5)->get();
        $users = $users->whereNotNull('last_login_at')->orderBy('last_login_at', 'desc')->take(5)->get();
        return view(currentBackView('dashbord'), compact('blogs', 'users'));
    }
}
