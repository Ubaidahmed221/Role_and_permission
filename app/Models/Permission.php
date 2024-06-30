<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permission'; // Define the table name

    protected $fillable = ['name'];

    public function role(){
        return $this->belongsToMany(role::class,'permission_roles');
    }
}
