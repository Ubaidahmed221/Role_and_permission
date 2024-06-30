<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{

    use HasFactory;

    protected $table = "permission_roles";

    protected $fillable = ['permission_id','role_id'];

    public function role(){
        return $this->belongsTo(role::class);
    }
    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}
