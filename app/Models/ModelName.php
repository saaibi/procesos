<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    
	public $table = "model_names";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "title",
		"password"
	];

	public static $rules = [
	    "title" => "required",
		"password" => "required"
	];

}
