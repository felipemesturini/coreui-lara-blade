<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
