<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserProfile\PermissionCategories;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function userRestiction($id)
    {
        $user = User::find($id);
        $permissions = $user->getPermissionNames()->toArray();
        $permissionCategorys = PermissionCategories::where('type', 'ba')->get();

        return view('user_restiction', compact('permissionCategorys', 'permissions', 'user'));
    }

    public function UserRectictionsUpdate(Request $request)
    {
        // return true;
        $user = User::find($request->id);
        $user->syncPermissions($request->permission);
        return redirect()->route('user-management.user-list');
    }
}
