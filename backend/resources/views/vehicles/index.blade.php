@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Veículos') }}</h1>

@if($errors->any())
  <div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="row">

  <div class="col-lg-12 order-lg-1">

    <div class="card shadow mb-4">

      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Veículos adicionados</h6>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-icon-split">
          <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
          <span class="text">Adicionar Veículo</span>
        </a>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Km\L</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              @foreach($vehicles as $vehicle)
                <tr>
                  <td>{{ $vehicle->license_plate }}</td>
                  <td>{{ $vehicle->brand }}</td>
                  <td>{{ $vehicle->model }}</td>
                  <td>{{ $vehicle->kilometers_litre }}</td>
                  <td class="text-center">
                    <a href="{{ route('vehicles.edit',$vehicle->id) }}"
                      class="btn btn-warning btn-circle">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                  </td>
                  <td class="text-center">
                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}"
                      method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-circle" type="submit">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>

</div>

@endsection
