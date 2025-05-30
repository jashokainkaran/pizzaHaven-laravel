<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Drink extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pizzas';

    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image'
    ];

    public $timestamps = true;
}
