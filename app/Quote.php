<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;

    protected $table = 'quotes'; # table name this Model is referring to

    protected $fillable = ['quote', 'author', 'image']; # whitelist of columns that we can modify

    protected $dates = ['deleted_at']; # required to make use of the softDeletes trait
}
