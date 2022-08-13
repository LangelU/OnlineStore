<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller {
    public function createRole(Request $request) {
        $newRole = new Role;
        $newRole->name = $request->input('role_name');
        $newRole->save();

        return response()->json(['success'=>'Role created successfully'], 201);
    }
}
