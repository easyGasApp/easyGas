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
        <h6 class="m-0 font-weight-bold text-primary">Atualizar veículo</h6>
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('vehicles.update', $vehicle->id) }}"
          autocomplete="off">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @method('PUT');

          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="plate">Placa<span class="small text-danger">*</span></label>
                  <input type="text" id="plate" class="form-control" name="license_plate" placeholder="Nº da Placa"
                    value="{{ $vehicle->license_plate }}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="brand">Marca</label>
                  <input type="text" id="brand" class="form-control" name="brand" placeholder="Marca"
                    value="{{ $vehicle->brand }}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="model">Modelo</label>
                  <input type="text" id="model" class="form-control" name="model" placeholder="Modelo"
                    value="{{ $vehicle->model }}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="kilometers_litre">Km/L</label>
                  <input type="number" id="kilometers_litre" class="form-control" name="kilometers_litre"
                    placeholder="Km/L" value="{{ $vehicle->kilometers_litre }}">
                </div>
              </div>
            </div>
          </div>

          <!-- Button -->
          <div class="pl-lg-4">
            <div class="row">
              <div class="col text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>

  </div>

</div>

@endsection
