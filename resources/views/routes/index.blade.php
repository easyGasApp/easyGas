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
        <h6 class="m-0 font-weight-bold text-primary">Rotas adicionadas</h6>
        <a href="{{ route('routes.create') }}" class="btn btn-primary btn-icon-split">
          <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
          <span class="text">Adicionar Rota</span>
        </a>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Km inicial</th>
                <th>Km final</th>
                <th>tempo</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              @foreach($routes as $route)
                <tr>
                  <td>{{ $route->initial_kilometer }}</td>
                  <td>{{ $route->final_kilometer }}</td>
                  <td>{{ $route->time }}</td>
                  <td class="text-center">
                    <a href="{{ route('routes.edit',$route->id) }}"
                      class="btn btn-warning btn-circle">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                  </td>
                  <td class="text-center">
                    <form action="{{ route('routes.destroy', $route->id) }}" method="post">
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
