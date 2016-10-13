<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Libraries\Repositories\ProjectRepository;
use Flash;
use Mitul\Controller\AppBaseController as AppBaseController;
use Response;

class ProjectController extends AppBaseController
{

	/** @var  ProjectRepository */
	private $projectRepository;

	function __construct(ProjectRepository $projectRepo)
	{
		$this->projectRepository = $projectRepo;
	}

	/**
	 * Display a listing of the Project.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = $this->projectRepository->paginate(10);

		return view('projects.index')
			->with('projects', $projects);
	}

	/**
	 * Show the form for creating a new Project.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('projects.create');
	}

	/**
	 * Store a newly created Project in storage.
	 *
	 * @param CreateProjectRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateProjectRequest $request)
	{
		$input = $request->all();

		$project = $this->projectRepository->create($input);

		Flash::success('Project saved successfully.');

		return redirect(route('projects.index'));
	}

	/**
	 * Display the specified Project.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$project = $this->projectRepository->find($id);

		if(empty($project))
		{
			Flash::error('Project not found');

			return redirect(route('projects.index'));
		}

		return view('projects.show')->with('project', $project);
	}

	/**
	 * Show the form for editing the specified Project.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$project = $this->projectRepository->find($id);

		if(empty($project))
		{
			Flash::error('Project not found');

			return redirect(route('projects.index'));
		}

		return view('projects.edit')->with('project', $project);
	}

	/**
	 * Update the specified Project in storage.
	 *
	 * @param  int              $id
	 * @param UpdateProjectRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateProjectRequest $request)
	{
		$project = $this->projectRepository->find($id);

		if(empty($project))
		{
			Flash::error('Project not found');

			return redirect(route('projects.index'));
		}

		$this->projectRepository->updateRich($request->all(), $id);

		Flash::success('Project updated successfully.');

		return redirect(route('projects.index'));
	}

	/**
	 * Remove the specified Project from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$project = $this->projectRepository->find($id);

		if(empty($project))
		{
			Flash::error('Project not found');

			return redirect(route('projects.index'));
		}

		$this->projectRepository->delete($id);

		Flash::success('Project deleted successfully.');

		return redirect(route('projects.index'));
	}
}
