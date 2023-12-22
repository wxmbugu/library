<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int     $created_at
 * @property int     $updated_at
 * @property int     $loan_date
 * @property int     $due_date
 * @property int     $return_date
 * @property int     $extension_date
 * @property int     $penalty_amount
 * @property int     $added_by
 * @property boolean $extended
 * @property string  $penalty_status
 * @property string  $status
 */
class BookLoans extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'book_loans';

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
        'created_at', 'updated_at', 'user_id', 'book_id', 'loan_date', 'due_date', 'return_date', 'extended', 'extension_date', 'penalty_amount', 'penalty_status', 'status', 'added_by'
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
        'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'loan_date' => 'timestamp', 'due_date' => 'timestamp', 'return_date' => 'timestamp', 'extended' => 'boolean', 'extension_date' => 'timestamp', 'penalty_amount' => 'int', 'penalty_status' => 'string', 'status' => 'string', 'added_by' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'loan_date', 'due_date', 'return_date', 'extension_date'
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
