@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Abastecimentos') }}</h1>

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
        <h6 class="m-0 font-weight-bold text-primary">Adicionar novo abastecimento</h6>
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('supplies.store') }}" autocomplete="off">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="gas_station">Estabelecimento<span
                      class="small text-danger">*</span></label>
                  <input type="text" id="gas_station" class="form-control" name="gas_station"
                    placeholder="Nome do posto de gasolina">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="price">Preço</label>
                  <input type="number" id="price" class="form-control" name="price">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="price_liter">Preço por Litro</label>
                  <input type="number" id="price_liter" class="form-control" name="price_liter">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="date">Data</label>
                  <input type="date" id="date" class="form-control" name="date">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="vehicle">Veículo</label>
                  <select type="text" id="vehicle" class="form-control" name="vehicle_id" placeholder="Veículo">
                    @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->model }}</option>
                    @endforeach
                  </select>
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
