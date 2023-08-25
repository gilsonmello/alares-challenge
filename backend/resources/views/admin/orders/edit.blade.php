@extends('layouts.auth')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.orders.index') }}">Pedidos</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
          </ol>
        </div>
      </div>
    </div>
</section>
@endsection

@section('content')
<div class="container-fluid">
    <form method="post" action="{{ route('admin.orders.update', $order->id) }}">
        @method('put')
        @csrf
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar pedido {{ $order->id }}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="price">Cliente</label>
                    <input name="price"
                        type="text"
                        class="form-control"
                        value="{{ $order->customer->name }}"
                        disabled
                    />
                </div>
                <div class="form-group">
                    <label for="price">Plano</label>
                    <input name="price"
                        type="text"
                        class="form-control"
                        value="{{ $order->plan->qty }} - {{ $order->plan->measure }}"
                        disabled
                    />
                </div>

                <div class="form-group">
                    <label for="status_name">Medida</label>
                    {{ html()
                        ->select(
                            'status_name',
                            $statusName,
                            $order->status_name
                        )
                        ->class('form-control select2')
                    }}
                    @error('status_name')
                        <span class="error invalid-feedback">{{ $errors->first('status_name') }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success float-right">Salvar</button>
            </div>
        </div>
    </form>
</div>
@endsection

