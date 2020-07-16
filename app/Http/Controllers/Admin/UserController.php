<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * ユーザー一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::latest()->withCount('messages')->get();

        return view('admin.user.index', compact('users'));
    }

    public function destroy(User $user)
    {
//        if($user->messages()->exists()){
//            return \response()->json(['success' => flase], 422);
//        }

        $user->delete();

        return ['success' => true];
    }
}
