<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\User;
use Auth;
use Caffeinated\Shinobi\Models\Role;

class UserController extends Controller
{
    public function permissions()
    {
        $users = User::findOrFail(Auth::id());
        $users->load('roles');
        $permissions = [];
        foreach ($users['roles'] as $key => $rol) {
            $role = Role::find($rol->id);
            if ($role->special == 'all-access') {
                $permissions[] = '*';
            } else {
                $rolpermissions = $role->getPermissions();
                foreach ($rolpermissions as $value) {
                    $permissions[] = $value;
                }
            }
        }
        return response()->json(['data' => $permissions]);
    }
}
