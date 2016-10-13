<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Project extends Model
{
    
	public $table = "projects";
    

	public $fillable = [
	    "gender"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "gender" => "integer"
    ];

	public static $rules = [
	    
	];

}
