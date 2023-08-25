@extends('layouts.auth')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Pedidos</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">Lista de pedidos</h3>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
                    <div class="box">
                        <div class="box-body content-to-be-update">
                            <table cellspacing="0" class="table table-bordered table-hover data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Cliente</th>
                                        <th>Plano</th>
                                        <th>Status</th>
                                        <th>Registrado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $key => $value)
                                        <tr>
                                            <td>{!! $value->id !!}</td>
                                            <td>{!! $value->customer->name !!}</td>
                                            <td>{!! $value->plan->qty !!} -  {!! $value->plan->measure !!}</td>
                                            <td>{!! \App\Enums\StatusNameEnum::STATUS_LIST[$value->status_name] !!}</td>
                                            <td>{!! $value->created_at !!}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.edit', $value->id) }}" class="btn btn-info btn-xs">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                </a>
                                                <a href="{{ route('admin.orders.destroy', $value->id) }}" data-id="{{  $value->id }}" data-method="post" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        Vazio
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer clearfix">
            {!! $orders->links() !!}
        </div>
    </div>
</div>

@endsection
