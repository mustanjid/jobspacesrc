<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PositionPermission extends Model
{
    protected $table = 'permission_position';

    static public function InsertUpdateRecord($permission_ids, $position_id)
    {
        self::where('position_id', '=', $position_id)->delete();
        foreach ($permission_ids as $permission_id) {
            $save = new PositionPermission;
            $save->position_id = $position_id;
            $save->permission_id = $permission_id;
            $save->save();
        }
    }

    static public function getRolePermission($position_id)
    {
        return self::where('position_id', '=', $position_id)->get();
    }

    static public function getPermission($slug, $position_id)
    {
        return self::select('permission_position.id')
            ->join('permissions', 'permissions.id', '=', 'permission_position.permission_id')
            ->where('permission_position.position_id', '=', $position_id)
            ->where('permissions.slug', '=', $slug)
            ->count();
    }
    
}
