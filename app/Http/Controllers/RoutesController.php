<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RouteCreateRequest;
use App\Http\Requests\RouteUpdateRequest;
use App\Repositories\RouteRepository;
use App\Validators\RouteValidator;

/**
 * Class RoutesController.
 *
 * @package namespace App\Http\Controllers;
 */
class RoutesController extends Controller
{
    /**
     * @var RouteRepository
     */
    protected $repository;

    /**
     * @var RouteValidator
     */
    protected $validator;

    /**
     * RoutesController constructor.
     *
     * @param RouteRepository $repository
     * @param RouteValidator $validator
     */
    public function __construct(RouteRepository $repository, RouteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $routes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $routes,
            ]);
        }

        return view('routes.index', compact('routes'));
    }

    public function create() {
        return view('routes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RouteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RouteCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $route = $this->repository->create($request->all());

            $response = [
                'message' => 'Route created.',
                'data'    => $route->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route('routes.index'))->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $route,
            ]);
        }

        return view('routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = $this->repository->find($id);

        return view('routes.edit', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RouteUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RouteUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $route = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Route updated.',
                'data'    => $route->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route('routes.index'))->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Route deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Route deleted.');
    }
}
