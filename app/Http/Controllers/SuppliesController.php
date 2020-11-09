<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SupplyCreateRequest;
use App\Http\Requests\SupplyUpdateRequest;
use App\Repositories\SupplyRepository;
use App\Validators\SupplyValidator;

/**
 * Class SuppliesController.
 *
 * @package namespace App\Http\Controllers;
 */
class SuppliesController extends Controller
{
    /**
     * @var SupplyRepository
     */
    protected $repository;

    /**
     * @var SupplyValidator
     */
    protected $validator;

    /**
     * SuppliesController constructor.
     *
     * @param SupplyRepository $repository
     * @param SupplyValidator $validator
     */
    public function __construct(SupplyRepository $repository, SupplyValidator $validator)
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
        $supplies = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $supplies,
            ]);
        }

        return view('supplies.index', compact('supplies'));
    }

    public function create()
    {
        return view('supplies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SupplyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SupplyCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $supply = $this->repository->create($request->all());

            $response = [
                'message' => 'Supply created.',
                'data'    => $supply->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route('supplies.index'))->with('message', $response['message']);
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
        $supply = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $supply,
            ]);
        }

        return view('supplies.show', compact('supply'));
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
        $supply = $this->repository->find($id);

        return view('supplies.edit', compact('supply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SupplyUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SupplyUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $supply = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Supply updated.',
                'data'    => $supply->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route('supplies.index'))->with('message', $response['message']);
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
                'message' => 'Supply deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Supply deleted.');
    }
}
