<?php

namespace App\Models;

use App\Traits\HasRecordOwnerProperties;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Model;

class Product extends Model {
    use HasRecordOwnerProperties;
    use SoftDeletes;

    /**
    * @var  string
    */
    protected $table = 'products';

    /**
    * @var  string[]
    */
    protected $fillable = [
        'name',
        'price',
        'description',
        'is_active',
        'created_at',
        'updated_at',
        'added_by',
        'updated_by',
        'deleted_at',
    ];


    /**
    * @var  string[]
    */
    protected $casts = [
        'name' => 'string',
        'price' => 'double',
        'description' => 'string',
        'is_active' => 'boolean',
        'added_by' => 'integer',
        'updated_by' => 'integer',
    ];



}
