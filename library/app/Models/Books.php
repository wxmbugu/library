<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $pages
 * @property int    $added_by
 * @property string $name
 * @property string $publisher
 * @property string $isbn
 * @property string $category
 * @property string $sub_category
 * @property string $description
 * @property string $image
 */
class Books extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_at', 'updated_at', 'name', 'publisher', 'isbn', 'category', 'sub_category', 'description', 'pages', 'image', 'added_by'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'name' => 'string', 'publisher' => 'string', 'isbn' => 'string', 'category' => 'string', 'sub_category' => 'string', 'description' => 'string', 'pages' => 'int', 'image' => 'string', 'added_by' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...

    // Functions ...

    // Relations ...
}
