<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Procesos extends Model
{
    
	public $table = "procesos";
    

	public $fillable = [
	    "title",
		"numero"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "title" => "string",
		"numero" => "string"
    ];

	public static $rules = [
	    "title" => "required",
		"numero" => "required"
	];

}
