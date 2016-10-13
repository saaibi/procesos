<?php

namespace App\Libraries\Repositories;


use App\Models\ModelName;
use Illuminate\Support\Facades\Schema;

class ModelNameRepository
{

	/**
	 * Returns all ModelNames
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return ModelName::all();
	}

	public function search($input)
    {
        $query = ModelName::query();

        $columns = Schema::getColumnListing('model_names');
        $attributes = array();

        foreach($columns as $attribute){
            if(isset($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] =  $input[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        return [$query->get(), $attributes];

    }

	/**
	 * Stores ModelName into database
	 *
	 * @param array $input
	 *
	 * @return ModelName
	 */
	public function store($input)
	{
		return ModelName::create($input);
	}

	/**
	 * Find ModelName by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|ModelName
	 */
	public function findModelNameById($id)
	{
		return ModelName::find($id);
	}

	/**
	 * Updates ModelName into database
	 *
	 * @param ModelName $modelName
	 * @param array $input
	 *
	 * @return ModelName
	 */
	public function update($modelName, $input)
	{
		$modelName->fill($input);
		$modelName->save();

		return $modelName;
	}
}