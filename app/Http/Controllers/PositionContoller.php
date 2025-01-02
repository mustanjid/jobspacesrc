<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Position;
use App\Models\PositionPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionContoller extends Controller
{
    public function list()
    {
        $permissionUser = PositionPermission::getPermission('user', Auth::user()->position_id);

        if(empty($permissionUser)){
            abort(404);
        }

        $data['permissionAdd'] = PositionPermission::getPermission('add user', Auth::user()->position_id);
        $data['getRecord'] = Position::getRecord();
        return view('admin.role.index', $data);
    }

    public function add()
    {
        $getPermission = Permission::getRecord();
        $data['getPermission'] = $getPermission;
        return view('admin.role.create', $data);
    }

    public function insert(Request $request)
    {
        $position = new Position;
        $position->name = $request->name;
        $position->save();

        PositionPermission::InsertUpdateRecord($request->permission_id, $position->id);
        return redirect('admin/roles')->with('s', 'Role added successfully!');
    }

    public function edit($id)
    {
        $data['getRecord'] = Position::findOrFail($id);
        $data['getPermission'] = Permission::getRecord();
        $data['getPositionPermission'] = PositionPermission::getRolePermission($id);
        return view('admin.role.edit', $data);
    }

    public function update($id, Request $request)
    {
        $position = Position::findOrFail($id);
        $position->name = $request->name;
        $position->save();

        PositionPermission::InsertUpdateRecord($request->permission_id, $position->id);
        return redirect('admin/roles')->with('success', 'Role updated successfully!');
    }

    public function delete($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();
        return redirect('admin/roles')->with('failure', 'Role deleted!');
    }
}
