<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'stripe_plan',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }
}
