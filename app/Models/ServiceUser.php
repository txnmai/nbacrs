<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{
    //
    protected $table = 'serviceuser';

    protected $fillable = [
        'name',
        'itemrepair',
        'detailrepair',
        'location',
        'date',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public $timestamps = true; //create_at, update_at
}
