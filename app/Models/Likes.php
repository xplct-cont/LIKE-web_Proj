<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Likes
 * @package App\Models
 * @version October 9, 2021, 8:05 am UTC
 *
 * @property string $post_id
 * @property string $user_id
 */
class Likes extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'likes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'post_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'string',
        'user_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'post_id' => 'required|string|max:10',
        'user_id' => 'required|string|max:10',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
