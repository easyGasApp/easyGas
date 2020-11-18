<?php

namespace App\Http\Controllers;

use App\Repositories\VehicleRepository;
use App\Repositories\UserRepository;
use App\Repositories\SupplyRepository;
use App\Repositories\RouteRepository;
use App\Entities\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        VehicleRepository $vehicleRepository,
        UserRepository $userRepository,
        SupplyRepository $supplyRepository,
        RouteRepository $routeRepository
    ) {
        $this->middleware('auth');
        $this->vehicleRepository = $vehicleRepository;
        $this->userRepository = $userRepository;
        $this->supplies = $supplyRepository;
        $this->routes = $routeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $usersCount = User::count();
        $vehicles = $this->vehicleRepository->all();
        $fuel_amount_all = 0;

        foreach ($vehicles as $vehicle) {
            foreach ($users as $user) {
                $supplies = $this->supplies->findWhere(['user_id' => $user->id]);
                $user_supply = 0;
                $fuel_amount_user = 0;

                foreach($supplies as $supply) {
                    $user_supply += ($supply->price / $supply->price_liter);
                    $fuel_amount_user += $supply->price;
                    $fuel_amount_all += $supply->price;
                }
                $user->supply = $user_supply * $vehicles->first()->kilometers_litre;

                $routes = $this->routes->findWhere(['user_id' => $user->id]);
                $user->route = 0;
                    foreach ($routes as $route) {
                        if ($route) {
                            $user->route += $route->final_kilometer - $route->initial_kilometer;
                        }
                }

                $user->balance = $user->supply - $user->route;
            }
        }

        $widget = [
            'users' => $usersCount,
            'fuel_amount_user' => $fuel_amount_user,
            'fuel_amount_all' => $fuel_amount_all
        ];

        return view('home', compact('widget', 'vehicles', 'users'));
    }
}
