<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProcesosRequest;
use App\Http\Requests\UpdateProcesosRequest;
use App\Libraries\Repositories\ProcesosRepository;
use Flash;
use Mitul\Controller\AppBaseController as AppBaseController;
use Response;

class ProcesosController extends AppBaseController
{

	/** @var  ProcesosRepository */
	private $procesosRepository;

	function __construct(ProcesosRepository $procesosRepo)
	{
		$this->procesosRepository = $procesosRepo;
	}

	/**
	 * Display a listing of the Procesos.
	 *
	 * @return Response
	 */
	public function index()
	{
	$procesos = $this->procesosRepository->paginate(3);
		
   	return view('procesos.index')->with('procesos', $procesos->sortBy('numero'));
	}
	
	/**
	 * Show the form for creating a new Procesos.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('procesos.create');
	}

	/**
	 * Store a newly created Procesos in storage.
	 *
	 * @param CreateProcesosRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateProcesosRequest $request)
	{
		$input = $request->all();

		$procesos = $this->procesosRepository->create($input);

		Flash::success('Procesos saved successfully.');

		return redirect(route('procesos.index'));
	}

	/**
	 * Display the specified Procesos.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$procesos = $this->procesosRepository->find($id);

		if(empty($procesos))
		{
			Flash::error('Procesos not found');

			return redirect(route('procesos.index'));
		}

		return view('procesos.show')->with('procesos', $procesos);
	}

	/**
	 * Show the form for editing the specified Procesos.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$procesos = $this->procesosRepository->find($id);

		if(empty($procesos))
		{
			Flash::error('Procesos not found');

			return redirect(route('procesos.index'));
		}

		return view('procesos.edit')->with('procesos', $procesos);
	}

	/**
	 * Update the specified Procesos in storage.
	 *
	 * @param  int              $id
	 * @param UpdateProcesosRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateProcesosRequest $request)
	{
		$procesos = $this->procesosRepository->find($id);

		if(empty($procesos))
		{
			Flash::error('Procesos not found');

			return redirect(route('procesos.index'));
		}

		$this->procesosRepository->updateRich($request->all(), $id);

		Flash::success('Procesos updated successfully.');

		return redirect(route('procesos.index'));
	}

	/**
	 * Remove the specified Procesos from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$procesos = $this->procesosRepository->find($id);

		if(empty($procesos))
		{
			Flash::error('Procesos not found');

			return redirect(route('procesos.index'));
		}

		$this->procesosRepository->delete($id);

		Flash::success('Procesos deleted successfully.');

		return redirect(route('procesos.index'));
	}
}
