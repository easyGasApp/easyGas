@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Rotas') }}</h1>

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
        <h6 class="m-0 font-weight-bold text-primary">Adicionar nova rota</h6>
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('routes.store') }}" autocomplete="off">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="initial_kilometer">Kilômetro Inicial<span
                      class="small text-danger">*</span></label>
                  <input type="number" id="initial_kilometer" class="form-control" name="initial_kilometer"
                    placeholder="Km">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="final_kilometer">Kilômetro final<span
                      class="small text-danger">*</span></label>
                  <input type="number" id="final_kilometer" class="form-control" name="final_kilometer"
                    placeholder="Km">
                </div>
              </div>

              <div class="col-lg-4">
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
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="time">Hora Ínicial</label>
                  <input type="time" id="time" class="form-control" name="time" placeholder="Hora Ínicial">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="time">Hora Final</label>
                  <input type="time" id="time" class="form-control" name="time" placeholder="Hora Final">
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
