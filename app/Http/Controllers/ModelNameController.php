<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateModelNameRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\ModelNameRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class ModelNameController extends AppBaseController
{

	/** @var  ModelNameRepository */
	private $modelNameRepository;

	function __construct(ModelNameRepository $modelNameRepo)
	{
		$this->modelNameRepository = $modelNameRepo;
	}

	/**
	 * Display a listing of the ModelName.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->modelNameRepository->search($input);

		$modelNames = $result[0];

		$attributes = $result[1];

		return view('modelNames.index')
		    ->with('modelNames', $modelNames)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new ModelName.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('modelNames.create');
	}

	/**
	 * Store a newly created ModelName in storage.
	 *
	 * @param CreateModelNameRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateModelNameRequest $request)
	{
        $input = $request->all();

		$modelName = $this->modelNameRepository->store($input);

		Flash::message('ModelName saved successfully.');

		return redirect(route('modelNames.index'));
	}

	/**
	 * Display the specified ModelName.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$modelName = $this->modelNameRepository->findModelNameById($id);

		if(empty($modelName))
		{
			Flash::error('ModelName not found');
			return redirect(route('modelNames.index'));
		}

		return view('modelNames.show')->with('modelName', $modelName);
	}

	/**
	 * Show the form for editing the specified ModelName.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modelName = $this->modelNameRepository->findModelNameById($id);

		if(empty($modelName))
		{
			Flash::error('ModelName not found');
			return redirect(route('modelNames.index'));
		}

		return view('modelNames.edit')->with('modelName', $modelName);
	}

	/**
	 * Update the specified ModelName in storage.
	 *
	 * @param  int    $id
	 * @param CreateModelNameRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateModelNameRequest $request)
	{
		$modelName = $this->modelNameRepository->findModelNameById($id);

		if(empty($modelName))
		{
			Flash::error('ModelName not found');
			return redirect(route('modelNames.index'));
		}

		$modelName = $this->modelNameRepository->update($modelName, $request->all());

		Flash::message('ModelName updated successfully.');

		return redirect(route('modelNames.index'));
	}

	/**
	 * Remove the specified ModelName from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$modelName = $this->modelNameRepository->findModelNameById($id);

		if(empty($modelName))
		{
			Flash::error('ModelName not found');
			return redirect(route('modelNames.index'));
		}

		$modelName->delete();

		Flash::message('ModelName deleted successfully.');

		return redirect(route('modelNames.index'));
	}

}
