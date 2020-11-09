<?php

namespace App\Http\Controllers;

use App\Repositories\VehicleRepository;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->middleware('auth');
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $vehicles = $this->vehicleRepository->all();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('home', compact('widget', 'vehicles'));
    }
}
