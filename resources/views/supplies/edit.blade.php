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
        <form method="POST" action="{{ route('supplies.update', $supply->id) }}"
          autocomplete="off">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @method('PUT')

          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="gas_station">Estabelecimento<span
                      class="small text-danger">*</span></label>
                  <input type="text" id="gas_station" class="form-control" name="gas_station"
                    placeholder="Nome do posto de gasolina" value="{{ $supply->gas_station }}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="price">Preço</label>
                  <input type="number" id="price" class="form-control" name="price" value="{{ $supply->price }}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="price_liter">Preço por Litro</label>
                  <input type="number" id="price_liter" class="form-control" name="price_liter"
                    value="{{ $supply->price_liter }}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="date">Data</label>
                  <input type="date" id="date" class="form-control" name="date" value="{{ $supply->date }}">
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
