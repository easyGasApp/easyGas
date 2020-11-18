@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
  Logado com sucesso!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@if(session('status'))
  <div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
  </div>
@endif

<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Gastos (usuário)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">R${{ number_format($widget['fuel_amount_user'],2,",",".") }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-12 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Gastos (Todos usuários)
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">R${{ number_format($widget['fuel_amount_all'],2,",",".") }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Users -->
  <div class="col-xl-4 col-md-12 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              {{ __('Usuários') }}</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $widget['users'] }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">

  <!-- Content Column -->
  <div class="col-lg-12 mb-6">

    @foreach ($vehicles as $vehicle)
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ strtoupper($vehicle->license_plate) }}</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Usuário</th>
                <th>Qtde. Abastecida</th>
                <th>Qtde. Consumida</th>
                <th>Saldo</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->supply }}Km</td>
                  <td>{{ $user->route }}Km</td>
                  <td class='{{ $user->balance > 0 ? 'text-success' : 'text-danger' }}'>{{ $user->balance }}Km</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endforeach



    <!-- Project Card Example -->
    {{-- <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Abastecimentos</h6>
      </div>
      <div class="card-body">
        <h4 class="small font-weight-bold">Usuário 1 <span class="float-right">20%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0"
            aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Usuário 2 <span class="float-right">80%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80"
            aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div> --}}

  </div>

</div>
@endsection
