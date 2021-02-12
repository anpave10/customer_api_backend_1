<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model as EloquentModel;

class Customer extends EloquentModel
{
    use HasFactory;

    protected $primaryKey = '_id';

    protected $collection = 'customers';

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
